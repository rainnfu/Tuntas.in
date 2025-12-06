<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\ProjectList;
use App\Models\Project;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\WhatsAppService; // Pastikan Service ini ada

class TaskController extends Controller
{
    // 1. TAMBAH TUGAS (Cara Lama/Per Kolom)
    public function store(Request $request, ProjectList $list)
    {
        if ($list->project->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['title' => 'required|string|max:255']);

        $list->tasks()->create(['title' => $request->title]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    // 2. TAMBAH TUGAS GLOBAL (Cara Baru/Modal Pusat)
    public function storeGlobal(Request $request, Project $project)
    {
        // Hanya Owner
        if ($project->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'           => 'required|string|max:255',
            'project_list_id' => 'required|exists:project_lists,id',
            'priority'        => 'required|in:low,medium,high,urgent',
            'due_date'        => 'nullable|date',
        ]);

        $task = Task::create([
            'title'           => $request->title,
            'project_list_id' => $request->project_list_id,
            'priority'        => $request->priority,
            'due_date'        => $request->due_date,
        ]);

        // LOG CREATE
        ActivityLog::create([
            'project_id'  => $project->id,
            'user_id'     => Auth::id(),
            'action'      => 'create',
            'description' => Auth::user()->name . " membuat tugas: '{$task->title}'",
        ]);

        return back()->with('success', 'Tugas berhasil dibuat!');
    }

    // 3. SHOW DETAIL (API untuk Modal)
    public function show(Task $task)
    {
        // PERBAIKAN: Load semua relasi sekaligus di sini
        $task->load(['comments.user', 'list', 'assignees']);
        
        return response()->json($task);
    }

    // 4. UPDATE DESKRIPSI, TANGGAL, PRIORITAS
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

    // 5. PINDAH KARTU (Drag & Drop)
    public function move(Request $request, Task $task)
    {
        $request->validate([
            'project_list_id' => 'required|exists:project_lists,id',
        ]);

        $oldListName = $task->list->name;

        // Update Posisi
        $task->update([
            'project_list_id' => $request->project_list_id
        ]);

        $newList = ProjectList::find($request->project_list_id);
        $newListName = $newList->name;

        // LOG ACTIVITY (Jika Pindah Kolom)
        if ($oldListName !== $newListName) {
            ActivityLog::create([
                'project_id'  => $task->list->project_id,
                'user_id'     => Auth::id(),
                'action'      => 'move',
                'description' => Auth::user()->name . " memindahkan '{$task->title}' ke {$newListName}",
            ]);
        }

        // NOTIFIKASI WA (Jika Pindah ke Done/Selesai)
        // Cek apakah nama list mengandung kata "Done" atau "Selesai"
        if (Str::contains(Str::lower($newListName), ['done', 'selesai'])) {
            $owner = $task->list->project->owner;
            
            // Jangan kirim ke diri sendiri
            if ($owner->id !== Auth::id() && $owner->whatsapp_number) {
                $wa = new WhatsAppService();
                $msg = "Laporan Progres ✅\n\nHalo Bos {$owner->name}, tugas *{$task->title}* telah diselesaikan oleh " . Auth::user()->name . ".";
                $wa->sendMessage($owner->whatsapp_number, $msg);
            }
        }

        return response()->json(['message' => 'Task moved successfully']);
    }

    // 6. ASSIGN MEMBER
    public function assign(Request $request, Task $task)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        // Cek status SEBELUM toggle
        $wasAssigned = $task->assignees()->where('user_id', $request->user_id)->exists();

        // Lakukan Toggle (Pasang/Copot)
        $task->assignees()->toggle($request->user_id);

        $targetUser = User::find($request->user_id);
        $isNowAssigned = !$wasAssigned; // Status baru

        // LOG & NOTIFIKASI (Hanya jika Assign, bukan Unassign)
        if ($isNowAssigned) {
            // 1. Buat Log
            ActivityLog::create([
                'project_id'  => $task->list->project_id,
                'user_id'     => Auth::id(),
                'action'      => 'assign',
                'description' => Auth::user()->name . " menugaskan {$targetUser->name} ke '{$task->title}'",
            ]);

            // 2. Kirim WhatsApp
            if ($targetUser->whatsapp_number) {
                $wa = new WhatsAppService();
                $projectName = $task->list->project->name;
                $msg = "Tugas Baru! 📝\n\nHalo {$targetUser->name}, Anda ditugaskan di:\nProyek: *{$projectName}*\nTugas: *{$task->title}*\n\nSemangat!";
                
                // Panggil service (Fonnte/Twilio otomatis terhandle di dalam class ini)
                $wa->sendMessage($targetUser->whatsapp_number, $msg);
            }
        }

        return response()->json([
            'message' => 'Assignee updated',
            'user' => $targetUser, // Kembalikan data user untuk update UI
            'attached' => $isNowAssigned
        ]);
    }

    // 7. HAPUS TUGAS
    public function destroy(Task $task)
    {
        // Log penghapusan sebelum data hilang
        ActivityLog::create([
            'project_id'  => $task->list->project_id,
            'user_id'     => Auth::id(),
            'action'      => 'delete',
            'description' => Auth::user()->name . " menghapus tugas '{$task->title}'",
        ]);

        $task->delete();

        return response()->json(['message' => 'Tugas berhasil dihapus']);
    }
}