<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['project_id', 'user_id', 'action', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        // ActivityLog milik satu Project
        // Pastikan kolom di database namanya 'project_id'
        // Jika project sudah dihapus (soft delete), data log tetap ada tapi project null
        return $this->belongsTo(Project::class)->withDefault([
            'name' => 'Proyek Dihapus' // Fallback jika project hilang
        ]);
    }
}