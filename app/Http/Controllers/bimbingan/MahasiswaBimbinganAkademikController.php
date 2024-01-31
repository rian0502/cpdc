<?php

namespace App\Http\Controllers\bimbingan;

use App\Models\Mahasiswa;
use App\Models\Laboratorium;
use App\Models\ModelKompreS2;
use App\Models\AktivitasAlumni;
use App\Models\ModelSeminarTaDua;
use App\Models\PrestasiMahasiswa;
use App\Models\AktivitasMahasiswa;
use App\Models\ModelSeminarKompre;
use App\Models\ModelSeminarTaSatu;
use App\Models\ModelSeminarTaDuaS2;
use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaSatuS2;

class MahasiswaBimbinganAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'mahasiswa' => Mahasiswa::select('id', 'nama_mahasiswa', 'npm', 'angkatan', 'id_dosen')->where('id_dosen', auth()->user()->dosen->id)->get(),
        ];
        return view('dosen.mahasiswa.bimbingan.akademik.index', $data);
    }
    public function Prestasi()
    {
        //
        $data = [
            'mahasiswa' => PrestasiMahasiswa::with('mahasiswa')->where('id_pembimbing', auth()->user()->dosen->id)->get(),
        ];
        // return dd($data);
        return view('dosen.mahasiswa.bimbingan.prestasi.index', $data);
    }
    public function lainnya()
    {
        //
        $data = [
            'mahasiswa' => AktivitasMahasiswa::with('mahasiswa')->where('id_pembimbing', auth()->user()->dosen->id)->get(),
        ];
        // return dd($data);
        return view('dosen.mahasiswa.bimbingan.lainnya.index', $data);
    }


    public function show($id)
    {

        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        if ($mahasiswa->user->hasRole('mahasiswa')) {
            $mahasiswa = Mahasiswa::where('npm', $id)->first();
            $seminarTa1 = ModelSeminarTaSatu::where('id_mahasiswa', $mahasiswa->id)->first();
            $seminarTa2 = ModelSeminarTaDua::where('id_mahasiswa', $mahasiswa->id)->first();
            $sidangKompre = ModelSeminarKompre::where('id_mahasiswa', $mahasiswa->id)->first();
            $data = [
                'mahasiswa' => $mahasiswa,
                'kp' => $mahasiswa->seminar_kp,
                'ta1' => $mahasiswa->ta_satu,
                'prestasi' => $mahasiswa->prestasi,
                'publikasi' => $mahasiswa->publikasi_mahasiswa,
                'aktivitas' => $mahasiswa->aktivitas,
                'seminarTa1' => $seminarTa1,
                'seminarTa2' => $seminarTa2,
                'sidangKompre' => $sidangKompre,
                'ba_ta1' => $seminarTa1 ? $seminarTa1->ba_seminar : null,
                'ba_ta2' => $seminarTa2 ? $seminarTa2->ba_seminar : null,
                'ba_kompre' => $sidangKompre ? $sidangKompre->beritaAcara : null,
                'presentsi' => Laboratorium::where('user_id', $mahasiswa->user->id)->get(),
            ];
            if ($mahasiswa->user->hasRole('alumni')) {
                $data['alumni'] = AktivitasAlumni::where(
                    'mahasiswa_id',
                    $mahasiswa->id
                )->orderBy('tahun_masuk', 'desc')->get();
            }
            return view('dosen.mahasiswa.bimbingan.akademik.show', $data);
        } elseif ($mahasiswa->user->hasRole('mahasiswaS2')) {
            $mahasiswa = Mahasiswa::where('npm', $id)->first();
            $seminarTa1 = ModelSeminarTaSatu::where('id_mahasiswa', $mahasiswa->id)->first();
            $seminarTa2 = ModelSeminarTaDua::where('id_mahasiswa', $mahasiswa->id)->first();
            $sidangKompre = ModelSeminarKompre::where('id_mahasiswa', $mahasiswa->id)->first();
            $data = [
                'mahasiswa' => $mahasiswa,
                'kp' => $mahasiswa->seminar_kp,
                'ta1' => $mahasiswa->ta_satu,
                'prestasi' => $mahasiswa->prestasi,
                'aktivitas' => $mahasiswa->aktivitas,
                'seminarTa1' => $seminarTa1,
                'seminarTa2' => $seminarTa2,
                'sidangKompre' => $sidangKompre,
                'ba_ta1' => $seminarTa1 ? $seminarTa1->ba_seminar : null,
                'ba_ta2' => $seminarTa2 ? $seminarTa2->ba_seminar : null,
                'ba_kompre' => $sidangKompre ? $sidangKompre->beritaAcara : null,
                'presentsi' => Laboratorium::where('user_id', $mahasiswa->user->id)->get(),
            ];
            if ($mahasiswa->user->hasRole('alumni')) {
                $data['alumni'] = AktivitasAlumni::where(
                    'mahasiswa_id',
                    $mahasiswa->id
                )->orderBy('tahun_masuk', 'desc')->get();
            }
            // return dd($data);
            return view('dosen.mahasiswa.bimbingan.akademik.show', $data);
        }
        // dd($data);
    }
}
