<?php

namespace Database\Seeders;

use App\Models\ModelSeminarKP;
use Illuminate\Database\Seeder;

class KpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ModelSeminarKP::factory()->count(8)->create();
    }
}
