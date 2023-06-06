<?php

namespace Database\Seeders;

use App\Models\AktivitasMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AktivitasMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AktivitasMahasiswa::factory()->count(30)->create();
    }
}
