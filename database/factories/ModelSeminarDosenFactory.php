<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModelSeminarDosen>
 */
class ModelSeminarDosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'encrypt_id' => $this->faker->sentence(3),
            'nama' => $this->faker->sentence(3),
            'tanggal' => $this->faker->date(),
            'uraian' => $this->faker->sentence(3),
            'url' => $this->faker->url(),
            'scala' => $this->faker->randomElement([
                'Nasional',
                'Internasional',
                'Provinsi',
                'Kabupaten/Kota',
                'Universitas'
            ]),
            'dosen_id' => $this->faker->numberBetween(1, 10),
            'created_at' => '2023-05-30 00:00:00',
            'updated_at' => '2023-05-30 00:00:00',
        ];
    }
}
