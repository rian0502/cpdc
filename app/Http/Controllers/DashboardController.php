<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AktivitasMahasiswa;
use App\Models\ModelSeminarKP;
use App\Models\PrestasiMahasiswa;
use Illuminate\Support\Facades\Auth;


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
            return view('dashboard', $data);
        } else {
            return view('dashboard');
        }
    }
}
