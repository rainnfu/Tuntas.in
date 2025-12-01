<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'due_date', 'project_list_id'];
    
    protected $casts = [
        'due_date' => 'datetime', // Agar otomatis jadi objek Carbon (Bisa dicek isPast, diffForHumans, dll)
    ];
    
    // Relasi: Task berada di satu List
    public function list()
    {
        return $this->belongsTo(ProjectList::class, 'project_list_id');
    }

    // Relasi: Task dikerjakan oleh banyak User (Assignees)
    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    // Relasi: Task punya banyak komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}