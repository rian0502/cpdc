<?php

namespace Database\Seeders;

use App\Models\Laboratorium;
use Illuminate\Database\Seeder;

class AktivitasLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Laboratorium::factory()->count(1000)->create();
    }
}
