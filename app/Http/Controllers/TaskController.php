<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ProjectList;
use Illuminate\Http\Request;

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

        // Update List ID (Pindah Kolom)
        $task->update([
            'project_list_id' => $request->project_list_id
        ]);

        // Cek apakah tugas dipindah ke kolom "Done" (atau list terakhir)
        // Ini nanti tempat kita menaruh TRIGGER WHATSAPP!
        // if ($task->list->name == 'Done') { ... }

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
        $request->validate(['description' => 'nullable|string']);
        
        $task->update(['description' => $request->description]);

        return response()->json(['message' => 'Deskripsi diperbarui']);
    }

    // Method untuk Assign Member ke Tugas
    public function assign(Request $request, Task $task)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id'
    ]);

    // Toggle: Kalau belum ada -> pasang. Kalau sudah ada -> copot.
    $task->assignees()->toggle($request->user_id);

    // Ambil data user yang baru saja di-toggle untuk respon JSON
    $user = \App\Models\User::find($request->user_id);

    return response()->json([
        'message' => 'Assignee updated',
        'user' => $user,
        // Kirim balik status apakah sekarang dia ditugaskan atau tidak
        'attached' => $task->assignees->contains($request->user_id) 
    ]);
 
    }
    // Hapus Tugas
    public function destroy(Task $task)
    {
        // Opsional: Cek akses (apakah user anggota proyek ini?)
        
        $task->delete();

        return response()->json(['message' => 'Tugas berhasil dihapus']);
    }
}