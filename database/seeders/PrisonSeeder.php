<?php

namespace Database\Seeders;

use App\Models\Prison;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prison::create([
            'name' => 'LEMBAGA PEMASYARAKATAN KELAS III ROTE',
            'category' => 'Medium Security',
            'code' => 'LP-ROTE-001',
            'address' => 'Jl. XXXX No. 1',
            'city' => 'Rote',
            'province' => 'Nusa Tenggara Timur',
            'phone' => '0383-21234',
        ]);
    }
}
