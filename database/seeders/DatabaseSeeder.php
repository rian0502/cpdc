<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Locations;
use Database\Seeders\Mahasiswa;
use Illuminate\Database\Seeder;
use Database\Seeders\SeederDosen;
use Database\Seeders\BaseNPMSeeder;
use Database\Seeders\RolePermision;
use Database\Seeders\AktivitasLabSeeder;
use Database\Seeders\SeederAdministrasi;
use Database\Seeders\TugasAkhirSatuSeeder;
use Database\Seeders\BerkasKelengkapanSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Locations::class);
        $this->call(RolePermision::class);
        $this->call(SeederDosen::class);
        $this->call(SeederAdministrasi::class);
        $this->call(Mahasiswa::class);
        $this->call(BerkasKelengkapanSeeder::class);
        $this->call(BaseNPMSeeder::class);
        $this->call(TugasAkhirSatuSeeder::class);
        
        $this->call(AktivitasAlumniSeeder::class);
        $this->call(TugasAkhirDuaSeeder::class);
        $this->call(KompreSeeder::class);

    }
}
