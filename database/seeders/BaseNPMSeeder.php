<?php

namespace Database\Seeders;

use App\Models\BaseNPM;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseNPMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BaseNPM::factory()->count(20)->create();
    }
}
