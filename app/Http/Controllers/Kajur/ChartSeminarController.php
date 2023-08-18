<?php

namespace App\Http\Controllers\Kajur;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
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

            $mahasiswaAktifQuery = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            })->where(function ($query) use ($angkatan) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                });
            });

            $mahasiswaNonAktifQuery = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            })->where(function ($query) {
                $query->whereHas('mahasiswa', function ($query) {
                    $query->whereIn('status', ['Drop Out', 'Cuti']);
                });
            });

            $mahasiswaAktif = $mahasiswaAktifQuery->count();
            $mahasiswaNonAktif = $mahasiswaNonAktifQuery->count();

            $SudahSeminarKP = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            })->where(function ($query) use ($angkatan, $startDate2, $endDate2) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                })->whereHas('mahasiswa.seminar_kp', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_seminar', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {
                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            });
            $SudahSeminarKP = $SudahSeminarKP->count();


            // ...

            $SudahSeminarTA1 = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            })->where(function ($query) use ($angkatan, $startDate2, $endDate2) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                })->whereHas('mahasiswa.ta_satu', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {
                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            });
            $SudahSeminarTA1 = $SudahSeminarTA1->count();

            $SudahSeminarTA2 = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            })->where(function ($query) use ($angkatan, $startDate2, $endDate2) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                })->whereHas('mahasiswa.ta_dua', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {
                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            });
            $SudahSeminarTA2 = $SudahSeminarTA2->count();

            $SudahSidangKompre = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            })->where(function ($query) use ($angkatan, $startDate2, $endDate2) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                })->whereHas('mahasiswa.komprehensif', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {
                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            });
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
    public function ChartSeminarS2(Request $request)
    {
        if ($request->ajax()) {
            $startDate2 = $request->input('startDate2S2', null);
            $endDate2 = $request->input('endDate2S2', null);
            $angkatan = $request->input('angkatanS2', null);

            $categories = ['Mahasiswa', 'Seminar TA 1', 'Seminar TA 2', 'Sidang Tesis'];
            $data = [
                'categories' => $categories,
                'seminar' => [],
                'nonseminar' => [],
            ];

            $mahasiswaAktifQuery = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswaS2');
            })->where(function ($query) use ($angkatan) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                });
            });

            $mahasiswaNonAktifQuery = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswaS2');
            })->where(function ($query) {
                $query->whereHas('mahasiswa', function ($query) {
                    $query->whereIn('status', ['Drop Out', 'Cuti']);
                });
            });

            $mahasiswaAktif = $mahasiswaAktifQuery->count();
            $mahasiswaNonAktif = $mahasiswaNonAktifQuery->count();

            $SudahSeminarTA1 = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswaS2');
            })->where(function ($query) use ($angkatan, $startDate2, $endDate2) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                })->whereHas('mahasiswa.taSatuS2', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {
                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            });
            $SudahSeminarTA1 = $SudahSeminarTA1->count();

            $SudahSeminarTA2 = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswaS2');
            })->where(function ($query) use ($angkatan, $startDate2, $endDate2) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                })->whereHas('mahasiswa.taDuaS2', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {
                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            });
            $SudahSeminarTA2 = $SudahSeminarTA2->count();

            $SudahSidangKompre = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswaS2');
            })->where(function ($query) use ($angkatan, $startDate2, $endDate2) {
                $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->whereIn('status', ['Aktif', 'Alumni']);
                    if ($angkatan != null && $angkatan != 'all') {
                        $query->where('angkatan', $angkatan);
                    }
                })->whereHas('mahasiswa.komprehensifS2', function ($query) use ($startDate2, $endDate2) {
                    $query->where('status_koor', 'Selesai');
                    if ($startDate2 != null && $endDate2 != null) {
                        $query->whereBetween('updated_at', ["$startDate2 00:00:00", "$endDate2 23:59:59"]);
                    }
                });
            });
            $SudahSidangKompre = $SudahSidangKompre->count();

            $BelumSeminarTA1 = $mahasiswaAktif - $SudahSeminarTA1;

            $BelumSeminarTA2 = $SudahSeminarTA1 - $SudahSeminarTA2;

            $BelumSidangKompre = $SudahSeminarTA2 - $SudahSidangKompre;

            $data['seminar'] = [
                $mahasiswaAktif,
                $SudahSeminarTA1,
                $SudahSeminarTA2,
                $SudahSidangKompre,
            ];
            $data['nonseminar'] = [
                $mahasiswaNonAktif,
                $BelumSeminarTA1,
                $BelumSeminarTA2,
                $BelumSidangKompre,
            ];

            return response()->json($data);
        }
    }
}
