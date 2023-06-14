<?php

namespace Database\Seeders;

use App\Models\Administrasi;
use App\Models\HistoryPangkatAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class SeederAdministrasi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Administrasi::create([
            'encrypt_id' => Crypt::encrypt('1'),
            'nip' => '199912312020',
            'nama_administrasi' => 'Fulan bin Fulan',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1990-12-12',
            'tempat_lahir' => 'Bandar Lampung',
            'alamat' => 'Jl. Untung Suropati No. 1 ',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
            'user_id' => '2',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatAdmin::create([
            'encrypt_id' => Crypt::encrypt('1'),
            'pangkat' => 'II B',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'administrasi_id' => '1',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Administrasi::create([
            'nip' => '197906062009101002',
            'encrypt_id' => Crypt::encrypt('2'),
            'nama_administrasi' => 'Rudi Santoso',
            'tanggal_lahir' => '1890-01-20',
            'tempat_lahir' => 'Metro',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Panglima Polim Kavl.9 No. 1',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
            'user_id' => '3',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatAdmin::create([
            'encrypt_id' => Crypt::encrypt('2'),
            'pangkat' => 'III D',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'administrasi_id' => '2',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);


        Administrasi::create([
            'nip' => '196512202007012001',
            'encrypt_id' => Crypt::encrypt('3'),
            'nama_administrasi' => 'Endang Sri Lestari',
            'tanggal_lahir' => '1890-01-20',
            'tempat_lahir' => 'Pesawaran',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Panglima Polim Kavl.9 No. 2',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
            'user_id' => '15',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatAdmin::create([
            'encrypt_id' => Crypt::encrypt('3'),
            'pangkat' => 'III D',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'administrasi_id' => '3',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
    }
}
