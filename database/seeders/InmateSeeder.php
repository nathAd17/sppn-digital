<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Inmate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InmateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run(): void
    {
        Inmate::create([
            'registration_number' => 'NP-2024-001',
            'name' => 'ABI FARDIAN LILIWANA BIN YUSRAN LILIWANA',
            'place_of_birth' => 'Lembata',
            'date_of_birth' => Carbon::parse('2003-11-12'),
            'gender' => 'Laki-laki',
            'religion' => 'Islam',
            'education_level' => 'SD/sederajat',
            'last_job' => 'Tidak Bekerja',
            'crime_type' => 'Perlindungan Anak',
            'sentence_length_months' => 96,
            'remaining_sentence_months' => 90,
            'recidivism_count' => 0,
            'health_notes' => null,
            'training_attended' => 'Tidak Ada',
            'work_program' => 'Tamping kebersihan blok hunian',
            'prison_id' => 1,
            'status' => 'active',
            'entry_date' => Carbon::parse('2024-01-15'),
        ]);

        Inmate::create([
            'registration_number' => 'NP-2024-002',
            'name' => 'AHMAD SURYANTO',
            'place_of_birth' => 'Kupang',
            'date_of_birth' => Carbon::parse('1995-05-20'),
            'gender' => 'Laki-laki',
            'religion' => 'Islam',
            'education_level' => 'SMA/sederajat',
            'last_job' => 'Wiraswasta',
            'crime_type' => 'Narkotika',
            'sentence_length_months' => 60,
            'remaining_sentence_months' => 45,
            'recidivism_count' => 1,
            'health_notes' => 'Riwayat penyalahgunaan narkoba',
            'training_attended' => 'Rehabilitasi Narkoba',
            'work_program' => 'Produksi kerajinan tangan',
            'prison_id' => 1,
            'status' => 'active',
            'entry_date' => Carbon::parse('2023-07-10'),
        ]);

        Inmate::create([
            'registration_number' => 'NP-2024-003',
            'name' => 'BUDI SANTOSO',
            'place_of_birth' => 'Ende',
            'date_of_birth' => Carbon::parse('1988-08-15'),
            'gender' => 'Laki-laki',
            'religion' => 'Kristen',
            'education_level' => 'SMP/sederajat',
            'last_job' => 'Buruh',
            'crime_type' => 'Pencurian',
            'sentence_length_months' => 36,
            'remaining_sentence_months' => 20,
            'recidivism_count' => 0,
            'health_notes' => null,
            'training_attended' => 'Pelatihan Las',
            'work_program' => 'Bengkel Las',
            'prison_id' => 1,
            'status' => 'active',
            'entry_date' => Carbon::parse('2023-01-20'),
        ]);

        Inmate::create([
            'registration_number' => 'NP-2024-004',
            'name' => 'CHARLIE MANURUNG',
            'place_of_birth' => 'Flores',
            'date_of_birth' => Carbon::parse('1992-12-10'),
            'gender' => 'Laki-laki',
            'religion' => 'Katolik',
            'education_level' => 'SD/sederajat',
            'last_job' => 'Petani',
            'crime_type' => 'Penganiayaan',
            'sentence_length_months' => 48,
            'remaining_sentence_months' => 30,
            'recidivism_count' => 1,
            'health_notes' => 'Gangguan kecemasan',
            'training_attended' => 'Konseling Psikologi',
            'work_program' => 'Pertanian',
            'prison_id' => 1,
            'status' => 'active',
            'entry_date' => Carbon::parse('2022-11-05'),
        ]);

        Inmate::create([
            'registration_number' => 'NP-2024-005',
            'name' => 'DAVID KRISTANTO',
            'place_of_birth' => 'Kupang',
            'date_of_birth' => Carbon::parse('1990-03-25'),
            'gender' => 'Laki-laki',
            'religion' => 'Kristen',
            'education_level' => 'SMA/sederajat',
            'last_job' => 'Sopir',
            'crime_type' => 'Penipuan',
            'sentence_length_months' => 40,
            'remaining_sentence_months' => 25,
            'recidivism_count' => 0,
            'health_notes' => null,
            'training_attended' => 'Pelatihan Otomotif',
            'work_program' => 'Bengkel Mobil',
            'prison_id' => 1,
            'status' => 'active',
            'entry_date' => Carbon::parse('2023-03-15'),
        ]);
    }
}
