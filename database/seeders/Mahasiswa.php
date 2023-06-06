<?php

namespace Database\Seeders;

use App\Models\Mahasiswa as ModelsMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Mahasiswa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ModelsMahasiswa::create([
            'npm' => '2015051010',
            'nama_mahasiswa' => 'Egon Otmar',
            'tanggal_lahir' => '2000-10-10',
            'tempat_lahir' => 'Jakarta',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Kebon Jeruk No. 1',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_masuk' => '2020-08-30',
            'angkatan' => '2020',
            'status' => 'Aktif',
            'id_dosen' => '1',
            'semester' => '6',
            'user_id' => '6',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        ModelsMahasiswa::create([
            'npm' => '2015051011',
            'nama_mahasiswa' => 'Melati Aminah',
            'tanggal_lahir' => '2000-04-15',
            'tempat_lahir' => 'Bogor',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Dukuh Zambrud Blok AB No.3',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_masuk' => '2020-08-30',
            'angkatan' => '2020',
            'status' => 'Aktif',
            'id_dosen' => '2',
            'semester' => '6',
            'user_id' => '7',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        ModelsMahasiswa::create([
            'npm' => '2015051012',
            'nama_mahasiswa' => 'Wera Adamska',
            'tanggal_lahir' => '2002-03-15',
            'tempat_lahir' => 'Tegal',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Yos Sudarso No. 1, Kec. Tegal Timur, Kota Tegal, Jawa Tengah 52121',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_masuk' => '2020-08-30',
            'angkatan' => '2020',
            'status' => 'Aktif',
            'id_dosen' => '3',
            'semester' => '6',
            'user_id' => '8',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        ModelsMahasiswa::create([
            'npm' => '2015051012',
            'nama_mahasiswa' => 'Gianni Ricci',
            'tanggal_lahir' => '2002-02-20',
            'tempat_lahir' => 'Muara Enim',
            'no_hp' => '081234567890',
            'alamat' => 'Kp. Cikarang, Desa Cikarang, Kec. Cikarang Barat, Kab. Bekasi, Jawa Barat 17520',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_masuk' => '2020-08-30',
            'angkatan' => '2020',
            'status' => 'Aktif',
            'id_dosen' => '3',
            'semester' => '6',
            'user_id' => '9',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
    }
}
