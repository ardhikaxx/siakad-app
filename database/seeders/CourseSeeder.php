<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['name' => 'Pemrograman Web', 'code' => 'CS101', 'credits' => 3, 'semester' => '1'],
            ['name' => 'Basis Data', 'code' => 'CS102', 'credits' => 3, 'semester' => '2'],
            ['name' => 'Algoritma & Struktur Data', 'code' => 'CS103', 'credits' => 4, 'semester' => '1'],
            ['name' => 'Jaringan Komputer', 'code' => 'CS104', 'credits' => 3, 'semester' => '2'],
            ['name' => 'Kecerdasan Buatan', 'code' => 'CS105', 'credits' => 3, 'semester' => '3'],
            ['name' => 'Sistem Operasi', 'code' => 'CS106', 'credits' => 3, 'semester' => '3'],
            ['name' => 'Pemrograman Mobile', 'code' => 'CS107', 'credits' => 3, 'semester' => '4'],
            ['name' => 'Rekayasa Perangkat Lunak', 'code' => 'CS108', 'credits' => 3, 'semester' => '4'],
            ['name' => 'Grafika Komputer', 'code' => 'CS109', 'credits' => 3, 'semester' => '5'],
            ['name' => 'Manajemen Proyek TI', 'code' => 'CS110', 'credits' => 2, 'semester' => '6'],
            ['name' => 'Pengolahan Citra Digital', 'code' => 'CS111', 'credits' => 3, 'semester' => '7'],
            ['name' => 'Keamanan Informasi', 'code' => 'CS112', 'credits' => 3, 'semester' => '8'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
