<?php

namespace Database\Seeders;

use App\Models\OrganisasiDosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisasiDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        OrganisasiDosen::factory()->count(10)->create();
    }
}
