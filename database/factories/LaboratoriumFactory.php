<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

class LaboratoriumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jamMulai = $this->faker->time();
        $jamSelesai = $this->faker->dateTimeBetween($jamMulai, '23:59:59');
        $id = $this->faker->unique()->numberBetween(1, 999999);
        return [
            'id' => $id,
            'encrypted_id' => Crypt::encrypt($id),
            'nama_kegiatan' => $this->faker->sentence(3),
            'id_lokasi' => $this->faker->numberBetween(1, 4),
            'keperluan' => $this->faker->randomElement(['Praktikum', 'Seminar', 'Ujian', 'Penelitian', 'Lainnya']),
            'tanggal_kegiatan' => $this->faker->date(),
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'keterangan' => substr($this->faker->paragraph, 0, 255),
            'created_at' => now(),
            'updated_at' => now(),
            'jumlah_mahasiswa' => $this->faker->numberBetween(1, 100),
        ];
    }
}
