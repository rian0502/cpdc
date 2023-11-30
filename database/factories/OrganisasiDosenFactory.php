<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganisasiDosen>
 */
class OrganisasiDosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_organisasi' => $this->faker->sentence(3),
            'tahun_menjabat' => $this->faker->numberBetween(1990, 2023),
            'tahun_berakhir' => $this->faker->numberBetween(1990, 2023),
            'jabatan' => $this->faker->randomElement([
                'Ketua',
                'Wakil Ketua',
                'Sekretaris',
                'Bendahara',
                'Anggota'
            ]),
            'dosen_id' => $this->faker->numberBetween(1, 2),
            'created_at' => '2023-05-30 00:00:00',
            'updated_at' => '2023-05-30 00:00:00',
        ];
    }
}
