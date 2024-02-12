<?php

namespace Database\Factories;

// database/factories/ModelPublikasiMahasiswaFactory.php

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mahasiswa;

class ModelPublikasiMahasiswaFactory extends Factory
{

    public function definition()
    {
        $mahasiswaId = Mahasiswa::inRandomOrder()->value('id');
        return [
            'encrypt_id' => $this->faker->numberBetween(1000, 99999999).$this->faker->word,
            'nama_publikasi' => $this->faker->word,
            'judul' => $this->faker->sentence,
            'tahun' => $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now')->format('Y'),
            'vol' => $this->faker->numberBetween(1, 10),
            'halaman' => $this->faker->randomNumber(2) . '-' . $this->faker->randomNumber(2),
            'scala' => $this->faker->randomElement(['Nasional', 'Internasional']),
            'kategori' => $this->faker->randomElement([
                'Buku Referensi',
                'Monograf',
                'Buku Nasional',
                'Buku Internasional',
                'Artikel Internasional Bereputasi',
                'Artikel Internasional Terindkes',
                'Jurnal Nasional Terakreditasi Dikti',
                'Jurnal Nasional',
                'Jurnal Ilmiah',
                'Prosiding Internasional Terindeks',
                'Prosiding Internasional',
                'Prosiding Nasional',
                'Paten',
                'Paten Sederhana',
                'Hak Cipta',
                'Desain Produk Industri',
                'Teknologi Tepat Guna',
                'Buku ber-ISBN',
                'Book Chapter'
            ]),
            'url' => $this->faker->url,
            'anggota' => $this->faker->name . ', ' . $this->faker->name,
            'mahasiswa_id' => $mahasiswaId,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

