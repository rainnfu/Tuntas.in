<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'owner_id', 'deadline'];

    protected $casts = [
        'deadline' => 'date',
    ];

    // Relasi: Proyek dimiliki oleh satu User (Owner)
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relasi: Proyek punya banyak anggota
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    // Relasi: Proyek punya banyak List (To Do, In Progress, dll)
    public function lists()
    {
        return $this->hasMany(ProjectList::class);
    }
}