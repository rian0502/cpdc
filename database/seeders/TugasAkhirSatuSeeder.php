<?php

namespace Database\Seeders;

use App\Models\ModelBaSeminarTaSatu;
use App\Models\ModelSeminarTaSatu;
use App\Models\ModelJadwalSeminarTaSatu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;


class TugasAkhirSatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ta1 = [
            'encrypt_id' => Crypt::encrypt('1'),
            'tahun_akademik' => '2020/2021',
            'semester' => 'Ganjil',
            'periode_seminar' => 'Jun 2023',
            'judul_ta' => 'Pengembangan Sistem Informasi Akademik Berbasis Web Pada STMIK Bandung',
            'sks' => '144',
            'ipk' => '3.5',
            'toefl' => '500',
            'berkas_ta_satu' => 'ta1.pdf',
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
        $ta1 = ModelSeminarTaSatu::create($ta1);
        $jadwal = [
            'encrypt_id' => Crypt::encrypt('1'),
            'tanggal_seminar_ta_satu' => '2023-06-29',
            'jam_mulai_seminar_ta_satu' => '08:00',
            'jam_selesai_seminar_ta_satu' => '10:00',
            'id_lokasi' => '1',
            'id_seminar' => $ta1->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $jadwal_ta1 = ModelJadwalSeminarTaSatu::create($jadwal);

        $berita_acara = [
            'encrypt_id' => Crypt::encrypt('1'),
            'no_berkas_ba_seminar_ta_satu' => 'BA/STMIK-Bandung/2021/1',
            'berkas_ba_seminar_ta_satu' => 'ba_seminar_ta1.pdf',
            'berkas_nilai_seminar_ta_satu' => 'nilai_seminar_ta1.pdf',
            'berkas_ppt_seminar_ta_satu' => 'https://drive',
            'nilai' => 80.5,
            'huruf_mutu' => 'A',
            'id_seminar' => $ta1->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $ba = ModelBaSeminarTaSatu::create($berita_acara);
    }
}
