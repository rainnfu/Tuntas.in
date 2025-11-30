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
        
        // 1. Ambil proyek yang dibuat sendiri (Owner)
        $ownedProjects = $user->ownedProjects;

        // 2. Ambil proyek yang diikuti sebagai anggota (Member)
        // Kita gunakan relasi 'projects' yang sudah didefinisikan di Model User
        $memberProjects = $user->projects; 

        // 3. Gabungkan keduanya menjadi satu koleksi
        $projects = $ownedProjects->merge($memberProjects)->sortByDesc('updated_at');
        
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
        ]);

        // Simpan Proyek ke Database
        // Kita gunakan relasi 'ownedProjects' agar 'owner_id' otomatis terisi ID user yang login
        $project = Auth::user()->ownedProjects()->create([
            'name' => $request->name,
            'description' => $request->description,
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
        ]);

        $project->update($request->only('name', 'description'));

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
}