<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\WhatsAppService; // <--- PENTING: Import Service
use Illuminate\Support\Facades\Log;

class ProjectMemberController extends Controller
{
    public function store(Request $request, Project $project)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // 2. Cari User
        $user = User::where('email', $request->email)->first();

        // 3. Cek Aturan (Validation Rules)
        // Jangan invite diri sendiri (Owner)
        if ($user->id === $project->owner_id) {
            return back()->with('error', 'Anda adalah pemilik proyek ini.');
        }

        // Cek apakah user sudah jadi anggota
        if ($project->members->contains($user->id)) {
            return back()->with('error', 'User tersebut sudah menjadi anggota.');
        }

        // 4. Simpan ke Database (Attach)
        $project->members()->attach($user->id);

        // 5. KIRIM NOTIFIKASI WHATSAPP
        if ($user->whatsapp_number) {
            try {
                $wa = new WhatsAppService();
                $ownerName = auth()->user()->name;
                
                // Pesan yang ramah
                $message = "Halo {$user->name}! 👋\n\n" .
                           "Anda telah diundang oleh *{$ownerName}* " .
                           "untuk bergabung di proyek: *{$project->name}*.\n\n" .
                           "Silakan login ke Tuntas.in untuk melihat detailnya.";
                
                // Debugging Log (Cek storage/logs/laravel.log jika gagal)
                Log::info("Mencoba invite WA ke: " . $user->whatsapp_number);
                
                $wa->sendMessage($user->whatsapp_number, $message);
                
            } catch (\Exception $e) {
                Log::error("Gagal kirim WA Invite: " . $e->getMessage());
                // Jangan return error agar user tetap tersimpan meski WA gagal
            }
        }

        return back()->with('success', 'Anggota berhasil ditambahkan & diundang!');
    }
}