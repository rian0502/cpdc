<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\BaseNPM;
use App\Models\BaSKP;
use App\Models\JadwalSKP;
use App\Models\Mahasiswa;
use App\Models\ModelSeminarKP;
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
    public function __construct($sheet1, $sheet2, $sheet3, $sheet4)
    {
        $this->sheet1 = $sheet1;
        $this->sheet2 = $sheet2;
        $this->sheet3 = $sheet3;
        $this->sheet4 = $sheet4;
    }
 

    public function handle()
    {
        try{
            $id_mahasiswa = [];
            foreach ($this->sheet1 as $key => $value) {
                if ($key > 0) {
                    DB::transaction(function () use ($value) {
                        BaseNPM::create([
                            'npm' => $value[0],
                            'status' => 'aktif',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $user = User::create([
                            'name' => $value[1],
                            'email' => $value[2],
                            'password' => bcrypt($value[0]),
                            'email_verified_at' => now(),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $user->assignRole(['mahasiswa', 'alumni']);
                        $mahasiswa = Mahasiswa::create([
                            'npm' => $value[0],
                            'nama_mahasiswa' => $value[1],
                            'tanggal_lahir' => $value[4],
                            'angkatan' => $value[5],
                            'tanggal_masuk' => $value[3],
                            'jenis_kelamin' => $value[6],
                            'semester' => '1',
                            'status' => 'Alumni',
                            'user_id' => $user->id,
                            'id_dosen' => $value[7],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $id_mahasiswa[] = $mahasiswa->id;
                    });
                }
            }
            foreach($this->sheet2 as $key => $value){
                if($key > 0){
                    DB::transaction(function () use ($value, $id_mahasiswa, $key) {
                        $kp = ModelSeminarKP::create([
                            'judul_kp' => $value[1],
                            'semester' => $value[2],
                            'tahun_akademik' => $value[3],
                            'mitra' => $value[4],   
                            'region' => $value[5],
                            'rencan_seminar' => $value[6],
                            'pembimbing_lapangan' => $value[7],
                            'ni_pemlap' => $value[8],   
                            'toefl' => $value[9],
                            'sks' => $value[10],
                            'ipk' => $value[11],
                            'berkas_seminar_pkl' => $value[12],
                            'aggrement' => 1,
                            'status_seminar' => 'Selesai',
                            'proses_admin' => 'Valid',
                            'id_dospemkp' => $value[13],
                            'id_mahasiswa' => $id_mahasiswa[$key-1],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        ModelSeminarKP::find($kp->id)->update([
                            'encrypt_id' => Crypt::encrypt($kp->id),
                        ]);
                        $jadwal = JadwalSKP::create([
                            'id_skp' => $kp->id,
                            'tanggal' => $value[14],
                            'jam_mulai_skp' => $value[15],
                            'jam_selesai_skp' => $value[16],
                            'id_lokasi' => $value[17],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        JadwalSKP::find($jadwal->id)->update([
                            'encrypt_id' => Crypt::encrypt($jadwal->id),
                        ]);
                        $ba = BaSKP::create([
                            'no_ba_seminar_kp' => $value[18],
                            'nilai_lapangan' => $value[19],
                            'nilai_akd' => $value[20],  
                            'nilai_akhir' => $value[21],
                            'nilai_mutu' => $value[22],
                            'berkas_ba_seminar_kp' => $value[23],
                            'laporan_kp' => $value[24],
                            'id_seminar' => $kp->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    });
                }
            }

        }catch(\Exception $e){
            User::whereHas('roles', function ($query) {
                $query->where('name', 'kajur');
            })->first();
            return $e->getMessage();
        }
    }
}
