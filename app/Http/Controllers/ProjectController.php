<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // 1. Menampilkan Daftar Proyek (Dashboard)
    public function index()
    {
        $user = Auth::user();
        
        // 1. Ambil semua proyek (Owned + Member)
        $ownedProjects = $user->ownedProjects;
        $memberProjects = $user->projects;
        $allProjects = $ownedProjects->merge($memberProjects);

        // 2. Ambil urutan custom user
        $order = $user->project_order ?? [];

        // 3. Sortir Proyek berdasarkan urutan tersebut
        $projects = $allProjects->sortBy(function($model) use ($order) {
            // Cari posisi ID di array order
            $key = array_search($model->id, $order);
            // Jika ketemu, pakai indexnya. Jika tidak (proyek baru), taruh di paling belakang (9999)
            return $key !== false ? $key : 999999 + $model->id;
        });

        return view('dashboard', compact('projects'));
    }

    // 2. Menampilkan Form Buat Proyek
    public function create()
    {
        return view('projects.create');
    }

    // 3. Menyimpan Proyek Baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        // Simpan Proyek ke Database
        // Kita gunakan relasi 'ownedProjects' agar 'owner_id' otomatis terisi ID user yang login
        $project = Auth::user()->ownedProjects()->create([
            'name' => $request->name,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        // FITUR OTOMATIS: Buat 3 List Default (To Do, In Progress, Done)
        // Ini trik agar user tidak perlu buat manual
        $project->lists()->createMany([
            ['name' => 'To Do', 'order' => 1],
            ['name' => 'In Progress', 'order' => 2],
            ['name' => 'Done', 'order' => 3],
        ]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Proyek berhasil dibuat!');
    }

    // 4. Menampilkan Papan Proyek (Kanban Board)
    public function show(Project $project)
    {
        // Pastikan User punya akses (Owner atau Anggota)
        // Saat ini cek Owner dulu (simple version)
        if ($project->owner_id !== Auth::id() && !$project->members->contains(Auth::id())) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES KE PROYEK INI.');
        }

        // Ambil data List beserta Task-nya (Eager Loading biar cepat)
        $project->load('lists.tasks.assignees');

        return view('projects.show', compact('project'));
    }

    // 5. Menampilkan Form Edit (Opsional, bisa pakai modal atau halaman terpisah)
    public function edit(Project $project)
    {
        // Pastikan hanya Owner yang bisa edit
        if ($project->owner_id !== Auth::id()) {
            abort(403);
        }
        return view('projects.edit', compact('project'));
    }

    // 6. Update Data Proyek
    public function update(Request $request, Project $project)
    {
        if ($project->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        $project->update($request->only('name', 'description', 'deadline'));

        return redirect()->route('dashboard')->with('success', 'Proyek berhasil diperbarui!');
    }

    // 7. Hapus Proyek (DELETE)
    public function destroy(Project $project)
    {
        // PENTING: Hanya Owner yang boleh menghapus!
        if ($project->owner_id !== Auth::id()) {
            abort(403, 'Hanya pemilik yang bisa menghapus proyek.');
        }

        $project->delete(); // Ini akan otomatis menghapus list & tasks karena 'onDelete cascade' di migrasi

        return redirect()->route('dashboard')->with('success', 'Proyek telah dihapus.');
    }

    // Method untuk mengambil Log Aktivitas (AJAX)
    public function logs(Project $project)
    {
        // Pastikan user adalah anggota/owner
        if ($project->owner_id !== Auth::id() && !$project->members->contains(Auth::id())) {
            abort(403);
        }

        // Ambil 50 log terakhir
        $logs = \App\Models\ActivityLog::where('project_id', $project->id)
                    ->with('user')
                    ->latest()
                    ->take(50)
                    ->get()
                    ->map(function ($log) {
                        return [
                            'id' => $log->id, // PENTING: Tambahkan ID unik untuk Key AlpineJS
                            'user_name' => $log->user->name,
                            'avatar_url' => $log->user->avatar_url, 
                            'description' => $log->description,
                            'created_at' => $log->created_at->diffForHumans(), // Format "2 minutes ago"
                            'action' => $log->action
                        ];
                    });

        return response()->json($logs);
    }

    // Method untuk menyimpan urutan baru
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array', // Array berisi ID project
        ]);

        $user = Auth::user();
        $user->update(['project_order' => $request->order]);

        return response()->json(['message' => 'Urutan tersimpan']);
    }
}