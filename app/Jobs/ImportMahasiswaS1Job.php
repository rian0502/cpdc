<?php

namespace App\Jobs;

use App\Mail\ErrorMailImport;
use App\Models\BaseNPM;
use App\Models\User;
use App\Models\BaSKP;
use App\Models\JadwalSKP;
use App\Models\Mahasiswa;
use App\Models\ModelBaSeminarKompre;
use App\Models\ModelBaSeminarTaDua;
use App\Models\ModelBaSeminarTaSatu;
use App\Models\ModelJadwalSeminarKompre;
use App\Models\ModelJadwalSeminarTaDua;
use App\Models\ModelJadwalSeminarTaSatu;
use App\Models\ModelSeminarKompre;
use App\Models\ModelSeminarKP;
use App\Models\ModelSeminarTaDua;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class ImportMahasiswaS1Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $sheet1;
    private $sheet2;
    private $sheet3;
    private $sheet4;
    private $sheet5;

    public function __construct($sheet1, $sheet2, $sheet3, $sheet4, $sheet5)
    {
        $this->sheet1 = $sheet1;
        $this->sheet2 = $sheet2;
        $this->sheet3 = $sheet3;
        $this->sheet4 = $sheet4;
        $this->sheet5 = $sheet5;
    }


    public function handle()
    {
        try {
            Db::transaction(function () {
                foreach ($this->sheet1 as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }
                    $findUser = User::where('email', $value[2])->count();
                    if ($findUser > 0) {
                        continue;
                    }
                    $user = new User();
                    $user->name = $value[1];
                    $user->email = $value[2];
                    $user->password = bcrypt('cpdc');
                    $user->email_verified_at = now();
                    $user->save();
                    $user->assignRole(['mahasiswa', 'alumni']);
                    BaseNPM::create([
                        'npm' => $value[0],
                        'status' => 'Aktif',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    Mahasiswa::create([
                        'npm' => $value[0],
                        'nama_mahasiswa' => $value[1],
                        'tanggal_lahir' => $value[5],
                        'tempat_lahir' => 'dummy',
                        'no_hp' => '081234567890',
                        'alamat' => 'dummy',
                        'jenis_kelamin' => $value[7],
                        'tanggal_masuk' => $value[4],
                        'angkatan' => $value[6],
                        'semester' => 8,
                        'status' => 'Alumni',
                        'id_dosen' => $value[8],
                        'user_id' => $user->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                foreach ($this->sheet2 as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }
                    $mahasiswa = Mahasiswa::with('seminar_kp')->where('npm', $value[0])->first();
                    if ($mahasiswa == null) {
                        continue;
                    }
                    if ($mahasiswa->seminar_kp != null) {
                        continue;
                    }
                    $seminarpkl = ModelSeminarKP::create([
                        'judul_kp' => $value[1],
                        'semester' => $value[2],
                        'tahun_akademik' => $value[3],
                        'mitra' => $value[4],
                        'region' => $value[5],
                        'rencana_seminar' => $value[6],
                        'pembimbing_lapangan' => $value[7],
                        'ni_pemlap' => $value[8],
                        'toefl' => $value[9],
                        'sks' => $value[10],
                        'ipk' => $value[11],
                        'berkas_seminar_pkl' => $value[12],
                        'agreement' => 1,
                        'status_seminar' => 'Selesai',
                        'proses_admin' => 'Valid',
                        'id_dospemkp' => $value[13],
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $seminarpkl->encrypt_id = Crypt::encrypt($seminarpkl->id);
                    $seminarpkl->save();
                    $jadwalKp = JadwalSKP::create([
                        'tanggal_skp' => $value[14],
                        'jam_mulai_skp' => $value[15],
                        'jam_selesai_skp' => $value[16],
                        'id_skp' => $seminarpkl->id,
                        'id_lokasi' => $value[17],
                    ]);
                    $jadwalKp->encrypt_id = Crypt::encrypt($jadwalKp->id);
                    $jadwalKp->save();
                    $baSkp = BaSKP::create([
                        'no_ba_seminar_kp' => $value[18],
                        'nilai_lapangan' => $value[19],
                        'nilai_akd' => $value[20],
                        'nilai_akhir' => $value[21],
                        'nilai_mutu' => $value[22],
                        'berkas_ba_seminar_kp' => $value[23],
                        'laporan_kp' => $value[24],
                        'id_seminar' => $seminarpkl->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $baSkp->encrypt_id = Crypt::encrypt($baSkp->id);
                    $baSkp->save();
                }
                foreach ($this->sheet3 as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }
                    $mahasiswa = Mahasiswa::with('ta_satu')->where('npm', $value[0])->first();
                    if ($mahasiswa == null) {
                        continue;
                    }
                    if ($mahasiswa->ta_satu != null) {
                        continue;
                    }
                    $seminarTA1 = ModelSeminarTaSatu::create([
                        'tahun_akademik' => $value[1] ?? '2023/2024',
                        'semester' => $value[2] ?? 'Genap',
                        'periode_seminar' => $value[3] ?? '-',
                        'judul_ta' => $value[4] ?? '-',
                        'sumber_penelitian' => "Dosen",
                        'sks' => $value[5] ?? 0,
                        'ipk' => $value[6] ?? 0,
                        'toefl' => $value[7] ?? 0,
                        'berkas_ta_satu' => $value[8],
                        'agreement' => 1,
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $value[9] ?? 1,
                        'id_pembimbing_dua' => ($value[10] == null) ? null : $value[10],
                        'pbl2_nama' => ($value[10] == null) ? null : $value[11],
                        'pbl2_nip' => ($value[10] == null) ? null : $value[12],
                        'id_pembahas' => $value[13] ?? 1,
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $seminarTA1->encrypt_id = Crypt::encrypt($seminarTA1->id);
                    $seminarTA1->save();
                    $jadwalSeminarTA1 = ModelJadwalSeminarTaSatu::create([
                        'tanggal_seminar_ta_satu' => $value[14],
                        'jam_mulai_seminar_ta_satu' => $value[15],
                        'jam_selesai_seminar_ta_satu' => $value[16],
                        'id_lokasi' => $value[17],
                        'id_seminar' => $seminarTA1->id,
                    ]);
                    $jadwalSeminarTA1->encrypt_id = Crypt::encrypt($jadwalSeminarTA1->id);
                    $jadwalSeminarTA1->save();
                    $ba_ta1 = ModelBaSeminarTaSatu::create([
                        'no_berkas_ba_seminar_ta_satu' => $value[18],
                        'berkas_ba_seminar_ta_satu' => $value[19],
                        'berkas_nilai_seminar_ta_satu' => $value[20],
                        'berkas_ppt_seminar_ta_satu' => $value[21],
                        'nilai' => $value[22],
                        'huruf_mutu' => $value[23],
                        'id_seminar' => $seminarTA1->id,
                    ]);
                    $ba_ta1->encrypt_id = Crypt::encrypt($ba_ta1->id);
                    $ba_ta1->save();
                }
                foreach ($this->sheet4 as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }
                    $mahasiswa = Mahasiswa::with(['ta_dua', 'ta_satu'])->where('npm', $value[0])->first();
                    if ($mahasiswa == null) {
                        continue;
                    }
                    if ($mahasiswa->ta_dua != null || $mahasiswa->ta_satu == null) {
                        continue;
                    }
                    $semianrTA2 = ModelSeminarTaDua::create([
                        'tahun_akademik' => $value[1] ?? '2023/2024',
                        'semester' => $value[2] ?? 'Genap',
                        'periode_seminar' => $value[3] ?? '-',
                        'judul_ta' => $value[4] ?? '-',
                        'sks' => $value[5] ?? 0,
                        'ipk' => $value[6] ?? 0,
                        'toefl' => $value[7] ?? 0,
                        'berkas_ta_dua' => $value[8],
                        'agreement' => 1,
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $value[9] ?? 1,
                        'id_pembimbing_dua' => ($value[10] == null) ? null : $value[10],
                        'pbl2_nama' => ($value[10] == null) ? null : $value[11],
                        'pbl2_nip' => ($value[10] == null) ? null : $value[12],
                        'id_pembahas' => $value[13] ?? 1,
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $semianrTA2->encrypt_id = Crypt::encrypt($semianrTA2->id);
                    $semianrTA2->save();
                    $jadwalSeminarTA2 = ModelJadwalSeminarTaDua::create([
                        'tanggal_seminar_ta_dua' => $value[14],
                        'jam_mulai_seminar_ta_dua' => $value[15],
                        'jam_selesai_seminar_ta_dua' => $value[16],
                        'id_lokasi' => $value[17],
                        'id_seminar' => $semianrTA2->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $jadwalSeminarTA2->encrypt_id = Crypt::encrypt($jadwalSeminarTA2->id);
                    $jadwalSeminarTA2->save();
                    $ba_ta2 = ModelBaSeminarTaDua::create([
                        'no_berkas_ba_seminar_ta_dua' => $value[18],
                        'berkas_ba_seminar_ta_dua' => $value[19],
                        'berkas_nilai_seminar_ta_dua' => $value[20],
                        'berkas_ppt_seminar_ta_dua' => $value[21],
                        'nilai' => $value[22],
                        'huruf_mutu' => $value[23],
                        'id_seminar' => $semianrTA2->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $ba_ta2->encrypt_id = Crypt::encrypt($ba_ta2->id);
                    $ba_ta2->save();
                }
                foreach ($this->sheet5 as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }
                    $mahasiswa = Mahasiswa::with(['komprehensif', 'ta_dua'])->where('npm', $value[0])->first();
                    if ($mahasiswa == null) {
                        continue;
                    }
                    if ($mahasiswa->ta_dua == null || $mahasiswa->komprehensif != null) {
                        continue;
                    }
                    $kompre = ModelSeminarKompre::create([
                        'tahun_akademik' => $value[1],
                        'semester' => $value[2],
                        'periode_seminar' => $value[3],
                        'judul_ta' => $value[4],
                        'sks' => $value[5],
                        'ipk' => $value[6],
                        'toefl' => $value[7],
                        'berkas_kompre' => $value[8],
                        'agreement' => 1,
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $value[9],
                        'id_pembimbing_dua' => ($value[10] == null) ? null : $value[10],
                        'pbl2_nama' => ($value[10] == null) ? null : $value[11],
                        'pbl2_nip' => ($value[10] == null) ? null : $value[12],
                        'id_pembahas' => $value[13],
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $kompre->encrypt_id = Crypt::encrypt($kompre->id);
                    $kompre->save();
                    $jadwalKompre = ModelJadwalSeminarKompre::create([
                        'tanggal_komprehensif' => $value[14],
                        'jam_mulai_komprehensif' => $value[15],
                        'jam_selesai_komprehensif' => $value[16],
                        'id_lokasi' => $value[17],
                        'id_seminar' => $kompre->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $jadwalKompre->encrypt_id = Crypt::encrypt($jadwalKompre->id);
                    $jadwalKompre->save();
                    $baKompre = ModelBaSeminarKompre::create([
                        'ba_seminar_komprehensif' => $value[18],
                        'no_ba_berkas' => $value[19],
                        'berkas_nilai_kompre' => $value[20],
                        'laporan_ta' => $value[21],
                        'nilai' => $value[22],
                        'huruf_mutu' => $value[23],
                        'id_seminar' => $kompre->id,
                    ]);
                    $baKompre->encrypt_id = Crypt::encrypt($baKompre->id);
                    $baKompre->save();
                }
            });
        } catch (\Exception $e) {
            $user = User::whereHas('roles', function ($query) {
                $query->where('name', 'jurusan');
            })->first();
            $data = [
                'title' => 'Error Import Mahasiswa S1',
                'messages' => $e->getMessage(),
                'nama' => $user->name,
            ];
            $email = new ErrorMailImport($data);
            Mail::to('zakimubarok551@gmail.com')->send($email);
        }
    }
}
