<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'project_id', 'order'];

    // Relasi: List milik satu Proyek
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi: List punya banyak Tugas
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_list_id');
    }
}