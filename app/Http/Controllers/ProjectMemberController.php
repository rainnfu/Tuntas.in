<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    public function store(Request $request, Project $project)
    {
        // Validasi: Email wajib ada dan harus ada di database user
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek 1: Jangan invite diri sendiri (Owner)
        if ($user->id === $project->owner_id) {
            return back()->with('error', 'Anda adalah pemilik proyek ini.');
        }

        // Cek 2: Cek apakah user sudah jadi anggota
        if ($project->members->contains($user->id)) {
            return back()->with('error', 'User tersebut sudah menjadi anggota.');
        }

        // Simpan ke tabel pivot (project_user)
        $project->members()->attach($user->id);

        return back()->with('success', 'Anggota berhasil ditambahkan!');
    }
}