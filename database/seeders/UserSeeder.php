<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $dosenRole = Role::where('name', 'dosen')->first();
        $mahasiswaRole = Role::where('name', 'mahasiswa')->first();

        User::create([
            'role_id' => $adminRole->id,
            'name' => 'Administrator',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('password'),
            'identifier' => '000001',
            'is_active' => true,
        ]);

        $dosenNames = [
            'Dr. Budi Santoso, S.Kom., M.Kom.',
            'Prof. Dr. Ir. Hadi Gunawan, M.T.',
            'Dr. Siti Nurhaliza, S.T., M.Eng.',
            'Ahmad Fauzi, S.Kom., M.Cs.',
            'Dr. Rina Wijayanti, S.T., M.T.',
        ];

        foreach ($dosenNames as $i => $name) {
            User::create([
                'role_id' => $dosenRole->id,
                'name' => $name,
                'email' => strtolower(str_replace([' ', '.', ','], ['', '', ''], $name)) . '@siakad.com',
                'password' => Hash::make('password'),
                'identifier' => '19850' . str_pad($i + 1, 2, '0', STR_PAD_LEFT) . '2010011001',
                'is_active' => true,
            ]);
        }

        $mahasiswaNames = [
            'Andi Pratama', 'Siti Aisyah', 'Budi Setiawan', 'Dewi Lestari',
            'Rian Hakim', 'Maya Sari', 'Dimas Wicaksono', 'Nina Indriyani',
            'Taufik Hidayat', 'Lina Marlina', 'Agus Salim', 'Rina Oktaviani',
            'Hendra Gunawan', 'Fitri Handayani', 'Joko Susilo', 'Mita Permata',
            'Dian Pramita', 'Slamet Raharjo', 'Tika Suryani', 'Rahmat Hidayat',
        ];

        foreach ($mahasiswaNames as $i => $name) {
            User::create([
                'role_id' => $mahasiswaRole->id,
                'name' => $name,
                'email' => strtolower(str_replace(' ', '', $name)) . '@siakad.com',
                'password' => Hash::make('password'),
                'identifier' => '2024' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'is_active' => true,
            ]);
        }
    }
}
