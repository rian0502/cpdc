<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\ErrorMailImport;
use App\Models\BaseNPM;
use App\Models\Mahasiswa;
use App\Models\ModelKompreS2;
use Illuminate\Bus\Queueable;
use App\Models\ModelSeminarTaDuaS2;
use App\Models\ModelBaSeminarKompre;
use App\Models\ModelSeminarTaSatuS2;
use App\Models\ModelBaSeminarTaDuaS2;
use App\Models\ModelBaSeminarTaSatuS2;
use Illuminate\Queue\SerializesModels;
use App\Models\ModelJadwalSeminarTaSatu;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ModelJadwalSeminarTaDuaS2;
use App\Models\ModelJadwalSeminarKompreS2;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ImportMahasiswaS2Job implements ShouldQueue
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


    public function __construct($sheet1, $sheet2, $sheet3, $sheet4)
    {
        $this->sheet1 = $sheet1;
        $this->sheet2 = $sheet2;
        $this->sheet3 = $sheet3;
        $this->sheet4 = $sheet4;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::transaction(function () {
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
                    $user->assignRole(['mahasiswaS2', 'alumniS2']);
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
                    //tugas akhir 1
                    $data_ta1 = [
                        'tahun_akademik' => $this->sheet2[$key][1],
                        'semester' => $this->sheet2[$key][2],
                        'sumber_penelitian' => 'Dosen',
                        'periode_seminar' => $this->sheet2[$key][3],
                        'judul_ta' => $this->sheet2[$key][4],
                        'sks' => $this->sheet2[$key][5],
                        'ipk' => $this->sheet2[$key][6],
                        'toefl' => $this->sheet2[$key][7],
                        'berkas_ta_satu' => $this->sheet2[$key][8],
                        'agreement' => 1,
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $this->sheet2[$key][9],
                        'id_pembimbing_dua' => ($this->sheet2[$key][10] ? $this->sheet2[$key][10] : null),
                        'pbl2_nama' => ($this->sheet2[$key][11] ? $this->sheet2[$key][11] : null),
                        'pbl2_nip' => ($this->sheet2[$key][12] ? $this->sheet2[$key][12] : null),
                        'id_pembahas_1' => ($this->sheet2[$key][13] ? $this->sheet2[$key][13] : null),
                        'id_pembahas_2' => ($this->sheet2[$key][14] ? $this->sheet2[$key][14] : null),
                        'id_pembahas_3' => ($this->sheet2[$key][15] ? $this->sheet2[$key][15] : null),
                        'pembahas_external_1' => ($this->sheet2[$key][16] ? $this->sheet2[$key][16] : null),
                        'nip_pembahas_external_1' => ($this->sheet2[$key][17] ? $this->sheet2[$key][17] : null),
                        'pembahas_external_2' => ($this->sheet2[$key][18] ? $this->sheet2[$key][18] : null),
                        'nip_pembahas_external_2' => ($this->sheet2[$key][19] ? $this->sheet2[$key][19] : null),
                        'pembahas_external_3' => ($this->sheet2[$key][20] ? $this->sheet2[$key][20] : null),
                        'nip_pembahas_external_3' => ($this->sheet2[$key][21] ? $this->sheet2[$key][21] : null),
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $ta1 = ModelSeminarTaSatuS2::create($data_ta1);
                    ModelSeminarTaSatuS2::where('id', $ta1->id)->update([
                        'encrypt_id' => Crypt::encrypt($ta1->id),
                    ]);
                    $jawdal_ta1 = ModelJadwalSeminarTaSatu::create([
                        'tanggal' => $this->sheet2[$key][22],
                        'jam_mulai' => $this->sheet2[$key][23],
                        'jam_selesai' => $this->sheet2[$key][24],
                        'id_lokasi' => $this->sheet2[$key][25],
                        'id_seminar' => $ta1->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelJadwalSeminarTaSatu::where('id', $jawdal_ta1->id)->update([
                        'encrypt_id' => Crypt::encrypt($jawdal_ta1->id),
                    ]);
                    $ba_ta1 = ModelBaSeminarTaSatuS2::create([
                        'no_ba' => $this->sheet2[$key][26],
                        'nilai' => $this->sheet2[$key][27],
                        'nilai_mutu' => $this->sheet2[$key][28],
                        'ppt' => $this->sheet2[$key][29],
                        'file_ba' => $this->sheet2[$key][30],
                        'file_nilai' => $this->sheet2[$key][31],
                        'id_seminar' => $ta1->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelBaSeminarTaSatuS2::where('id', $ba_ta1->id)->update([
                        'encrypt_id' => Crypt::encrypt($ba_ta1->id),
                    ]);
                    //tugas akhir 2
                    $ta_2 = ModelSeminarTaDuaS2::create([
                        'tahun_akademik' => $this->sheet2[$key][1],
                        'semester' => $this->sheet2[$key][2],
                        'periode_seminar' => $this->sheet2[$key][3],
                        'judul_ta' => $this->sheet2[$key][4],
                        'sks' => $this->sheet2[$key][5],
                        'ipk' => $this->sheet2[$key][6],
                        'toefl' => $this->sheet2[$key][7],
                        'berkas_ta_dua' => $this->sheet2[$key][8],
                        'agreement' => 1,
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $this->sheet2[$key][9],
                        'id_pembimbing_dua' => ($this->sheet2[$key][10] ? $this->sheet2[$key][10] : null),
                        'pbl2_nama' => ($this->sheet2[$key][11] ? $this->sheet2[$key][11] : null),
                        'pbl2_nip' => ($this->sheet2[$key][12] ? $this->sheet2[$key][12] : null),
                        'id_pembahas_1' => ($this->sheet2[$key][13] ? $this->sheet2[$key][13] : null),
                        'id_pembahas_2' => ($this->sheet2[$key][14] ? $this->sheet2[$key][14] : null),
                        'id_pembahas_3' => ($this->sheet2[$key][15] ? $this->sheet2[$key][15] : null),
                        'pembahas_external_1' => ($this->sheet2[$key][16] ? $this->sheet2[$key][16] : null),
                        'nip_pembahas_external_1' => ($this->sheet2[$key][17] ? $this->sheet2[$key][17] : null),
                        'pembahas_external_2' => ($this->sheet2[$key][18] ? $this->sheet2[$key][18] : null),
                        'nip_pembahas_external_2' => ($this->sheet2[$key][19] ? $this->sheet2[$key][19] : null),
                        'pembahas_external_3' => ($this->sheet2[$key][20] ? $this->sheet2[$key][20] : null),
                        'nip_pembahas_external_3' => ($this->sheet2[$key][21] ? $this->sheet2[$key][21] : null),
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelSeminarTaDuaS2::where('id', $ta_2->id)->update([
                        'encrypt_id' => Crypt::encrypt($ta_2->id),
                    ]);
                    $jadwal_ta2 = ModelJadwalSeminarTaDuaS2::create([
                        'tanggal' => $this->sheet2[$key][22],
                        'jam_mulai' => $this->sheet2[$key][23],
                        'jam_selesai' => $this->sheet2[$key][24],
                        'id_lokasi' => $this->sheet2[$key][25],
                        'id_seminar' => $ta_2->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelJadwalSeminarTaDuaS2::where('id', $jadwal_ta2->id)->update([
                        'encrypt_id' => Crypt::encrypt($jadwal_ta2->id),
                    ]);
                    $ba_ta_2 = ModelBaSeminarTaDuaS2::create([
                        'no_ba' => $this->sheet3[$key][26],
                        'nilai' => $this->sheet3[$key][27],
                        'nilai_mutu' => $this->sheet3[$key][28],
                        'ppt' => $this->sheet3[$key][29],
                        'file_ba' => $this->sheet3[$key][30],
                        'file_nilai' => $this->sheet3[$key][31],
                        'id_seminar' => $ta_2->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelBaSeminarTaDuaS2::where('id', $ba_ta_2->id)->update([
                        'encrypt_id' => Crypt::encrypt($ba_ta_2->id),
                    ]);
                    //komprehensif
                    $komprehensif = ModelKompreS2::create([
                        'tahun_akademik' => $this->sheet2[$key][1],
                        'semester' => $this->sheet2[$key][2],
                        'periode_seminar' => $this->sheet2[$key][3],
                        'judul_ta' => $this->sheet2[$key][4],
                        'sks' => $this->sheet2[$key][5],
                        'ipk' => $this->sheet2[$key][6],
                        'toefl' => $this->sheet2[$key][7],
                        'berkas_kompre' => $this->sheet2[$key][8],
                        'agreement' => 1,
                        'draft_artikel' => $this->sheet2[$key][22],
                        'url_draft_artikel' => $this->sheet2[$key][22],
                        'status_admin' => 'Valid',
                        'status_koor' => 'Selesai',
                        'id_pembimbing_satu' => $this->sheet2[$key][9],
                        'id_pembimbing_dua' => ($this->sheet2[$key][10] ? $this->sheet2[$key][10] : null),
                        'pbl2_nama' => ($this->sheet2[$key][11] ? $this->sheet2[$key][11] : null),
                        'pbl2_nip' => ($this->sheet2[$key][12] ? $this->sheet2[$key][12] : null),
                        'id_pembahas_1' => ($this->sheet2[$key][13] ? $this->sheet2[$key][13] : null),
                        'id_pembahas_2' => ($this->sheet2[$key][14] ? $this->sheet2[$key][14] : null),
                        'id_pembahas_3' => ($this->sheet2[$key][15] ? $this->sheet2[$key][15] : null),
                        'pembahas_external_1' => ($this->sheet2[$key][16] ? $this->sheet2[$key][16] : null),
                        'nip_pembahas_external_1' => ($this->sheet2[$key][17] ? $this->sheet2[$key][17] : null),
                        'pembahas_external_2' => ($this->sheet2[$key][18] ? $this->sheet2[$key][18] : null),
                        'nip_pembahas_external_2' => ($this->sheet2[$key][19] ? $this->sheet2[$key][19] : null),
                        'pembahas_external_3' => ($this->sheet2[$key][20] ? $this->sheet2[$key][20] : null),
                        'nip_pembahas_external_3' => ($this->sheet2[$key][21] ? $this->sheet2[$key][21] : null),
                        'id_mahasiswa' => $mahasiswa->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelKompreS2::where('id', $komprehensif->id)->update([
                        'encrypt_id' => Crypt::encrypt($komprehensif->id),
                    ]);
                    $jadwal_kompre = ModelJadwalSeminarKompreS2::create([
                        'tanggal' => $this->sheet2[$key][23],
                        'jam_mulai' => $this->sheet2[$key][24],
                        'jam_selesai' => $this->sheet2[$key][25],
                        'id_lokasi' => $this->sheet2[$key][26],
                        'id_seminar' => $komprehensif->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    ModelJadwalSeminarKompreS2::where('id', $jadwal_kompre->id)->update([
                        'encrypt_id' => Crypt::encrypt($jadwal_kompre->id),
                    ]);
                    $ba_kompre = ModelBaSeminarKompre::create([
                        'no_ba' => $this->sheet4[$key][27],
                        'nilai' => $this->sheet4[$key][28],
                        'nilai_mutu' => $this->sheet4[$key][29],
                        'pengesahan' => $this->sheet4[$key][30],
                        'file_ba' => $this->sheet4[$key][31],
                        'file_nilai' => $this->sheet4[$key][32],
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
                'title' => 'Error Import Mahasiswa S2',
                'messages' => $e->getMessage(),
                'nama' => $user->name,
            ];
            $email = new ErrorMailImport($data);
            Mail::to('zakimubarok551@gmail.com')->send($email);
        }
    }
}
