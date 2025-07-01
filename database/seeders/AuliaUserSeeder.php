<?php

namespace Database\Seeders;

use App\Models\AuliaUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuliaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuliaUser::create([
            'name' => 'Admin Kos',
            'email' => 'admin@kos.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);
        AuliaUser::create([
            'name' => 'Pengunjung Aulia',
            'email' => 'fika@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
