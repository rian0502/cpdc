<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class BerkasKelengkapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('file_kelengkapan_seminar')->insert([
            'id' => 1,
            'encrypt_id' => Crypt::encrypt(1),
            'nama_file' => 'Seminar Kerja Praktik',
            'path_file' => 'syarat_seminar_kp.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('file_kelengkapan_seminar')->insert([
            'id' => 2,
            'encrypt_id' => Crypt::encrypt(2),
            'nama_file' => 'Seminar Tugas Akhir 1',
            'path_file' => 'syarat_seminar_ta1.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('file_kelengkapan_seminar')->insert([
            'id' => 3,
            'encrypt_id' => Crypt::encrypt(3),
            'nama_file' => 'Seminar Tugas Akhir 2',
            'path_file' => 'syarat_seminar_ta2.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('file_kelengkapan_seminar')->insert([
            'id' => 4,
            'encrypt_id' => Crypt::encrypt(4),
            'nama_file' => 'Seminar Komprehensif',
            'path_file' => 'syarat_seminar_komprehensif.pdf',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
