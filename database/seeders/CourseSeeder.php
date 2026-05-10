<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['name' => 'Pemrograman Web', 'code' => 'CS101', 'credits' => 3],
            ['name' => 'Basis Data', 'code' => 'CS102', 'credits' => 3],
            ['name' => 'Algoritma & Struktur Data', 'code' => 'CS103', 'credits' => 4],
            ['name' => 'Jaringan Komputer', 'code' => 'CS104', 'credits' => 3],
            ['name' => 'Kecerdasan Buatan', 'code' => 'CS105', 'credits' => 3],
            ['name' => 'Sistem Operasi', 'code' => 'CS106', 'credits' => 3],
            ['name' => 'Pemrograman Mobile', 'code' => 'CS107', 'credits' => 3],
            ['name' => 'Rekayasa Perangkat Lunak', 'code' => 'CS108', 'credits' => 3],
            ['name' => 'Grafika Komputer', 'code' => 'CS109', 'credits' => 3],
            ['name' => 'Manajemen Proyek TI', 'code' => 'CS110', 'credits' => 2],
            ['name' => 'Pengolahan Citra Digital', 'code' => 'CS111', 'credits' => 3],
            ['name' => 'Keamanan Informasi', 'code' => 'CS112', 'credits' => 3],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
