<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use App\Models\ModelSeminarKP;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreSeminarKP;
use App\Http\Requests\UpdateSeminarKpRequest;
use App\Models\BaSKP;
use Illuminate\Support\Facades\Crypt;
use App\Models\BerkasPersyaratanSeminar;
use App\Models\ModelSeminarKompre;
use App\Http\Requests\UpdateSidangKompreRequest;
use App\Http\Requests\StoreTugasAkhirSatuRequest;
use App\Http\Requests\UpdateSeminarTaSatuRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelSeminarTaSatu;
use App\Models\ModelSeminarTaDua;
use Illuminate\Http\File;

class ChartSeminarController extends Controller
{
    //
    public function ChartSeminar(Request $request)
    {
        $startDate = $request->input('startDate', null);
        $endDate = $request->input('endDate', null);
        $angkatan = $request->input('angkatan', null);

        $categories = ['Mahasiswa', 'Seminar KP', 'Seminar TA 1', 'Seminar TA 2', 'Sidang Kompre'];
        $data = [
            'categories' => $categories,
            'seminar' => [],
            'nonseminar' => [],
        ];
        if ($startDate != null && $endDate != null && $angkatan != null && $angkatan != 'all') {

            $mahasiswaAktif = Mahasiswa::where('angkatan', $angkatan)->where('status', 'Aktif')->orWhere('status', 'Alumni')->count();
            $mahasiswaNonAktif = Mahasiswa::where('angkatan', $angkatan)->where('status', 'Drop Out')->orWhere('status', 'Cuti')->count();
            $SudahSeminarKP = ModelSeminarKP::whrere('status_seminar', 'selesai')->where('id_mahasiswa', Mahasiswa::where('angkatan', $angkatan)->pluck('id'))->whereBetween('updated_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->count();
            $BelumSeminarKP = $mahasiswaAktif - $SudahSeminarKP;
            $SudahSeminarTA1 = ModelSeminarTaSatu::whrere('status_koor', 'selesai')->where('id_mahasiswa', Mahasiswa::where('angkatan', $angkatan)->pluck('id'))->whereBetween('updated_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->count();
            $BelumSeminarTA1 = $mahasiswaAktif - $SudahSeminarTA1;
            $SudahSeminarTA2 = ModelSeminarTaDua::whrere('status_koor', 'selesai')->where('id_mahasiswa', Mahasiswa::where('angkatan', $angkatan)->pluck('id'))->whereBetween('updated_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->count();
            $BelumSeminarTA2 = $mahasiswaAktif - $SudahSeminarTA2;
            $SudahSidangKompre = ModelSeminarKompre::whrere('status_koor', 'selesai')->where('id_mahasiswa', Mahasiswa::where('angkatan', $angkatan)->pluck('id'))->whereBetween('updated_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->count();
            $BelumSidangKompre = $mahasiswaAktif - $SudahSidangKompre;
            $data['seminar'] = [
                $mahasiswaAktif,
                $BelumSeminarKP,
                $BelumSeminarTA1,
                $BelumSeminarTA2,
                $BelumSidangKompre,
            ];
            $data['nonseminar'] = [
                $mahasiswaNonAktif,
                $SudahSeminarKP,
                $SudahSeminarTA1,
                $SudahSeminarTA2,
                $SudahSidangKompre,
            ];
        } elseif ($startDate != null && $endDate != null && $angkatan == null || $angkatan == 'all') {

            $mahasiswaAktif = Mahasiswa::where('status', 'Aktif')->orWhere('status', 'Alumni')->count();
            $mahasiswaNonAktif = Mahasiswa::where('status', 'Drop Out')->orWhere('status', 'Cuti')->count();
            $SudahSeminarKP = ModelSeminarKP::whrere('status_seminar', 'selesai')->whereBetween('updated_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->count();
            $BelumSeminarKP = $mahasiswaAktif - $SudahSeminarKP;
            $SudahSeminarTA1 = ModelSeminarTaSatu::whrere('status_koor', 'selesai')->whereBetween('updated_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->count();
            $BelumSeminarTA1 = $mahasiswaAktif - $SudahSeminarTA1;
            $SudahSeminarTA2 = ModelSeminarTaDua::whrere('status_koor', 'selesai')->whereBetween('updated_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->count();
            $BelumSeminarTA2 = $mahasiswaAktif - $SudahSeminarTA2;
            $SudahSidangKompre = ModelSeminarKompre::whrere('status_koor', 'selesai')->whereBetween('updated_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->count();
            $BelumSidangKompre = $mahasiswaAktif - $SudahSidangKompre;
            $data['seminar'] = [
                $mahasiswaAktif,
                $BelumSeminarKP,
                $BelumSeminarTA1,
                $BelumSeminarTA2,
                $BelumSidangKompre,
            ];
            $data['nonseminar'] = [
                $mahasiswaNonAktif,
                $SudahSeminarKP,
                $SudahSeminarTA1,
                $SudahSeminarTA2,
                $SudahSidangKompre,
            ];
        } elseif ($startDate == null && $endDate == null && $angkatan == null || $angkatan == 'all') {

                $mahasiswaAktif = Mahasiswa::where('status', 'Aktif')->orWhere('status', 'Alumni')->count();
                $mahasiswaNonAktif = Mahasiswa::where('status', 'Drop Out')->orWhere('status', 'Cuti')->count();
                $SudahSeminarKP = ModelSeminarKP::whrere('status_seminar', 'selesai')->count();
                $BelumSeminarKP = $mahasiswaAktif - $SudahSeminarKP;
                $SudahSeminarTA1 = ModelSeminarTaSatu::whrere('status_koor', 'selesai')->count();
                $BelumSeminarTA1 = $mahasiswaAktif - $SudahSeminarTA1;
                $SudahSeminarTA2 = ModelSeminarTaDua::whrere('status_koor', 'selesai')->count();
                $BelumSeminarTA2 = $mahasiswaAktif - $SudahSeminarTA2;
                $SudahSidangKompre = ModelSeminarKompre::whrere('status_koor', 'selesai')->count();
                $BelumSidangKompre = $mahasiswaAktif - $SudahSidangKompre;
                $data['seminar'] = [
                    $mahasiswaAktif,
                    $BelumSeminarKP,
                    $BelumSeminarTA1,
                    $BelumSeminarTA2,
                    $BelumSidangKompre,
                ];
                $data['nonseminar'] = [
                    $mahasiswaNonAktif,
                    $SudahSeminarKP,
                    $SudahSeminarTA1,
                    $SudahSeminarTA2,
                    $SudahSidangKompre,
                ];
            } elseif ($startDate == null && $endDate == null && $angkatan != null && $angkatan != 'all') {

                $mahasiswaAktif = Mahasiswa::where('angkatan',$angkatan)->where('status', 'Aktif')->orWhere('status', 'Alumni')->count();
                $mahasiswaNonAktif = Mahasiswa::where('angkatan',$angkatan)->where('status', 'Drop Out')->orWhere('status', 'Cuti')->count();
                $SudahSeminarKP = ModelSeminarKP::whrere('status_seminar', 'selesai')->where('id_mahasiswa', Mahasiswa::where('angkatan', $angkatan)->pluck('id'))->count();
                $BelumSeminarKP = $mahasiswaAktif - $SudahSeminarKP;
                $SudahSeminarTA1 = ModelSeminarTaSatu::whrere('status_koor', 'selesai')->where('id_mahasiswa', Mahasiswa::where('angkatan', $angkatan)->pluck('id'))->count();
                $BelumSeminarTA1 = $mahasiswaAktif - $SudahSeminarTA1;
                $SudahSeminarTA2 = ModelSeminarTaDua::whrere('status_koor', 'selesai')->where('id_mahasiswa', Mahasiswa::where('angkatan', $angkatan)->pluck('id'))->count();
                $BelumSeminarTA2 = $mahasiswaAktif - $SudahSeminarTA2;
                $SudahSidangKompre = ModelSeminarKompre::whrere('status_koor', 'selesai')->where('id_mahasiswa', Mahasiswa::where('angkatan', $angkatan)->pluck('id'))->count();
                $BelumSidangKompre = $mahasiswaAktif - $SudahSidangKompre;
                $data['seminar'] = [
                    $mahasiswaAktif,
                    $BelumSeminarKP,
                    $BelumSeminarTA1,
                    $BelumSeminarTA2,
                    $BelumSidangKompre,
                ];
                $data['nonseminar'] = [
                    $mahasiswaNonAktif,
                    $SudahSeminarKP,
                    $SudahSeminarTA1,
                    $SudahSeminarTA2,
                    $SudahSidangKompre,
                ];
        }
        return response()->json($data);
    }
}
