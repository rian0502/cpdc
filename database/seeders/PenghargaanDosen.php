<?php

namespace Database\Seeders;

use App\Models\ModelPenghargaanDosen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class PenghargaanDosen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ModelPenghargaanDosen::factory()->count(100)->create();

    }
}
