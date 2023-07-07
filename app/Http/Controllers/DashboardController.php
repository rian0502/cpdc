<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\AktivitasMahasiswa;
use App\Models\BaseNPM;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\ModelBaSeminarTaDua;
use App\Models\ModelSeminarKompre;
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
            if (Auth::user()->hasRole('pkl')) {
                $data['unvalid_kp'] = ModelSeminarKP::where('proses_admin', 'Valid')->where('status_seminar', '!=', 'Invalid')->count();
                $data['jadwal_seminar'] = ModelSeminarKP::leftJoin('jadwal_skp', 'seminar_kp.id', '=', 'jadwal_skp.id_skp')->count();
            }
            if (Auth::user()->hasRole('ta1')) {
                $data['unvalid_ta1'] = ModelSeminarTaSatu::where('status_admin', 'Valid')->where('status_seminar', '!=', 'Invalid')->count();
                $data['jadwal_seminar'] = ModelSeminarTaSatu::leftJoin('jadwal_seminar_ta_satu', 'seminar_ta_satu.id', '=', 'jadwal_seminar_ta_satu.id_seminar')->count();
            }
            if (Auth::user()->hasRole('ta2')) {
                $data['unvalid_ta2'] = ModelBaSeminarTaDua::where('status_admin', 'Valid')->where('status_seminar', '!=', 'Invalid')->count();

                $data['jadwal_seminar'] = ModelBaSeminarTaDua::leftJoin('jadwal_seminar_ta_dua', 'seminar_ta_dua.id', '=', 'jadwal_seminar_ta_dua.id_seminar')->count();
            }
            if (Auth::user()->hasRole('kompre')) {
                $data['unvalid_kompre'] = ModelSeminarKompre::where('status_admin', 'Valid')->where('status_seminar', '!=', 'Invalid')->count();
                $data['jadwal_seminar'] = ModelSeminarKompre::leftJoin('jadwal_seminar_komprehensif', 'seminar_komprehensif.id', '=', 'jadwal_seminar_komprehensif.id_seminar')->count();
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
