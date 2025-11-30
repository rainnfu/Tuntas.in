<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $request->validate(['body' => 'required|string']);

        $task->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        // Kita return JSON agar halaman tidak perlu refresh (AJAX)
        return response()->json([
            'message' => 'Komentar berhasil ditambahkan', 
            'user' => Auth::user()->name,
            'body' => $request->body
        ]);
    }
}