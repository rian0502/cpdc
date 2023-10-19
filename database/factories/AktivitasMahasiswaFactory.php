<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AktivitasMahasiswa>
 */
class AktivitasMahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'encrypt_id' => Crypt::encrypt($this->faker->unique()->numberBetween(1, 999999999)) ,
            'nama_aktivitas' => $this->faker->sentence(3),
            'peran' => $this->faker->randomElement(['Ketua', 'Anggota', 'Peserta']),
            'sks_konversi' => $this->faker->numberBetween(0, 24),
            'tanggal' => $this->faker->date(),
            'file_aktivitas' => 'default.pdf',
            'mahasiswa_id' => $this->faker->numberBetween(1, 50),
            'created_at' => '2023-08-30 00:00:00',
            'updated_at' => '2023-08-30 00:00:00',
        ];
    }
}
