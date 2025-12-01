<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete(); // Relasi ke Proyek
            $table->foreignId('user_id')->constrained(); // Siapa pelakunya
            $table->string('action'); // Contoh: 'move', 'create', 'delete'
            $table->string('description'); // Contoh: "Budi memindahkan tugas X ke Done"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};