<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ProjectList;
use Illuminate\Http\Request;
use App\Models\ActivityLog; 
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request, ProjectList $list)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Simpan tugas ke dalam List tersebut
        $list->tasks()->create([
            'title' => $request->title,
        ]);

        // Kembali ke halaman papan proyek
        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }
    // Method untuk memindahkan kartu (Update Status)
    public function move(Request $request, Task $task)
    {
        $request->validate([
            'project_list_id' => 'required|exists:project_lists,id',
        ]);

        // 1. Simpan nama list lama SEBELUM update
        $oldListName = $task->list->name;

        // 2. Update Data
        $task->update([
            'project_list_id' => $request->project_list_id
        ]);

        // 3. Ambil nama list baru SETELAH update
        // (Kita perlu query ulang list baru untuk dapat namanya)
        $newListName = \App\Models\ProjectList::find($request->project_list_id)->name;

        // 4. --- LOGIKA LOGGING (PASTIKAN INI ADA) ---
        if ($oldListName !== $newListName) {
            \App\Models\ActivityLog::create([
                'project_id' => $task->list->project_id, // Pastikan project_id benar
                'user_id' => auth()->id(),
                'action' => 'move',
                'description' => auth()->user()->name . " memindahkan '{$task->title}' ke {$newListName}",
            ]);
        }
        // -------------------------------------------

        return response()->json(['message' => 'Task moved successfully']);
    }


    // 1. Ambil Detail Tugas (API untuk Modal)
    public function show(Task $task)
    {
        // Muat relasi komentar (dan user yg komen) serta list-nya
        $task->load(['comments.user', 'list']);
        return response()->json($task);

        // Tambahkan 'assignees' di load
        $task->load(['comments.user', 'list', 'assignees']); 
        return response()->json($task);
    }

    // 2. Update Deskripsi Tugas
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'priority'    => 'nullable|string|in:low,medium,high,urgent', 
        ]);
        
        $task->update($request->only('description', 'due_date', 'priority'));

        return response()->json(['message' => 'Task diperbarui']);
    }

    // Method untuk Assign Member ke Tugas
    public function assign(Request $request, Task $task)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id'
    ]);

    $wasAssigned = $task->assignees()->where('user_id', $request->user_id)->exists();

    // Ambil data user yang ditugaskan
        $targetUser = \App\Models\User::find($request->user_id);
        $isNowAssigned = !$wasAssigned; // Kebalikan dari status awal

        // LOG ACTIVITY (Hanya jika Assign, Unassign opsional)
        if ($isNowAssigned) {
            \App\Models\ActivityLog::create([
                'project_id'  => $task->list->project_id,
                'user_id'     => auth()->id(), // Siapa yang melakukan aksi (Admin)
                'action'      => 'assign',
                'description' => auth()->user()->name . " menugaskan {$targetUser->name} ke '{$task->title}'",
            ]);
        }
    // Toggle: Kalau belum ada -> pasang. Kalau sudah ada -> copot.
    $task->assignees()->toggle($request->user_id);

    // Ambil data user yang baru saja di-toggle untuk respon JSON
    $user = \App\Models\User::find($request->user_id);

    return response()->json([
            'message' => 'Assignee updated',
            'user' => $targetUser,
            'attached' => $isNowAssigned
        ]);
 
    }
    // Hapus Tugas
    public function destroy(Task $task)
    {
        // Opsional: Cek akses (apakah user anggota proyek ini?)
        
        $task->delete();

        return response()->json(['message' => 'Tugas berhasil dihapus']);
    }

    // Method Baru: Tambah Tugas dari Tombol Global
    public function storeGlobal(Request $request, \App\Models\Project $project)
    {
        // Pastikan User adalah Owner
        if ($project->owner_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title'           => 'required|string|max:255',
            'project_list_id' => 'required|exists:project_lists,id', // User pilih list
            'priority'        => 'required|in:low,medium,high,urgent',
            'due_date'        => 'nullable|date',
        ]);

        $task = \App\Models\Task::create([
            'title'           => $request->title,
            'project_list_id' => $request->project_list_id,
            'priority'        => $request->priority,
            'due_date'        => $request->due_date,
        ]);

        // LOG CREATE
        \App\Models\ActivityLog::create([
            'project_id'  => $project->id,
            'user_id'     => auth()->id(),
            'action'      => 'create',
            'description' => auth()->user()->name . " membuat tugas baru: '{$task->title}'",
        ]);

        return back()->with('success', 'Tugas berhasil dibuat!');
    }
}