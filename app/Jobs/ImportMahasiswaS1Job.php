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
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Predis\Client;

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
                    $mahasiswa = Mahasiswa::create([
                        'npm' => $value[0],
                        'nama_mahasiswa' => $value[1],
                        'tanggal_lahir' => $value[4],
                        'tempat_lahir' => 'dummy',
                        'no_hp' => '081234567890',
                        'alamat' => 'dummy',
                        'jenis_kelamin' => $value[6],
                        'tanggal_masuk' => $value[3],
                        'angkatan' => $value[5],
                        'semester' => 8,
                        'status' => 'Alumni',
                        'id_dosen' => $value[7],
                        'user_id' => $user->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $skp = ModelSeminarKP::create([
                        'judul_kp' => $this->sheet2[$key][1],
                        'semester' => $this->sheet2[$key][2],
                        'tahun_akademik' => $this->sheet2[$key][3],
                        'mitra' => $this->sheet2[$key][4],
                        'region' => $this->sheet2[$key][5],
                        'rencana_seminar' => $this->sheet2[$key][6],
                        'pembimbing_lapangan' => $this->sheet2[$key][7],
                        'ni_pemlap' => $this->sheet2[$key][8],
                        'toefl' => $this->sheet2[$key][9],
                        'sks' => $this->sheet2[$key][10],
                        'ipk' => $this->sheet2[$key][11],
                        'berkas_seminar_pkl' => $this->sheet2[$key][12],
                        'agreement' => 1,
                        'status_seminar' => 'Selesai',
                        'proses_admin' => 'Valid',
                        'id_dospemkp' => $this->sheet2[$key][13],
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelSeminarKP::where('id', $skp->id)->update([
                        'encrypt_id' => Crypt::encrypt($skp->id),
                    ]);
                    $jadwal = JadwalSKP::create([
                        'tanggal_skp' => $this->sheet2[$key][14],
                        'jam_mulai_skp' => $this->sheet2[$key][15],
                        'jam_selesai_skp' => $this->sheet2[$key][16],
                        'id_lokasi' => Crypt::decrypt($this->sheet2[$key][17]),
                        'id_skp' => $skp->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    JadwalSKP::where('id', $jadwal->id)->update([
                        'encrypt_id' => Crypt::encrypt($jadwal->id),
                    ]);
                    $ba_skp = BaSKP::create([
                        'no_ba_seminar_kp' => $this->sheet2[$key][18],
                        'nilai_lapangan' => $this->sheet2[$key][19],
                        'nilai_akd' => $this->sheet2[$key][20],
                        'nilai_akhir' => $this->sheet2[$key][21],
                        'nilai_mutu' => $this->sheet2[$key][22],
                        'berkas_ba_seminar_kp' => $this->sheet2[$key][23],
                        'laporan_kp' => $this->sheet2[$key][24],
                        'id_seminar' => $skp->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    BaSKP::where('id', $ba_skp->id)->update([
                        'encrypt_id' => Crypt::encrypt($ba_skp->id),
                    ]);

                    //tugas akhir 1
                    $data_ta1 = [
                        'tahun_akademik' => $this->sheet3[$key][1],
                        'semester' => $this->sheet3[$key][2],
                        'sumber_penelitian' => 'Dosen',
                        'periode_seminar' => $this->sheet3[$key][3],
                        'judul_ta' => $this->sheet3[$key][4],
                        'sks' => $this->sheet3[$key][5],
                        'ipk' => $this->sheet3[$key][6],
                        'toefl' => $this->sheet3[$key][7],
                        'berkas_ta_satu' => $this->sheet3[$key][8],
                        'agreement' => 1,
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $this->sheet3[$key][9],
                        'id_pembimbing_dua' => ($this->sheet3[$key][10] ? $this->sheet3[$key][10] : null),
                        'pbl2_nama' => ($this->sheet3[$key][11] ? $this->sheet3[$key][11] : null),
                        'pbl2_nip' => ($this->sheet3[$key][12] ? $this->sheet3[$key][12] : null),
                        'id_pembahas' => $this->sheet3[$key][13],
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $ta1 = ModelSeminarTaSatu::create($data_ta1);
                    ModelSeminarTaSatu::where('id', $ta1->id)->update([
                        'encrypt_id' => Crypt::encrypt($ta1->id),
                    ]);
                    $jawdal_ta1 = ModelJadwalSeminarTaSatu::create([
                        'tanggal_seminar_ta_satu' => $this->sheet3[$key][14],
                        'jam_mulai_seminar_ta_satu' => $this->sheet3[$key][15],
                        'jam_selesai_seminar_ta_satu' => $this->sheet3[$key][16],
                        'id_lokasi' => $this->sheet3[$key][17],
                        'id_seminar' => $ta1->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelJadwalSeminarTaSatu::where('id', $jawdal_ta1->id)->update([
                        'encrypt_id' => Crypt::encrypt($jawdal_ta1->id),
                    ]);
                    $ba_ta1 = ModelBaSeminarTaSatu::create([
                        'no_berkas_ba_seminar_ta_satu' => $this->sheet3[$key][18],
                        'berkas_ba_seminar_ta_satu' => $this->sheet3[$key][19],
                        'berkas_nilai_seminar_ta_satu' => $this->sheet3[$key][20],
                        'berkas_ppt_seminar_ta_satu' => $this->sheet3[$key][21],
                        'nilai' => $this->sheet3[$key][22],
                        'huruf_mutu' => $this->sheet3[$key][23],
                        'id_seminar' => $ta1->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelBaSeminarTaSatu::where('id', $ba_ta1->id)->update([
                        'encrypt_id' => Crypt::encrypt($ba_ta1->id),
                    ]);
                    //tugas akhir 2
                    $ta_2 = ModelSeminarTaDua::create([
                        'tahun_akademik' => $this->sheet4[$key][1],
                        'semester' => $this->sheet4[$key][2],
                        'periode_seminar' => $this->sheet4[$key][3],
                        'judul_ta' => $this->sheet4[$key][4],
                        'sks' => $this->sheet4[$key][5],
                        'ipk' => $this->sheet4[$key][6],
                        'toefl' => $this->sheet4[$key][7],
                        'berkas_ta_dua' => $this->sheet4[$key][8],
                        'agreement' => 1,
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $this->sheet4[$key][9],
                        'id_pembimbing_dua' => ($this->sheet4[$key][10] ? $this->sheet4[$key][10] : null),
                        'pbl2_nama' => ($this->sheet4[$key][11] ? $this->sheet4[$key][11] : null),
                        'pbl2_nip' => ($this->sheet4[$key][12] ? $this->sheet4[$key][12] : null),
                        'id_pembahas' => $this->sheet4[$key][13],
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelSeminarTaDua::where('id', $ta_2->id)->update([
                        'encrypt_id' => Crypt::encrypt($ta_2->id),
                    ]);
                    $jadwal_ta2 = ModelJadwalSeminarTaDua::create([
                        'tanggal_seminar_ta_dua' => $this->sheet4[$key][14],
                        'jam_mulai_seminar_ta_dua' => $this->sheet4[$key][15],
                        'jam_selesai_seminar_ta_dua' => $this->sheet4[$key][16],
                        'id_lokasi' => $this->sheet4[$key][17],
                        'id_seminar' => $ta_2->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelJadwalSeminarTaDua::where('id', $jadwal_ta2->id)->update([
                        'encrypt_id' => Crypt::encrypt($jadwal_ta2->id),
                    ]);
                    $ba_ta_2 = ModelBaSeminarTaDua::create([
                        'no_berkas_ba_seminar_ta_dua' => $this->sheet4[$key][18],
                        'berkas_ba_seminar_ta_dua' => $this->sheet4[$key][19],
                        'berkas_nilai_seminar_ta_dua' => $this->sheet4[$key][20],
                        'berkas_ppt_seminar_ta_dua' => $this->sheet4[$key][21],
                        'nilai' => $this->sheet4[$key][22],
                        'huruf_mutu' => $this->sheet4[$key][23],
                        'id_seminar' => $ta_2->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelBaSeminarTaDua::where('id', $ba_ta_2->id)->update([
                        'encrypt_id' => Crypt::encrypt($ba_ta_2->id),
                    ]);
                    //komprehensif
                    $komprehensif = ModelSeminarKompre::create([
                        'tahun_akademik' => $this->sheet5[$key][1],
                        'semester' => $this->sheet5[$key][2],
                        'periode_seminar' => $this->sheet5[$key][3],
                        'judul_ta' => $this->sheet5[$key][4],
                        'sks' => $this->sheet5[$key][5],
                        'ipk' => $this->sheet5[$key][6],
                        'toefl' => $this->sheet5[$key][7],
                        'berkas_kompre' => $this->sheet5[$key][8],
                        'agreement' => 1,
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $this->sheet5[$key][9],
                        'id_pembimbing_dua' => ($this->sheet5[$key][10] ? $this->sheet5[$key][10] : null),
                        'pbl2_nama' => ($this->sheet5[$key][11] ? $this->sheet5[$key][11] : null),
                        'pbl2_nip' => ($this->sheet5[$key][12] ? $this->sheet5[$key][12] : null),
                        'id_pembahas' => $this->sheet5[$key][13],
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelSeminarKompre::where('id', $komprehensif->id)->update([
                        'encrypt_id' => Crypt::encrypt($komprehensif->id),
                    ]);
                    $jadwal_kompre = ModelJadwalSeminarKompre::create([
                        'tanggal_komprehensif' => $this->sheet5[$key][14],
                        'jam_mulai_komprehensif' => $this->sheet5[$key][15],
                        'jam_selesai_komprehensif' => $this->sheet5[$key][16],
                        'id_lokasi' => $this->sheet5[$key][17],
                        'id_seminar' => $komprehensif->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelJadwalSeminarKompre::where('id', $jadwal_kompre->id)->update([
                        'encrypt_id' => Crypt::encrypt($jadwal_kompre->id),
                    ]);
                    $ba_kompre = ModelBaSeminarKompre::create([
                        'ba_seminar_komprehensif' => $this->sheet5[$key][18],
                        'no_ba_berkas' => $this->sheet5[$key][19],
                        'berkas_nilai_kompre' => $this->sheet5[$key][20],
                        'laporan_ta' => $this->sheet5[$key][21],
                        'nilai' => $this->sheet5[$key][22],
                        'huruf_mutu' => $this->sheet5[$key][23],
                        'id_seminar' => $komprehensif->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelBaSeminarKompre::where('id', $ba_kompre->id)->update([
                        'encrypt_id' => Crypt::encrypt($ba_kompre->id),
                    ]);
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
