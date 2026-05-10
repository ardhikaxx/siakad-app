<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('lecturer_id')->constrained('users');
            $table->foreignId('room_id')->constrained('rooms');
            $table->enum('day', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('semester', 20); // cth: Ganjil 2024/2025
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
