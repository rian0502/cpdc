<?php

namespace Database\Seeders;

use App\Models\AktivitasMahasiswa;
use App\Models\PrestasiMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestasiMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PrestasiMahasiswa::factory()->count(30)->create();
        
    }
}
