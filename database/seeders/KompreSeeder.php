<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelSeminarKompre;
use App\Models\ModelBaSeminarKompre;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarKompre;

class KompreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ta1 = [
            'encrypt_id' => Crypt::encrypt('1'),
            'tahun_akademik' => '2020/2021',
            'semester' => 'Ganjil',
            'periode_seminar' => 'Jun 2023',
            'judul_ta' => 'Pengembangan Sistem Informasi Akademik Berbasis Web Pada STMIK Bandung',
            'sks' => '144',
            'ipk' => '3.5',
            'toefl' => '500',
            'berkas_kompre' => 'ta1.pdf',
            'agreement' => '1',
            'komentar' => null,
            'status_admin' => 'Valid',
            'status_koor' => 'Selesai',
            'id_pembimbing_satu' => '1',
            'id_pembimbing_dua' => '2',
            'id_pembahas' => '3',
            'id_mahasiswa' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ta1 = ModelSeminarKompre::create($ta1);
        $jadwal = [
            'encrypt_id' => Crypt::encrypt('1'),
            'tanggal_komprehensif' => '2023-06-29',
            'jam_mulai_komprehensif' => '08:00',
            'jam_selesai_komprehensif' => '10:00',
            'id_lokasi' => '1',
            'id_seminar' => $ta1->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $jadwal_ta1 = ModelJadwalSeminarKompre::create($jadwal);

        $berita_acara = [
            'encrypt_id' => Crypt::encrypt('1'),
            'no_ba_berkas' => 'BA/STMIK-Bandung/2021/1',
            'ba_seminar_komprehensif' => 'ba_seminar_ta1.pdf',
            'berkas_nilai_kompre' => 'nilai_seminar_ta1.pdf',
            'laporan_ta' => 'https://drive',
            'nilai' => 80.5,
            'huruf_mutu' => 'A',
            'id_seminar' => $ta1->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ba = ModelBaSeminarKompre::create($berita_acara);

        //mahasiswa 2
        $ta2 = [
            'encrypt_id' => Crypt::encrypt('2'),
            'tahun_akademik' => '2020/2021',
            'semester' => 'Ganjil',
            'periode_seminar' => 'Jun 2023',
            'judul_ta' => 'Analisis Kimia Pada Air Sungai Citarum Menggunakan Metode Spektrofotometri',
            'sks' => '144',
            'ipk' => '3.5',
            'toefl' => '500',
            'berkas_kompre' => 'ta1.pdf',
            'agreement' => '1',
            'komentar' => null,
            'status_admin' => 'Valid',
            'status_koor' => 'Selesai',
            'id_pembimbing_satu' => '5',
            'pbl2_nama' => 'Dr. Eng. Budi',
            'pbl2_nip' => '123456789123456789',
            'id_pembahas' => '1',
            'id_mahasiswa' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ta2 = ModelSeminarKompre::create($ta2);
        $jadwal2 = [
            'encrypt_id' => Crypt::encrypt('2'),
            'tanggal_komprehensif' => '2023-06-29',
            'jam_mulai_komprehensif' => '08:00',
            'jam_selesai_komprehensif' => '10:00',
            'id_lokasi' => '2',
            'id_seminar' => $ta2->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $jadwal_ta2 = ModelJadwalSeminarKompre::create($jadwal2);

        $berita_acara2 = [
            'encrypt_id' => Crypt::encrypt('2'),
            'no_ba_berkas' => 'BA/UNIKOM/2021/1',
            'ba_seminar_komprehensif' => 'ba_seminar_ta1.pdf',
            'berkas_nilai_kompre' => 'nilai_seminar_ta1.pdf',
            'laporan_ta' => 'https://drive',
            'nilai' => 80.5,
            'huruf_mutu' => 'A',
            'id_seminar' => $ta2->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ba2 = ModelBaSeminarKompre::create($berita_acara2);

        //mahasiswa 3
        $ta3 = [
            'encrypt_id' => Crypt::encrypt('3'),
            'tahun_akademik' => '2020/2021',
            'semester' => 'Ganjil',
            'periode_seminar' => 'Jun 2023',
            'judul_ta' => 'Sintesis dan Karakterisasi Nanomaterial Berbasis Grafena untuk Aplikasi Sensor Gas',
            'sks' => '144',
            'ipk' => '3.5',
            'toefl' => '500',
            'berkas_kompre' => 'ta1.pdf',
            'agreement' => '1',
            'komentar' => null,
            'status_admin' => 'Valid',
            'status_koor' => 'Selesai',
            'id_pembimbing_satu' => '2',
            'id_pembimbing_dua' => '4',
            'id_pembahas' => '1',
            'id_mahasiswa' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ta3 = ModelSeminarKompre::create($ta3);
        $jadwal = [
            'encrypt_id' => Crypt::encrypt('3'),
            'tanggal_komprehensif' => '2023-06-29',
            'jam_mulai_komprehensif' => '08:00',
            'jam_selesai_komprehensif' => '10:00',
            'id_lokasi' => '1',
            'id_seminar' => $ta3->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $jadwal_ta3 = ModelJadwalSeminarKompre::create($jadwal);

        $berita_acara = [
            'encrypt_id' => Crypt::encrypt('3'),
            'no_ba_berkas' => 'BA/STMIK-Bandung/2021/1',
            'ba_seminar_komprehensif' => 'ba_seminar_ta1.pdf',
            'berkas_nilai_kompre' => 'nilai_seminar_ta1.pdf',
            'laporan_ta' => 'https://drive',
            'nilai' => 80.5,
            'huruf_mutu' => 'A',
            'id_seminar' => $ta3->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ba = ModelBaSeminarKompre::create($berita_acara);


        $ta2 = [
            'encrypt_id' => Crypt::encrypt('4'),
            'tahun_akademik' => '2020/2021',
            'semester' => 'Ganjil',
            'periode_seminar' => 'Jun 2023',
            'judul_ta' => 'Studi Pengaruh Variasi Suhu dan Waktu Pada Proses Pirolisis Limbah Plastik untuk Mendapatkan Bahan Bakar Alternatif',
            'sks' => '144',
            'ipk' => '3.5',
            'toefl' => '500',
            'berkas_kompre' => 'ta1.pdf',
            'agreement' => '1',
            'komentar' => null,
            'status_admin' => 'Valid',
            'status_koor' => 'Selesai',
            'id_pembimbing_satu' => '5',
            'pbl2_nama' => 'Dr. Eng. Budi',
            'pbl2_nip' => '123456789123456789',
            'id_pembahas' => '1',
            'id_mahasiswa' => '4',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ta2 = ModelSeminarKompre::create($ta2);
        $jadwal2 = [
            'encrypt_id' => Crypt::encrypt('4'),
            'tanggal_komprehensif' => '2023-06-29',
            'jam_mulai_komprehensif' => '08:00',
            'jam_selesai_komprehensif' => '10:00',
            'id_lokasi' => '2',
            'id_seminar' => $ta2->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $jadwal_ta2 = ModelJadwalSeminarKompre::create($jadwal2);

        $berita_acara2 = [
            'encrypt_id' => Crypt::encrypt('4'),
            'no_ba_berkas' => 'BA/UNIKOM/2021/1',
            'ba_seminar_komprehensif' => 'ba_seminar_ta1.pdf',
            'berkas_nilai_kompre' => 'nilai_seminar_ta1.pdf',
            'laporan_ta' => 'https://drive',
            'nilai' => 80.5,
            'huruf_mutu' => 'A',
            'id_seminar' => $ta2->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ba2 = ModelBaSeminarKompre::create($berita_acara2);
    }
}
