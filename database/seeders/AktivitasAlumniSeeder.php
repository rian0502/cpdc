<?php

namespace Database\Seeders;


use App\Models\AktivitasAlumni;
use Illuminate\Database\Seeder;

class AktivitasAlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AktivitasAlumni::factory()->count(20)->create();
    }
}
