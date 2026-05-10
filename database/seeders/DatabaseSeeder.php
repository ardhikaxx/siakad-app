<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Course;
use App\Models\Room;
use App\Models\Schedule;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin     = Role::create(['name' => 'admin']);
        $dosen     = Role::create(['name' => 'dosen']);
        $mahasiswa = Role::create(['name' => 'mahasiswa']);

        // Users default
        User::create([
            'role_id'    => $admin->id,
            'name'       => 'Administrator',
            'email'      => 'admin@siakad.com',
            'password'   => Hash::make('password'),
            'identifier' => '000001',
            'is_active'  => true,
        ]);

        $dosenUser = User::create([
            'role_id'    => $dosen->id,
            'name'       => 'Dr. Budi Santoso',
            'email'      => 'dosen@siakad.com',
            'password'   => Hash::make('password'),
            'identifier' => '198501012010011001',
            'is_active'  => true,
        ]);

        $mahasiswaUser = User::create([
            'role_id'    => $mahasiswa->id,
            'name'       => 'Andi Pratama',
            'email'      => 'mahasiswa@siakad.com',
            'password'   => Hash::make('password'),
            'identifier' => '2024010001',
            'is_active'  => true,
        ]);

        // Courses
        $courses = [
            ['name' => 'Pemrograman Web', 'code' => 'CS101', 'credits' => 3],
            ['name' => 'Basis Data', 'code' => 'CS102', 'credits' => 3],
            ['name' => 'Algoritma & Struktur Data', 'code' => 'CS103', 'credits' => 4],
            ['name' => 'Jaringan Komputer', 'code' => 'CS104', 'credits' => 3],
            ['name' => 'Kecerdasan Buatan', 'code' => 'CS105', 'credits' => 3],
        ];
        foreach ($courses as $c) {
            Course::create($c);
        }

        // Rooms
        $rooms = [
            ['name' => 'Ruang A1', 'capacity' => 40],
            ['name' => 'Ruang A2', 'capacity' => 40],
            ['name' => 'Lab Komputer 1', 'capacity' => 30],
            ['name' => 'Lab Komputer 2', 'capacity' => 30],
            ['name' => 'Aula Besar', 'capacity' => 100],
        ];
        foreach ($rooms as $r) {
            Room::create($r);
        }

        // Sample Schedules
        Schedule::create([
            'course_id'   => 1,
            'lecturer_id' => $dosenUser->id,
            'room_id'     => 1,
            'day'         => 'Senin',
            'start_time'  => '08:00',
            'end_time'    => '10:30',
            'semester'    => 'Ganjil 2024/2025',
        ]);

        Schedule::create([
            'course_id'   => 2,
            'lecturer_id' => $dosenUser->id,
            'room_id'     => 3,
            'day'         => 'Rabu',
            'start_time'  => '13:00',
            'end_time'    => '15:30',
            'semester'    => 'Ganjil 2024/2025',
        ]);
    }
}
