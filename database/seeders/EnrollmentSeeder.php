<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\User;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswaIds = User::where('role_id', 3)->pluck('id')->toArray();
        $scheduleIds = range(1, 8);

        $enrollments = [];
        foreach ($mahasiswaIds as $studentId) {
            $coursesToEnroll = rand(3, 5);
            $selectedCourses = array_rand(array_flip($scheduleIds), $coursesToEnroll);
            
            if (!is_array($selectedCourses)) {
                $selectedCourses = [$selectedCourses];
            }

            foreach ($selectedCourses as $scheduleId) {
                $enrollments[] = [
                    'schedule_id' => $scheduleId,
                    'student_id' => $studentId,
                ];
            }
        }

        foreach ($enrollments as $enrollment) {
            Enrollment::create($enrollment);
        }
    }
}
