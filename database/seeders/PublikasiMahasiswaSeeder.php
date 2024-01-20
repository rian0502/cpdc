<?php

namespace Database\Seeders;

// database/seeders/PublikasiMahasiswaSeeder.php
use App\Models\AktivitasMahasiswa;
use App\Models\ModelPublikasiMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublikasiMahasiswaSeeder extends Seeder
{
    public function run()
    {
        ModelPublikasiMahasiswa::factory()->count(100)->create();
    }
}

