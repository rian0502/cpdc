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
            'encrypt_id' => Crypt::encrypt('1'),
            'nip' => '197406112000031000',
            'nidn' => '0011067401',
            'nama_dosen' => 'Mulyono, S.Si., M.Si., Ph.D.',
            'no_hp' => '08117255001',
            'tanggal_lahir' => '1974-06-11',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
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
            'nip' => '196102031987031000',
            'nidn' => '0003026102',
            'nama_dosen' => 'Prof. Dr. Hardoko Insan Qudus, M.S',
            'no_hp' => '0811790460',
            'tanggal_lahir' => '1961-02-03',
            'tempat_lahir' => 'Dummy',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '2',
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
            'nip' => '196505251990032000',
            'nidn' => '0025056505',
            'nama_dosen' => 'Dr. Dra. Ilim, M.S.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081379510280',
            'tanggal_lahir' => '1965-05-25',
            'tempat_lahir' => 'Dymmy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '3',
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
            'nip' => '196904161994032000',
            'nidn' => '0016046905',
            'nama_dosen' => 'Prof . Dr. Buhani, M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '082176049777',
            'tanggal_lahir' => '1969-04-16',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '4',
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
            'nip' => '196905301995121000',
            'nidn' => '0030056903',
            'nama_dosen' => 'Prof. Ir. Suharso, S.Si., Ph.D.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '081368021035',
            'tanggal_lahir' => '1969-05-30',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Taman Cibaduyut Indah Blok A No. 10',
            'status' => 'Aktif',
            'user_id' => '5',
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
            'nip' => '197007052005011000',
            'nidn' => '005077009',
            'nama_dosen' => 'Dr. Agung Abadi Kiswandono, S.Si., M.Sc.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '081329121722',
            'tanggal_lahir' => '1970-07-05',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '6',
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
            'nip' => '197104142000032000',
            'nidn' => '0014047101',
            'nama_dosen' => 'Dr. Rinawati, Ph.D, S.Si, M.Si',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '087809507988',
            'tanggal_lahir' => '1971-04-14',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '7',
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

        Dosen::create([
            'encrypt_id' => Crypt::encrypt('8'),
            'nip' => '197108062000032000',
            'nidn' => '006087103',
            'nama_dosen' => 'Dr. Dian Herasari, M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081541281251',
            'tanggal_lahir' => '1971-08-06',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '8',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('9'),
            'nip' => '197110012005011000',
            'nidn' => '001107104',
            'nama_dosen' => 'Dr. Eng. Heri Satria, S.Si., M.Si.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '081379573510',
            'tanggal_lahir' => '1971-10-01',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '9',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        Dosen::create([
            'encrypt_id' => Crypt::encrypt('10'),
            'nip' => '197110301997031000',
            'nidn' => '0030107101',
            'nama_dosen' => 'Dr. Sonny Widiarto, S.Si., M.Sc.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '085267974746',
            'tanggal_lahir' => '1971-10-03',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '10',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('11'),
            'nip' => '197205302000032000',
            'nidn' => '000030057201',
            'nama_dosen' => 'Dr. Mita Rilyanti, S.Si., M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081289592903',
            'tanggal_lahir' => '1972-05-30',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '11',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);

        Dosen::create([
            'encrypt_id' => Crypt::encrypt('12'),
            'nip' => '197212051997032001',
            'nidn' => '0005127202',
            'nama_dosen' => 'Prof. Dr. Kamisah Delilawati Pandiangan, S.Si., M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081379284072',
            'tanggal_lahir' => '1972-12-05',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '12',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('13'),
            'nip' => '197308252000031001',
            'nidn' => '0025087305',
            'nama_dosen' => 'Syaiful Bahri, S.Si, M.Si',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '08112193499',
            'tanggal_lahir' => '1973-08-25',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '13',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('14'),
            'nip' => '197311191998022001',
            'nidn' => '0019117301',
            'nama_dosen' => 'Prof. Noviany, S.Si., M.Si, Ph.D.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081377792816',
            'tanggal_lahir' => '1973-11-19',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '14',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('15'),
            'nip' => '197406092005011002',
            'nidn' => '0009067406',
            'nama_dosen' => 'Diky Hidayat, S.Si., M.Sc.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '08112193499',
            'tanggal_lahir' => '1974-06-09',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '15',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('16'),
            'nip' => '197407052000031001',
            'nidn' => '0005077407',
            'nama_dosen' => 'Dr. Eng. Suripto Dwi Yuwono, S.Si., M.T.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '08117970046',
            'tanggal_lahir' => '1974-07-05',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '16',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('17'),
            'nip' => '197407172008122003',
            'nidn' => '0217077401',
            'nama_dosen' => 'Dr. Yuli Ambarwati, S.Si, M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081321119205',
            'tanggal_lahir' => '1974-07-17',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '17',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('18'),
            'nip' => '197412111998022001',
            'nidn' => '0011127404',
            'nama_dosen' => 'Dr. Nurhasanah, S.Si, M.Si',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '08127265028',
            'tanggal_lahir' => '1974-12-11',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '18',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('19'),
            'nip' => '197707132009122000',
            'nidn' => '0013077704',
            'nama_dosen' => 'Dr. Ni Luh Gede Ratna Juliasih, S.Si., M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '08112027674',
            'tanggal_lahir' => '1977-07-13',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '19',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('20'),
            'nip' => '198009082009122000',
            'nidn' => '0008098010',
            'nama_dosen' => 'Dian Septiani Pratama, S.Si., M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081369905628',
            'tanggal_lahir' => '1980-09-08',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '20',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('21'),
            'nip' => '199209272019032000',
            'nidn' => '0027099205',
            'nama_dosen' => 'Devi Nur Anisa, S.Pd., M.Sc',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081393320796',
            'tanggal_lahir' => '1992-09-27',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '21',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('22'),
            'nip' => '199304062019032000',
            'nidn' => '2006049301',
            'nama_dosen' => 'Hapin Afriyani, S.Si., M.Si.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '082279691292',
            'tanggal_lahir' => '1993-04-06',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '22',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('23'),
            'nip' => '195609051992031001',
            'nidn' => '0005095605',
            'nama_dosen' => 'Prof. Dr., Ir. Yandri A.S., M.S.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '0812345678900',
            'tanggal_lahir' => '1956-09-05',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '23',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('24'),
            'nip' => '195405101988032001',
            'nidn' => '0010055403',
            'nama_dosen' => 'Prof. Dr. Tati Suhartati, M.S.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '0812345678900',
            'tanggal_lahir' => '1954-05-10',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '24',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('25'),
            'nip' => '195907061988111001',
            'nidn' => '0007065904',
            'nama_dosen' => 'Prof. Wasinton Simanjuntak, M.Sc., Ph.D.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '0812345678900',
            'tanggal_lahir' => '1959-07-06',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '25',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('26'),
            'nip' => '196006161988111001',
            'nidn' => '0016066003',
            'nama_dosen' => 'Prof. Rudy T. Mangapul Situmeang, M.Sc., Ph.D.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '0812345678900',
            'tanggal_lahir' => '1960-06-16',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '26',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('27'),
            'nip' => '195810211987031001',
            'nidn' => '0021105809',
            'nama_dosen' => 'Prof. Drs. John Hendri,, M.S., Ph.D.',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '0812345678900',
            'tanggal_lahir' => '1958-10-21',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '27',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('28'),
            'nip' => '195809221988111001',
            'nidn' => '0022095803',
            'nama_dosen' => 'Prof. Andi Setiawan, M.Sc., Ph.D',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '0812345678900',
            'tanggal_lahir' => '1958-09-22',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '28',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('29'),
            'nip' => '196009091988112001',
            'nidn' => '0009096006',
            'nama_dosen' => 'Dra. Aspita Laila, M.S.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '0812345678900',
            'tanggal_lahir' => '1960-09-09',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '29',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
        Dosen::create([
            'encrypt_id' => Crypt::encrypt('30'),
            'nip' => '195901061986102001',
            'nidn' => '0006015902',
            'nama_dosen' => 'Dr. Zipora Sembiring, M.Si, Dra.',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '0812345678900',
            'tanggal_lahir' => '1959-01-06',
            'tempat_lahir' => 'Dummy',
            'alamat' => 'Dummy',
            'status' => 'Aktif',
            'user_id' => '30',
            'created_at' => '2020-08-30 00:00:00',
            'updated_at' => '2020-08-30 00:00:00',
        ]);
    }
}
