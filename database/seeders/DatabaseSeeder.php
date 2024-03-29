<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

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
        $this->call(BerkasKelengkapanSeeder::class);
        $this->call(RolePermision::class);
        $this->call(TemplateBaSeeder::class);

    }
}
