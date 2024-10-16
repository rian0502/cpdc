<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrestasiMahasiswa>
 */
class PrestasiMahasiswaS2Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'encrypt_id' => Crypt::encrypt($this->faker->unique()->numberBetween(1, 999999999)),
            'nama_prestasi' => $this->faker->sentence(3),
            'scala' => $this->faker->randomElement(['Nasional', 'Internasional', 'Provinsi', 'Kabupaten/Kota', 'Universitas']),
            'tanggal' => $this->faker->date(),
            'capaian' => $this->faker->randomElement([
                'Juara 1',
                'Juara 2',
                'Juara 3',
                'Harapan 1',
                'Harapan 2',
                'Harapan 3',
                'Peserta'
            ]),
            'file_prestasi' => 'default.pdf',
            'mahasiswa_id' => 76,
            'created_at' => '2023-08-30 00:00:00',
            'updated_at' => '2023-08-30 00:00:00',
        ];
    }
}
