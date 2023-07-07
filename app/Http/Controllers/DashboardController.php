<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\AktivitasMahasiswa;
use App\Models\BaseNPM;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\ModelSeminarKP;
use App\Models\ModelSeminarTaDua;
use App\Models\ModelSeminarTaSatu;
use App\Models\PrestasiMahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->hasRole('admin lab') || Auth::user()->hasRole('admin berkas')) {
            if (Auth::user()->hasRole('admin berkas')) {
                $data = [
                    'kp' => ModelSeminarKP::where('proses_admin', '!=', 'Valid')->count(),
                    'ta1' => ModelSeminarTaSatu::where('status_admin', '!=', 'Valid')->count(),
                    'ta2' => ModelSeminarTaDua::where('status_admin', '!=', 'Valid')->count(),
                    'kompre' => ModelSeminarTaDua::where('status_admin', '!=', 'Valid')->count(),
                ];
                return view('dashboard', $data);
            }

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
            }
            return view('dashboard', $data);
        } else {
            $data = $this->load();

            return view('dashboard', $data);
        }
    }

    private function load()
    {
        $dosen = Dosen::count();
        $mahasiswa = Mahasiswa::count();
        $admin = Administrasi::count();
        $nonDosen = Dosen::where('status', 'Pensiun')->count();
        $nonAdmin = Administrasi::where('status', 'Pensiun')->count();
        $nonMahasiswa = Mahasiswa::where('status', '!=', 'Aktif')->count();
        $role = DB::table('roles')->count();
        $nonAktif = $nonDosen + $nonAdmin + $nonMahasiswa;
        $data = [
            'npm' => BaseNPM::count(),
            'profile' => $dosen + $mahasiswa + $admin,
            'noVertif' => User::where('email_verified_at', null)->count(),
            'acc' => User::count(),
            'actNpm' => BaseNPM::where('status', 'aktif')->count(),
            'noNpm' => BaseNPM::where('status', 'nonaktif')->count(),
            'nonAcc' => $nonAktif,
            'role' => $role
        ];
        return $data;
    }
}
