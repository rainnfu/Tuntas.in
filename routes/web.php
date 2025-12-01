<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectMemberController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Ubah route dashboard default menjadi ke ProjectController
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
    
    Route::get('/projects', function () {
        return redirect()->route('dashboard');
    });
    
    // Route untuk Membuat & Menyimpan Proyek
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    
    // Route profile bawaan breeze (biarkan saja)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk melihat Papan Proyek
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

    // Route untuk menyimpan Tugas Baru ke dalam List tertentu
    Route::post('/lists/{list}/tasks', [TaskController::class, 'store'])->name('lists.tasks.store');

    Route::patch('/tasks/{task}/move', [TaskController::class, 'move'])->name('tasks.move');

    // Route untuk Modal & Komentar
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show.api');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('tasks.comments.store');   

    // Route Undang Anggota
    Route::post('/projects/{project}/members', [ProjectMemberController::class, 'store'])->name('projects.members.store');

    // Route Assign Member ke Task
    Route::post('/tasks/{task}/assign', [TaskController::class, 'assign'])->name('tasks.assign');

    // CRUD Proyek Lengkap (Edit & Delete)
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Delete Task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/projects/{project}/logs', [ProjectController::class, 'logs'])->name('projects.logs');

    Route::post('/projects/{project}/tasks', [TaskController::class, 'storeGlobal'])->name('projects.tasks.store');

    // Tambahkan di dalam group auth
    Route::post('/projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
});

require __DIR__.'/auth.php';
