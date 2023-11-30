<?php

namespace Database\Seeders;

use App\Models\AktivitasMahasiswaS2;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AktivitasMahasiswaS2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AktivitasMahasiswaS2::factory()->count(100)->create();

    }
}
