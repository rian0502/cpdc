<?php

namespace Database\Seeders;

use App\Models\AktivitasMahasiswa;
use App\Models\PrestasiMahasiswaS2;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestasiMahasiswaS2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PrestasiMahasiswaS2::factory()->count(100)->create();

    }
}
