<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelSeminarKPFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = $this->faker->unique()->numberBetween(1, 999999);
        return [
            'encrypt_id' => Crypt::encrypt($id),
            'judul_kp' => $this->faker->sentence(3),
            'semester' => $this->faker->randomElement(['Ganjil', 'Genap']),
            'tahun_akademik' => $this->faker->numberBetween(2010, 2021),
            'mitra' => $this->faker->company,
            'region' => $this->faker->randomElement(['Unila', 'Dalam Lampung', 'Luar Lampung']),
            'rencana_seminar' => $this->faker->date(),
            'pembimbing_lapangan' => $this->faker->name,
            'ni_pemlap' => $this->faker->numberBetween(1, 999999),
            'toefl' => $this->faker->numberBetween(1, 999),
            'sks' => $this->faker->numberBetween(100, 144),
            'ipk' => $this->faker->randomFloat(2, 2, 4),
            'berkas_seminar_pkl' => 'kp1.pdf',
            'agreement' => 1,
            'status_seminar' => $this->faker->randomElement(['Selesai', 'Belum Selesai', 'Perbaikan', 'Tidak Lulus']),
            'proses_admin' => $this->faker->randomElement(['Proses', 'Valid', 'Invalid']),
            'id_dospemkp' => $this->faker->numberBetween(1, 7),
            'id_mahasiswa' => $this->faker->numberBetween(1, 8),
        ];
    }
}
