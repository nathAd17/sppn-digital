<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@lapas-lembata.id',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'nip' => '199001012015031001',
            'role' => 'admin',
            'prison_id' => 1,
            'is_active' => true,
        ]);

        // Kepala Lapas
        User::create([
            'name' => 'CARLES LAKABELA',
            'email' => 'kepala@lapas-lembata.id',
            'username' => 'kepala_lapas',
            'password' => Hash::make('password'),
            'nip' => '197505091998031001',
            'role' => 'kepala_lapas',
            'prison_id' => 1,
            'is_active' => true,
        ]);

        // Kasubsi Pembinaan
        User::create([
            'name' => 'Kasubsi Pembinaan',
            'email' => 'kasubsi@lapas-lembata.id',
            'username' => 'kasubsi',
            'password' => Hash::make('password'),
            'nip' => '198201012010011001',
            'role' => 'kasubsi',
            'prison_id' => 1,
            'is_active' => true,
        ]);

        // Wali Pemasyarakatan
        User::create([
            'name' => 'DJEMISON L. HIKU',
            'email' => 'wali@lapas-lembata.id',
            'username' => 'wali',
            'password' => Hash::make('password'),
            'nip' => '199201282017121002',
            'role' => 'wali_pemasyarakatan',
            'prison_id' => 1,
            'is_active' => true,
        ]);

        // Petugas
        User::create([
            'name' => 'Petugas Input',
            'email' => 'petugas@lapas-lembata.id',
            'username' => 'petugas',
            'password' => Hash::make('password'),
            'nip' => '199501012018031001',
            'role' => 'petugas',
            'prison_id' => 1,
            'is_active' => true,
        ]);
    }
}
