<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Meeting;
use App\Models\Attendance;
use Carbon\Carbon;

class MeetingSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = Schedule::with('enrollments')->get();
        $statuses = ['Hadir', 'Hadir', 'Hadir', 'Hadir', 'Ijin', 'Alpa']; // Bobot lebih banyak ke 'Hadir'

        foreach ($schedules as $schedule) {
            // Buat 3 pertemuan untuk setiap jadwal
            for ($i = 1; $i <= 3; $i++) {
                $meeting = Meeting::create([
                    'schedule_id' => $schedule->id,
                    'title'       => "Pertemuan ke-$i",
                    'date'        => Carbon::now()->subDays((3 - $i) * 7)->format('Y-m-d'), // Mundur 7 hari per pertemuan
                    'description' => "Materi pembahasan pertemuan ke-$i untuk mata kuliah " . $schedule->course->name,
                ]);

                // Buat data presensi untuk setiap mahasiswa yang terdaftar di jadwal ini
                foreach ($schedule->enrollments as $enrollment) {
                    Attendance::create([
                        'meeting_id' => $meeting->id,
                        'student_id' => $enrollment->student_id,
                        'status'     => $statuses[array_rand($statuses)],
                    ]);
                }
            }
        }
    }
}
