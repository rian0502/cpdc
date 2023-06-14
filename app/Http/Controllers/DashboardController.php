<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AktivitasMahasiswa;
use App\Models\Dosen;
use App\Models\ModelSeminarKP;
use App\Models\ModelSeminarTaSatu;
use App\Models\PrestasiMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->hasRole('admin lab') || Auth::user()->hasRole('admin berkas')) {
            return view('dashboard');
        } else if (Auth::user()->hasRole('mahasiswa')) {
            $data = [
                'jumlah_prestasi' => PrestasiMahasiswa::select('mahasiswa_id')->where('mahasiswa_id', Auth::user()->mahasiswa->id)->count(),
                'jumlah_aktivitas' => AktivitasMahasiswa::select('mahasiswa_id')->where('mahasiswa_id', Auth::user()->mahasiswa->id)->count(),
            ];
            return view('dashboard', $data);
        } else if (Auth::user()->hasRole('dosen')) {
            $data = [
                'jadwalskp' => (new ModelSeminarKP())->getJadwalDosenDate(Auth::user()->dosen->id),
            ];
            if (Auth::user()->hasRole('jurusan')) {
                //query hitung jumlah usia dosen dari table dosen melalui column tanggal_lahir kelompokkan dan hitung junlah umur tersebvut
                $test = DB::table('dosen')
                    ->select(DB::raw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) as umur, COUNT(*) as total'))
                    ->groupBy('umur')
                    ->get();
            }
            return view('dashboard', $data);
        } else {
            return view('dashboard');
        }
    }
}
