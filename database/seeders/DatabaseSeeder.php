<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Locations;
use Database\Seeders\Mahasiswa;
use Illuminate\Database\Seeder;
use Database\Seeders\BaseNPMSeeder;
use Database\Seeders\RolePermision;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermision::class);
        $this->call(Locations::class);
        $this->call(BaseNPMSeeder::class);
        $this->call(SeederDosen::class);
        $this->call(SeederAdministrasi::class);
        $this->call(Mahasiswa::class);
        $this->call(BerkasKelengkapanSeeder::class);

    }
}
