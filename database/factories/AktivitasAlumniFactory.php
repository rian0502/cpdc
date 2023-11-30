<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

class AktivitasAlumniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'encrypted_id' => Crypt::encrypt('1'),
            'tempat' => $this->faker->company,
            'alamat' => $this->faker->address,
            'jabatan' => $this->faker->jobTitle,
            'tahun_masuk' => $this->faker->date(),
            'hubungan' => $this->faker->randomElement(['Sangat Erat', 'Erat', 'Cukup Erat', 'Tidak Erat']),
            'gaji' => $this->faker->numberBetween(1200000, 10000000),
            'status' => $this->faker->randomElement(['Kerja', 'Lanjut Studi', 'Wirausaha', 'Lainnya']),
            'mahasiswa_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
