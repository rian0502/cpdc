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
            'nip' => '197906062009101002',
            'encrypt_id' => Crypt::encrypt('1'),
            'nama_administrasi' => 'Rudi Santoso',
            'tanggal_lahir' => '1890-01-20',
            'tempat_lahir' => 'Metro',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Panglima Polim Kavl.9 No. 1',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
            'user_id' => '33',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        Administrasi::create([
            'encrypt_id' => Crypt::encrypt('2'),
            'nip' => '199912312020',
            'nama_administrasi' => 'Fakhrudin, S.T',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1990-12-12',
            'tempat_lahir' => 'Bandar Lampung',
            'alamat' => 'Jl. Untung Suropati No. 1 ',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
            'user_id' => '34',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Administrasi::create([
            'nip' => '196512202007012001',
            'encrypt_id' => Crypt::encrypt('3'),
            'nama_administrasi' => 'Liza Apriliya Sukartiningsih, S.Si.',
            'tanggal_lahir' => '1890-01-20',
            'tempat_lahir' => 'Pesawaran',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Panglima Polim Kavl.9 No. 2',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
            'user_id' => '35',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Administrasi::create([
            'nip' => '196512202007012001',
            'encrypt_id' => Crypt::encrypt('4'),
            'nama_administrasi' => 'Wiwit Kasmawati',
            'tanggal_lahir' => '1890-01-20',
            'tempat_lahir' => 'Pesawaran',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Panglima Polim Kavl.9 No. 2',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
            'user_id' => '36',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Administrasi::create([
            'nip' => '196512202007012001',
            'encrypt_id' => Crypt::encrypt('5'),
            'nama_administrasi' => 'Della Rahmadhani Putri',
            'tanggal_lahir' => '1890-01-20',
            'tempat_lahir' => 'Pesawaran',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Panglima Polim Kavl.9 No. 2',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
            'user_id' => '37',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Administrasi::create([
            'nip' => '196512202007012001',
            'encrypt_id' => Crypt::encrypt('6'),
            'nama_administrasi' => 'Tri Kismwantari, A.Md.',
            'tanggal_lahir' => '1890-01-20',
            'tempat_lahir' => 'Pesawaran',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Panglima Polim Kavl.9 No. 2',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
            'user_id' => '38',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

    }
}
