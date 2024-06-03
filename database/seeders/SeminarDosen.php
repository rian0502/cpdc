<?php

namespace Database\Seeders;

use App\Models\ModelSeminarDosen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeminarDosen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            ModelSeminarDosen::factory()->count(100)->create();
    }
}
