<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LaboratoriumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_kegiatan' => $this->faker->name,
            'id_lokasi' => $this->faker->randomElement([1,2,3]),
            'keperluan' => $this->faker->randomElement(['Praktikum', 'Seminar', 'Ujian', 'Penlitian', 'Lainnya']),
            'tanggal_kegiatan' => $this->faker->date(),
            'jam_mulai' => $this->faker->time(),
            'jam_selesai' => $this->faker->time(),
            'keterangan' => $this->faker->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
