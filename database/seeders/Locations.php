<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class Locations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $lab1 = [
            'encrypt_id' => Crypt::encrypt(1),
            'nama_lokasi' => 'Lab Biokimia A',
            'lantai_tingkat' => '1',
            'nama_gedung' => 'Gedung Biokimia',
        ];
        Lokasi::create($lab1);
        $lab2 = [
            'encrypt_id' => Crypt::encrypt(2),
            'nama_lokasi' => 'Lab Biokimia B',
            'lantai_tingkat' => '2',
            'nama_gedung' => 'Gedung Biokimia',
        ];
        Lokasi::create($lab2);
        $lab3 = [
            'encrypt_id' => Crypt::encrypt(3),
            'nama_lokasi' => 'Lab Biokimia C',
            'lantai_tingkat' => '3',
            'nama_gedung' => 'Gedung Biokimia',
        ];
        Lokasi::create($lab3);
        $rsem = [
            'encrypt_id' => Crypt::encrypt(4),
            'nama_lokasi' => 'Ruang Seminar',
            'lantai_tingkat' => '2',
            'nama_gedung' => 'Gedung Kimia Terpadu',
        ];
        Lokasi::create($rsem);
    }
}
