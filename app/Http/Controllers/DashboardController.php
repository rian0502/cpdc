<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\AktivitasMahasiswa;
use App\Models\AktivitasMahasiswaS2;
use App\Models\BaseNPM;
use App\Models\BaSKP;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\ModelBaKompreS2;
use App\Models\ModelBaSeminarKompre;
use App\Models\ModelBaSeminarTaDua;
use App\Models\ModelBaSeminarTaDuaS2;
use App\Models\ModelBaSeminarTaSatu;
use App\Models\ModelBaSeminarTaSatuS2;
use App\Models\ModelSeminarKompre;
use App\Models\ModelSeminarKP;
use App\Models\ModelSeminarTaDua;
use App\Models\ModelSeminarTaSatu;
use App\Models\ModelKompreS2;
use App\Models\ModelSeminarTaDuaS2;
use App\Models\ModelSeminarTaSatuS2;
use App\Models\PrestasiMahasiswa;
use App\Models\PrestasiMahasiswaS2 as ModelsPrestasiMahasiswaS2;
use App\Models\SopLab;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PrestasiMahasiswaS2;

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
                    'tesis1' => ModelSeminarTaSatuS2::where('status_admin', '!=', 'Valid')->count(),
                    'tesis2' => ModelSeminarTaDuaS2::where('status_admin', '!=', 'Valid')->count(),
                    'tesis3' => ModelKompreS2::where('status_admin', '!=', 'Valid')->count(),

                ];
                return view('dashboard', $data);
            }

            return view('dashboard');
        } elseif (Auth::user()->hasAnyRole(['mahasiswa', 'alumni', 'mahasiswaS2', 'alumniS2'])) {
            if (Auth::user()->hasAnyRole(['mahasiswa', 'alumni'])) {
                $data = [
                    'jumlah_prestasi' => PrestasiMahasiswa::select('mahasiswa_id')
                        ->where('mahasiswa_id', Auth::user()->mahasiswa->id)->count(),
                    'jumlah_aktivitas' => AktivitasMahasiswa::select('mahasiswa_id')
                        ->where('mahasiswa_id', Auth::user()->mahasiswa->id)->count(),
                    'sop_kimdas' => SopLab::where('id_lokasi', 4)->get(),
                    'sop_organik' => SopLab::where('id_lokasi', 3)->get(),
                    'sop_analitik' => SopLab::where('id_lokasi', 1)->get(),
                    'sop_anorganik' => SopLab::where('id_lokasi', 2)->get(),
                    'sop_biokimia' => SopLab::where('id_lokasi', 5)->get(),
                ];
            } else {
                $data = [
                    'jumlah_prestasi_s2' => ModelsPrestasiMahasiswaS2::select('mahasiswa_id')
                        ->where('mahasiswa_id', Auth::user()->mahasiswa->id)->count(),
                    'jumlah_aktivitas_s2' => AktivitasMahasiswaS2::select('mahasiswa_id')
                        ->where('mahasiswa_id', Auth::user()->mahasiswa->id)->count(),
                ];
            }
            return view('dashboard', $data);
        } elseif (Auth::user()->hasRole('dosen')) {
            $data = [
                'jadwalskp' => (new ModelSeminarKP())->getJadwalDosenDate(Auth::user()->dosen->id),
                'jadwalta1' => (new ModelSeminarTaSatu())->getJadwalDosenDate(Auth::user()->dosen->id),
                'jadwalta2' => (new ModelSeminarTaDua())->getJadwalDosenDate(Auth::user()->dosen->id),
                'jadwalkompre' => (new ModelSeminarKompre())->getJadwalDosenDate(Auth::user()->dosen->id),
                'jadwalTesis1' => (new ModelSeminarTaSatuS2())->getJadwalDosenDate(Auth::user()->dosen->id),
                'jadwalTesis2' => (new ModelSeminarTaDuaS2())->getJadwalDosenDate(Auth::user()->dosen->id),
                'jadwalSidangTesis' => (new ModelKompreS2())->getJadwalDosenDate(Auth::user()->dosen->id),
            ];
            if (Auth::user()->hasRole('pkl')) {
                $data['invalid_kp'] = ModelSeminarKP::where('proses_admin', 'Valid')
                    ->where('status_seminar', '!=', 'Selesai')->count();
                $data['jadwal_seminar'] = ModelSeminarKP::leftJoin(
                    'jadwal_skp',
                    'seminar_kp.id',
                    '=',
                    'jadwal_skp.id_skp'
                )->count();
                $data['total_berkas']  = BaSKP::count();
                $data['jumlah_kp'] = ModelSeminarKP::count();
            }
            if (Auth::user()->hasRole('ta1')) {
                $data['invalid_berkas'] = (new ModelSeminarTaSatu())->getInvalidJumlahBerkas();
                $data['invalid_jadwal'] = (new ModelSeminarTaSatu())->getJumlahJadwal();
                $data['total_berkas']  = ModelBaSeminarTaSatu::count();
                $data['jumlah_ta1'] = ModelSeminarTaSatu::count();
            }
            if (Auth::user()->hasRole('ta2')) {
                $data['invalid_berkas'] = (new ModelSeminarTaDua())->getInvalidJumlahBerkas();
                $data['invalid_jadwal'] = (new ModelSeminarTaDua())->getJumlahJadwal();
                $data['total_berkas']  = ModelBaSeminarTaDua::count();
                $data['jumlah_ta2'] = ModelSeminarTaDua::count();
            }
            if (Auth::user()->hasRole('kompre')) {
                $data['invalid_berkas'] = (new ModelSeminarKompre())->getInvalidJumlahBerkas();
                $data['invalid_jadwal'] = (new ModelSeminarKompre())->getJumlahJadwal();
                $data['total_berkas']  = ModelBaSeminarKompre::count();
                $data['jumlah_kompre'] = ModelSeminarKompre::count();
            }
            if (Auth::user()->hasRole('ta1S2')) {
                $data['invalid_berkas_s2_ta1'] = (new ModelSeminarTaSatuS2())->getInvalidJumlahBerkas();
                $data['invalid_jadwal_s2_ta1'] = (new ModelSeminarTaSatuS2())->getJumlahJadwal();
                $data['total_berkas_s2_ta1']  = ModelBaSeminarTaSatuS2::count();
                $data['jumlah_ta1_s2_ta1'] = ModelSeminarTaSatuS2::count();
            }
            if (Auth::user()->hasRole('ta2S2')) {
                $data['invalid_berkas_s2_ta2'] = (new ModelSeminarTaDuaS2())->getInvalidJumlahBerkas();
                $data['invalid_jadwal_s2_ta2'] = (new ModelSeminarTaDuaS2())->getJumlahJadwal();
                $data['total_berkas_s2_ta2']  = ModelBaSeminarTaDuaS2::count();
                $data['jumlah_ta2_s2_ta2'] = ModelSeminarTaDuaS2::count();
            }
            if (Auth::user()->hasRole('kompreS2')) {
                $data['invalid_berkas_s2_kompre'] = (new ModelKompreS2())->getInvalidJumlahBerkas();
                $data['invalid_jadwal_s2_kompre'] = (new ModelKompreS2())->getJumlahJadwal();
                $data['total_berkas_s2_kompre']  = ModelBaKompreS2::count();
                $data['jumlah_kompre_s2_kompre'] = ModelKompreS2::count();
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
        return [
            'npm' => BaseNPM::count(),
            'profile' => $dosen + $mahasiswa + $admin,
            'noVertif' => User::where('email_verified_at', null)->count(),
            'acc' => User::count(),
            'actNpm' => BaseNPM::where('status', 'aktif')->count(),
            'noNpm' => BaseNPM::where('status', 'nonaktif')->count(),
            'nonAcc' => $nonAktif,
            'role' => $role
        ];
    }
}
