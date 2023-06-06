<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\HistoryJabatanDosen;
use App\Models\HistoryPangkatDosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class SeederDosen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        Dosen::create([
            'encrypt_id' => Crypt::encrypt('2'),
            'nip' => '18212312312',
            'nidn' => '1234567899',
            'nama_dosen' => 'Nathaniel Holmgren, S.T., M.T.',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1980-06-03',
            'tempat_lahir' => 'Bukittinggi',
            'alamat' => 'Jl. Imam Bonjol No. 1',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
            'user_id' => '1',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        HistoryPangkatDosen::create([
            'encrypted_id' => Crypt::encrypt('1'),
            'kepangkatan' => 'IV D',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '1',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryJabatanDosen::create([
            'encrypted_id' => Crypt::encrypt('1'),
            'jabatan' => 'Lektor Kepala',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '1',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        Dosen::create([
            'encrypt_id' => Crypt::encrypt('2'),
            'nip' => '199912312023',
            'nidn' => '1234567890',
            'nama_dosen' => 'Benno Gustav, S.Si., M.Si.',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1983-04-20',
            'tempat_lahir' => 'Yogyakarta',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Kapten Tendean Komplek Puri Indah Blok A No. 1',
            'status' => 'Aktif',
            'user_id' => '4',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatDosen::create([
            'encrypted_id' => Crypt::encrypt('2'),
            'kepangkatan' => 'IV D',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '2',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryJabatanDosen::create([
            'encrypted_id' => Crypt::encrypt('2'),
            'jabatan' => 'Lektor Kepala',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '2',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('3'),
            'nip' => '199912312021',
            'nidn' => '1234567891',
            'nama_dosen' => 'Dwi Lestari, S.Si., M.Si, Ph.D.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1980-04-20',
            'tempat_lahir' => 'Bandung',
            'alamat' => 'Citra Garden City Blok A No. 10',
            'status' => 'Aktif',
            'user_id' => '5',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatDosen::create([
            'encrypted_id' => Crypt::encrypt('3'),
            'kepangkatan' => 'IV E',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '3',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryJabatanDosen::create([
            'encrypted_id' => Crypt::encrypt('3'),
            'jabatan' => 'Guru Besar',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '3',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        Dosen::create([
            'encrypt_id' => Crypt::encrypt('4'),
            'nip' => '139912312021',
            'nidn' => '1334567891',
            'nama_dosen' => 'Lucas Duhamel S.Si., M.Si.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1995-05-10',
            'tempat_lahir' => 'Bekasi',
            'alamat' => 'Citra Land Blok A No. 10',
            'status' => 'Aktif',
            'user_id' => '11',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatDosen::create([
            'encrypted_id' => Crypt::encrypt('4'),
            'kepangkatan' => 'IV A',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '4',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryJabatanDosen::create([
            'encrypted_id' => Crypt::encrypt('4'),
            'jabatan' => 'Asisten Ahli',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '4',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        Dosen::create([
            'encrypt_id' => Crypt::encrypt('5'),
            'nip' => '149912312021',
            'nidn' => '1434567891',
            'nama_dosen' => 'Savanna Hemelaar, S.T., M.T.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1995-05-10',
            'tempat_lahir' => 'Riau',
            'alamat' => 'Taman Cibaduyut Indah Blok A No. 10',
            'status' => 'Aktif',
            'user_id' => '12',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatDosen::create([
            'encrypted_id' => Crypt::encrypt('5'),
            'kepangkatan' => 'IV A',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '5',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryJabatanDosen::create([
            'encrypted_id' => Crypt::encrypt('5'),
            'jabatan' => 'Asisten Ahli',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '5',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        Dosen::create([
            'encrypt_id' => Crypt::encrypt('6'),
            'nip' => '179912312021',
            'nidn' => '1834567891',
            'nama_dosen' => 'Dr. Monika Reiniger, S.Si., M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1990-10-10',
            'tempat_lahir' => 'Lubuk Linggau',
            'alamat' => 'Bumi Cimahi Indah Blok A No. 10',
            'status' => 'Aktif',
            'user_id' => '13',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatDosen::create([
            'encrypted_id' => Crypt::encrypt('6'),
            'kepangkatan' => 'IV A',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '6',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryJabatanDosen::create([
            'encrypted_id' => Crypt::encrypt('6'),
            'jabatan' => 'Asisten Ahli',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '6',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        Dosen::create([
            'encrypt_id' => Crypt::encrypt('7'),
            'nip' => '109912312021',
            'nidn' => '1034567891',
            'nama_dosen' => 'Prof. Dr. Richard D. Harris, S.Si., M.Si., Ph.D.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1983-03-01',
            'tempat_lahir' => 'Medan',
            'alamat' => 'Jl. Merdeka No. 10, Blok C No. 3',
            'status' => 'Aktif',
            'user_id' => '14',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryPangkatDosen::create([
            'encrypted_id' => Crypt::encrypt('7'),
            'kepangkatan' => 'IV E',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '7',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        HistoryJabatanDosen::create([
            'encrypted_id' => Crypt::encrypt('7'),
            'jabatan' => 'Guru Besar',
            'tgl_sk' => '2020-08-30',
            'file_sk' => 'sk1.pdf',
            'dosen_id' => '7',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

    }
}
