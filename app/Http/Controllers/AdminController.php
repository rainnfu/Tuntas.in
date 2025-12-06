<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil Statistik Ringkas
        $stats = [
            'users' => User::count(),
            'projects' => Project::count(),
            'logs_today' => ActivityLog::whereDate('created_at', today())->count(),
        ];

        // Ambil SEMUA Log (Pagination)
        // with('user') agar tidak n+1 problem
        $logs = ActivityLog::with(['user', 'project'])->latest()->paginate(20);

        return view('admin.dashboard', compact('stats', 'logs'));
    }
}