<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Routing\Controller;


class ChartSeminarController extends Controller
{
    //
    public function ChartSeminar(Request $request)
    {
        if ($request->ajax()) {
            $startDate2 = $request->input('startDate2', null);
            $endDate2 = $request->input('endDate2', null);
            $angkatan = $request->input('angkatan', null);

            $categories = ['Mahasiswa', 'Seminar KP', 'Seminar TA 1', 'Seminar TA 2', 'Sidang Kompre'];
            $data = [
                'categories' => $categories,
                'seminar' => [],
                'nonseminar' => [],
            ];

            $mahasiswaAktifQuery = Mahasiswa::where(function ($query) {
                $query->whereIn('status', ['Aktif', 'Alumni']);
            });

            $mahasiswaNonAktifQuery = Mahasiswa::where(function ($query) {
                $query->whereIn('status', ['Drop Out', 'Cuti']);
            });

            if ($angkatan != null && $angkatan != 'all') {
                $mahasiswaAktifQuery->where('angkatan', $angkatan);
                $mahasiswaNonAktifQuery->where('angkatan', $angkatan);
            }

            $mahasiswaAktif = $mahasiswaAktifQuery->count();
            $mahasiswaNonAktif = $mahasiswaNonAktifQuery->count();

            $SudahSeminarKP = Mahasiswa::whereIn('status', ['Aktif', 'Alumni'])
                ->whereHas('seminar_kp', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_seminar', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {

                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            if ($angkatan != null && $angkatan != 'all') {
                $SudahSeminarKP->where('angkatan', $angkatan);
            }
            $SudahSeminarKP = $SudahSeminarKP->count();

            $SudahSeminarTA1 = Mahasiswa::whereIn('status', ['Aktif', 'Alumni'])
                ->whereHas('ta_satu', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {

                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            if ($angkatan != null && $angkatan != 'all') {
                $SudahSeminarTA1->where('angkatan', $angkatan);
            }
            $SudahSeminarTA1 = $SudahSeminarTA1->count();

            $SudahSeminarTA2 = Mahasiswa::whereIn('status', ['Aktif', 'Alumni'])
                ->whereHas('ta_dua', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {

                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            if ($angkatan != null && $angkatan != 'all') {
                $SudahSeminarTA2->where('angkatan', $angkatan);
            }
            $SudahSeminarTA2 = $SudahSeminarTA2->count();

            $SudahSidangKompre = Mahasiswa::whereIn('status', ['Aktif', 'Alumni'])
                ->whereHas('komprehensif', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {

                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            if ($angkatan != null && $angkatan != 'all') {
                $SudahSidangKompre->where('angkatan', $angkatan);
            }

            $SudahSidangKompre = $SudahSidangKompre->count();

            $BelumSeminarKP = $mahasiswaAktif - $SudahSeminarKP;

            $BelumSeminarTA1 = $mahasiswaAktif - $SudahSeminarTA1;

            $BelumSeminarTA2 = $SudahSeminarTA1 - $SudahSeminarTA2;

            $BelumSidangKompre = $SudahSeminarTA2 - $SudahSidangKompre;

            $data['seminar'] = [
                $mahasiswaAktif,
                $SudahSeminarKP,
                $SudahSeminarTA1,
                $SudahSeminarTA2,
                $SudahSidangKompre,
            ];
            $data['nonseminar'] = [
                $mahasiswaNonAktif,
                $BelumSeminarKP,
                $BelumSeminarTA1,
                $BelumSeminarTA2,
                $BelumSidangKompre,
            ];

            return response()->json($data);
        }
    }
}
