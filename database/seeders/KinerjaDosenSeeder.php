<?php

namespace Database\Seeders;

use App\Models\ModelKinerjaDosen;
use Illuminate\Database\Seeder;

class KinerjaDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ModelKinerjaDosen::factory()->count(100)->create();
    }
}
