<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\User;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $dosenIds = User::where('role_id', 2)->pluck('id')->toArray();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        
        $schedules = [
            ['course_id' => 1, 'lecturer_id' => $dosenIds[0], 'room_id' => 1, 'day' => 'Senin', 'start_time' => '08:00', 'end_time' => '10:30', 'semester' => 'Ganjil 2024/2025'],
            ['course_id' => 2, 'lecturer_id' => $dosenIds[1], 'room_id' => 5, 'day' => 'Selasa', 'start_time' => '10:00', 'end_time' => '12:30', 'semester' => 'Ganjil 2024/2025'],
            ['course_id' => 3, 'lecturer_id' => $dosenIds[2], 'room_id' => 5, 'day' => 'Rabu', 'start_time' => '13:00', 'end_time' => '15:30', 'semester' => 'Ganjil 2024/2025'],
            ['course_id' => 4, 'lecturer_id' => $dosenIds[0], 'room_id' => 6, 'day' => 'Kamis', 'start_time' => '08:30', 'end_time' => '11:00', 'semester' => 'Ganjil 2024/2025'],
            ['course_id' => 5, 'lecturer_id' => $dosenIds[1], 'room_id' => 5, 'day' => 'Jumat', 'start_time' => '13:30', 'end_time' => '16:00', 'semester' => 'Ganjil 2024/2025'],
            ['course_id' => 6, 'lecturer_id' => $dosenIds[2], 'room_id' => 2, 'day' => 'Senin', 'start_time' => '13:00', 'end_time' => '15:30', 'semester' => 'Ganjil 2024/2025'],
            ['course_id' => 7, 'lecturer_id' => $dosenIds[3], 'room_id' => 6, 'day' => 'Selasa', 'start_time' => '08:00', 'end_time' => '10:30', 'semester' => 'Ganjil 2024/2025'],
            ['course_id' => 8, 'lecturer_id' => $dosenIds[4], 'room_id' => 5, 'day' => 'Rabu', 'start_time' => '08:00', 'end_time' => '10:30', 'semester' => 'Ganjil 2024/2025'],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
