<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tambahkan 'whatsapp_number' agar bisa diisi saat register
    protected $fillable = [
        'name',
        'email',
        'password',
        'whatsapp_number', 
        'project_order',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'project_order' => 'array',
        ];
    }

    // Relasi: User bisa memiliki banyak proyek (sebagai Owner)
    public function ownedProjects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    // Relasi: User bisa menjadi anggota di banyak proyek (Many-to-Many)
    // Ini mengakses tabel pivot 'project_user'
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }

    // Relasi: User bisa ditugaskan di banyak task
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user');

    }
   
public function getAvatarUrlAttribute()
    {
        // 1. Jika user sudah memilih avatar (tersimpan di DB, misal '3.png')
        if ($this->avatar) {
            // Cek apakah string di DB mengandung ekstensi. Jika tidak, tambahkan .jpg
            $filename = str_contains($this->avatar, '.') ? $this->avatar : $this->avatar . '.jpg';
            return asset('assets/avatars/' . $filename);
        }

        // 2. Fallback: Pilihkan random berdasarkan ID
        $totalAssets = 5; 
        $index = ($this->id % $totalAssets) + 1;

        // PENTING: Ganti ke .jpg sesuai file aset Anda
        return asset("assets/avatars/{$index}.jpg");
    }
}