<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['name' => 'Ruang A1', 'capacity' => 40],
            ['name' => 'Ruang A2', 'capacity' => 40],
            ['name' => 'Ruang A3', 'capacity' => 40],
            ['name' => 'Ruang A4', 'capacity' => 40],
            ['name' => 'Lab Komputer 1', 'capacity' => 30],
            ['name' => 'Lab Komputer 2', 'capacity' => 30],
            ['name' => 'Lab Komputer 3', 'capacity' => 30],
            ['name' => 'Lab Jaringan', 'capacity' => 25],
            ['name' => 'Aula Besar', 'capacity' => 100],
            ['name' => 'Aula Kecil', 'capacity' => 50],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
