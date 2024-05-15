<?php

namespace App\Http\Controllers\Kajur;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ModelSPDosen;
use Illuminate\Http\Request;
use App\Models\LitabmasDosen;
use App\Models\PublikasiDosen;
use App\Models\PrestasiMahasiswa;
use App\Models\AktivitasMahasiswa;
use App\Http\Controllers\Controller;
use App\Models\ModelPenghargaanDosen;
use App\Models\ModelPublikasiMahasiswa;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class ExportData extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pengabdian' => LitabmasDosen::select('tahun_penelitian')
                ->distinct()->orderBy('tahun_penelitian', 'desc')
                ->where('kategori', 'Pengabdian')
                ->get(),
            'penelitian' => LitabmasDosen::select('tahun_penelitian')
                ->distinct()->orderBy('tahun_penelitian', 'desc')
                ->where('kategori', 'Penelitian')
                ->get(),
            'publikasi' => ModelPublikasiMahasiswa::select('tahun')
                ->distinct()->orderBy('tahun', 'desc')
                ->get(),
            'prestasi' => PrestasiMahasiswa::selectRaw('YEAR(tanggal) as year')
                ->distinct()->orderBy('year', 'desc')
                ->get(),
            'aktivitas' => AktivitasMahasiswa::selectRaw('YEAR(tanggal) as year')
                ->distinct()->orderBy('year', 'desc')
                ->get(),
            'mahasiswa' => Mahasiswa::select('angkatan')
                ->distinct()->whereHas('user', function ($query) {
                    $query->whereHas('roles', function ($query) {
                        $query->where('name', 'mahasiswa');
                    });
                })->orderBy('angkatan', 'desc')
                ->get(),
            'alumni' => Mahasiswa::select('angkatan')
                ->distinct()->where('status', 'Alumni')->whereHas('user', function ($query) {
                    $query->whereHas('roles', function ($query) {
                        $query->where('name', 'mahasiswa');
                    });
                })->orderBy('angkatan', 'desc')
                ->get(),
            'kp' => Mahasiswa::select('angkatan')
                ->distinct()->whereHas('seminar_kp')->orderBy('angkatan', 'desc')
                ->get(),
            'ta1' => Mahasiswa::select('angkatan')
                ->distinct()->whereHas('ta_satu')->orderBy('angkatan', 'desc')
                ->get(),
            'ta2' => Mahasiswa::select('angkatan')
                ->distinct()->whereHas('ta_dua')->orderBy('angkatan', 'desc')
                ->get(),
            'kompre' => Mahasiswa::select('angkatan')
                ->distinct()->whereHas('komprehensif')->orderBy('angkatan', 'desc')
                ->get(),
            'seminar_dosen' => ModelSPDosen::selectRaw('YEAR(tanggal) as tahun')
                ->distinct()->orderBy('tahun', 'desc')
                ->get(),
            'penghargaan_dosen' => ModelPenghargaanDosen::selectRaw('YEAR(tanggal) as tahun')
                ->distinct()->orderBy('tahun', 'desc')
                ->get(),
            'publikasi_mahasiswa' => ModelPublikasiMahasiswa::select('tahun')
                ->distinct()->orderBy('tahun', 'desc')->whereHas(
                    'mahasiswa.user.roles',
                    function ($query) {
                        $query->where('name', 'mahasiswa');
                    }
                )->get(),
        ];

        return view('jurusan.export.index', $data);
    }


    public function publikasi_mahasiswa(Request $request)
    {
        $publikasi = ModelPublikasiMahasiswa::with(['mahasiswa'])
            ->where('tahun', $request->tahun_publikasi_mahasiswa)
            ->whereHas(
                'mahasiswa.user.roles',
                function ($query) {
                    $query->where('name', 'mahasiswa');
                }
            )->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Publikasi Mahasiswa');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Nama Publikasi');
        $sheet->setCellValue('E1', 'Judul');
        $sheet->setCellValue('F1', 'Tahun');
        $sheet->setCellValue('G1', 'Vol');
        $sheet->setCellValue('H1', 'Halaman');
        $sheet->setCellValue('I1', 'Scala');
        $sheet->setCellValue('J1', 'Kategori');
        $sheet->setCellValue('K1', 'URL');
        $sheet->setCellValue('L1', 'Anggota');
        foreach ($publikasi as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->mahasiswa->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->nama_publikasi);
            $sheet->setCellValue('E' . ($key + 2), $value->judul);
            $sheet->setCellValue('F' . ($key + 2), $value->tahun);
            $sheet->setCellValue('G' . ($key + 2), $value->vol);
            $sheet->setCellValue('H' . ($key + 2), $value->halaman);
            $sheet->setCellValue('I' . ($key + 2), $value->scala);
            $sheet->setCellValue('J' . ($key + 2), $value->kategori);
            $sheet->setCellValue('K' . ($key + 2), $value->url);
            $sheet->setCellValue('L' . ($key + 2), $value->anggota);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('publikasi_mahasiswa_' . $request->tahun_publikasi_mahasiswa . '.xlsx');
        return response()->download('publikasi_mahasiswa_' .
            $request->tahun_publikasi_mahasiswa . '.xlsx')->deleteFileAfterSend(true);
    }

    public function mahasiswaSeminar(Request $request)
    {

        $mahasiswa = User::with('mahasiswa');
        if ($request->angkatan != '1') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                if ($request->angkatan != '1') {
                    $query->where('angkatan', $request->angkatan);
                }
            });
        }
        if ($request->status_kp != '1' && $request->status_kp != 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereHas('seminar_kp', function ($query) use ($request) {
                    $query->where('status_seminar', $request->status_kp);
                });
            });
        } elseif ($request->status_kp == 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereDoesntHave('seminar_kp');
            });
        }

        if ($request->status_ta1 != '1' && $request->status_ta1 != 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereHas('ta_satu', function ($query) use ($request) {
                    $query->where('status_koor', $request->status_ta1);
                });
            });
        } elseif ($request->status_ta1 == 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereDoesntHave('ta_satu');
            });
        }

        if ($request->status_ta2 != '1' && $request->status_ta2 != 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereHas('ta_dua', function ($query) use ($request) {
                    $query->where('status_koor', $request->status_ta2);
                });
            });
        } elseif ($request->status_ta2 == 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereDoesntHave('ta_dua');
            });
        }

        if ($request->status_kompre != '1' && $request->status_kompre != 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereHas('komprehensif', function ($query) use ($request) {
                    $query->where('status_koor', $request->status_kompre);
                });
            });
        } elseif ($request->status_kompre == 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereDoesntHave('komprehensif');
            });
        }
        $mahasiswa = $mahasiswa->role('mahasiswa')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Data Mahasiswa Seminar');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Angkatan');
        $sheet->setCellValue('F1', 'Dosen Pembimbing Akademik');
        $sheet->setCellValue('G1', 'Seminar KP/PKL');
        $sheet->setCellValue('H1', 'Seminar TA 1');
        $sheet->setCellValue('I1', 'Seminar TA 2');
        $sheet->setCellValue('J1', 'Seminar Komprehensif');
        foreach ($mahasiswa as $key => $item) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $item->mahasiswa->npm);
            $sheet->setCellValue('C' . ($key + 2), $item->mahasiswa->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $item->mahasiswa->status);
            $sheet->setCellValue('E' . ($key + 2), $item->mahasiswa->angkatan);
            $sheet->setCellValue('F' . ($key + 2), $item->mahasiswa->dosen->nama_dosen ?? '-');
            $sheet->setCellValue(
                'G' . ($key + 2),
                $item->mahasiswa->seminar_kp ?  $item->mahasiswa->seminar_kp->status_seminar : '-'
            );
            $sheet->setCellValue(
                'H' . ($key + 2),
                $item->mahasiswa->ta_satu ?  $item->mahasiswa->ta_satu->status_koor : '-'
            );
            $sheet->setCellValue(
                'I' . ($key + 2),
                $item->mahasiswa->ta_dua ?  $item->mahasiswa->ta_dua->status_koor : '-'
            );
            $sheet->setCellValue(
                'J' . ($key + 2),
                $item->mahasiswa->komprehensif ?  $item->mahasiswa->komprehensif->status_koor : '-'
            );
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('data_mahasiswa_seminar.xlsx');
        return response()->download('data_mahasiswa_seminar.xlsx')->deleteFileAfterSend(true);
    }
    public function seminar(Request $request)
    {
        $seminar = ModelSPDosen::with('dosen')->where('jenis', 'Seminar')
            ->whereYear('tahun', $request->tahun_seminar)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Dosen');
        $sheet->setCellValue('C1', 'Judul');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Scala');
        $sheet->setCellValue('F1', 'Uraian');
        $sheet->setCellValue('G1', 'URL');
        foreach ($seminar as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->dosen->nama_dosen);
            $sheet->setCellValue('C' . ($key + 2), $value->nama);
            $sheet->setCellValue('D' . ($key + 2), $value->tahun);
            $sheet->setCellValue('E' . ($key + 2), $value->scala);
            $sheet->setCellValue('F' . ($key + 2), $value->uraian);
            $sheet->setCellValue('G' . ($key + 2), $value->url);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_dosen-' . $request->tahun_seminar . '.xlsx');
        return response()->download('seminar_dosen-' . $request->tahun_seminar . '.xlsx')->deleteFileAfterSend(true);
    }

    public function penghargaan(Request $request)
    {
        $penghargaan = ModelSPDosen::with('dosen')->where('jenis', 'Penghargaan')
            ->whereYear('tahun', $request->tahun_penghargaan)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Penghargaan Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Dosen');
        $sheet->setCellValue('C1', 'Nama Penghargaan');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Scala');
        $sheet->setCellValue('F1', 'Uraian');
        $sheet->setCellValue('G1', 'URL');
        foreach ($penghargaan as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->dosen->nama_dosen);
            $sheet->setCellValue('C' . ($key + 2), $value->nama);
            $sheet->setCellValue('D' . ($key + 2), $value->tahun);
            $sheet->setCellValue('E' . ($key + 2), $value->scala);
            $sheet->setCellValue('F' . ($key + 2), $value->uraian);
            $sheet->setCellValue('G' . ($key + 2), $value->url);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('penghargaan_dosen-' . $request->tahun_penghargaan . '.xlsx');
        return response()->download('penghargaan_dosen-' .
            $request->tahun_penghargaan . '.xlsx')->deleteFileAfterSend(true);
    }

    public function kompre(Request $request)
    {
        if ($request->filled('start') && $request->filled('end') && $request->filled('akt_kompre')) {
            if ($request->end < $request->start) {
                return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }
            $mahasiswa = Mahasiswa::with(['komprehensif'])
                ->whereHas('komprehensif.jadwal', function ($query) use ($request) {
                    $query->whereBetween('tanggal_komprehensif', [$request->start, $request->end]);
                })
                ->where('angkatan', $request->akt_kompre)
                ->get();
        } else if ($request->filled('start') && $request->filled('akt_kompre')) {
            $mahasiswa = Mahasiswa::with(['komprehensif'])
                ->whereHas('komprehensif.jadwal', function ($query) use ($request) {
                    $query->where('tanggal_komprehensif', '>=', $request->start);
                })
                ->where('angkatan', $request->akt_kompre)
                ->get();
        } else if ($request->filled('end') && $request->filled('akt_kompre')) {
            $mahasiswa = Mahasiswa::with(['komprehensif'])
                ->whereHas('komprehensif.jadwal', function ($query) use ($request) {
                    $query->where('tanggal_komprehensif', '<=', $request->end);
                })
                ->where('angkatan', $request->akt_kompre)
                ->get();
        } else {
            $mahasiswa = Mahasiswa::whereHas('komprehensif')->where('angkatan', $request->akt_kompre)->get();
        }

        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar Komprehensif');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul Komprehensif');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas');
        $sheet->setCellValue('I1', 'Status Admin');
        $sheet->setCellValue('J1', 'Status Koordinator');
        $sheet->setCellValue('K1', 'Huruf Mutu');
        $sheet->setCellValue('L1', 'Nilai');
        $sheet->setCellValue('M1', 'No BA');
        $sheet->setCellValue('N1', 'URL');
        $sheet->setCellValue('O1', 'Tanggal Realisasi');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->komprehensif->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->komprehensif->pembimbingSatu->nama_dosen);
            if ($value->komprehensif->id_pembimbing_dua != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->komprehensif->pembimbingDua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->komprehensif->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->komprehensif->pembahas->nama_dosen);
            $sheet->setCellValue('I' . ($key + 2), $value->komprehensif->status_admin);
            $sheet->setCellValue('J' . ($key + 2), $value->komprehensif->status_koor);
            if ($value->komprehensif->beritaAcara) {
                $sheet->setCellValue('K' . ($key + 2), $value->komprehensif->beritaAcara->huruf_mutu);
                $sheet->setCellValue('L' . ($key + 2), $value->komprehensif->beritaAcara->nilai);
                $sheet->setCellValue('M' . ($key + 2), $value->komprehensif->beritaAcara->no_ba_berkas);
                $sheet->setCellValue(
                    'N' . ($key + 2),
                    url('/uploads/ba_sidang_kompre/' . $value->komprehensif->beritaAcara->ba_seminar_komprehensif)
                );
                $sheet->setCellValue('O' . ($key + 2), $value->komprehensif->jadwal->tanggal_komprehensif);
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_komprehensif_' . $request->akt_kompre . '.xlsx');
        return response()->download('seminar_komprehensif_' .
            $request->akt_kompre . '.xlsx')->deleteFileAfterSend(true);
    }

    public function ta2(Request $request)
    {
        if ($request->filled('start') && $request->filled('end') && $request->filled('akt_ta2')) {
            if ($request->end < $request->start) {
                return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }
            $mahasiswa = Mahasiswa::with(['ta_dua'])
                ->whereHas('ta_dua.jadwal', function ($query) use ($request) {
                    $query->whereBetween('tanggal_seminar_ta_dua', [$request->start, $request->end]);
                })
                ->where('angkatan', $request->akt_ta2)
                ->get();
        } else if ($request->filled('start') && $request->filled('akt_ta2')) {
            $mahasiswa = Mahasiswa::with(['ta_dua'])
                ->whereHas('ta_dua.jadwal', function ($query) use ($request) {
                    $query->where('tanggal_seminar_ta_dua', '>=', $request->start);
                })
                ->where('angkatan', $request->akt_ta2)
                ->get();
        } else if ($request->filled('end') && $request->filled('akt_ta2')) {
            $mahasiswa = Mahasiswa::with(['ta_dua'])
                ->whereHas('ta_dua.jadwal', function ($query) use ($request) {
                    $query->where('tanggal_seminar_ta_dua', '<=', $request->end);
                })
                ->where('angkatan', $request->akt_ta2)
                ->get();
        } else {
            $mahasiswa = Mahasiswa::whereHas('ta_dua')->where('angkatan', $request->akt_ta2)->get();
        }
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar TA 2');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul TA 2');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas');
        $sheet->setCellValue('I1', 'Status Admin');
        $sheet->setCellValue('J1', 'Status Koordinator');
        $sheet->setCellValue('K1', 'Huruf Mutu');
        $sheet->setCellValue('L1', 'Nilai');
        $sheet->setCellValue('M1', 'No BA');
        $sheet->setCellValue('N1', 'URL');
        $sheet->setCellValue('O1', 'Tanggal Realisasi');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->ta_dua->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->ta_dua->pembimbing_satu->nama_dosen);
            if ($value->ta_dua->id_pembimbing_dua != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->ta_dua->pembimbing_dua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->ta_dua->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->ta_dua->pembahas->nama_dosen);
            $sheet->setCellValue('I' . ($key + 2), $value->ta_dua->status_admin);
            $sheet->setCellValue('J' . ($key + 2), $value->ta_dua->status_koor);
            if ($value->ta_dua->ba_seminar) {
                $sheet->setCellValue('K' . ($key + 2), $value->ta_dua->ba_seminar->huruf_mutu);
                $sheet->setCellValue('L' . ($key + 2), $value->ta_dua->ba_seminar->nilai);
                $sheet->setCellValue('M' . ($key + 2), $value->ta_dua->ba_seminar->no_berkas_ba_seminar_ta_dua);
                $sheet->setCellValue(
                    'N' . ($key + 2),
                    url('/uploads/ba_seminar_ta_dua/' . $value->ta_dua->ba_seminar->berkas_ba_seminar_ta_dua)
                );
                $sheet->setCellValue('O' . ($key + 2), $value->ta_dua->jadwal->tanggal_seminar_ta_dua);
            } else {
                $sheet->setCellValue('K' . ($key + 2), '-');
                $sheet->setCellValue('L' . ($key + 2), '-');
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_ta_2_' . $request->akt_ta2 . '.xlsx');
        return response()->download('seminar_ta_2_' . $request->akt_ta2 . '.xlsx')->deleteFileAfterSend(true);
    }



    public function ta1(Request $request)
    {
        if ($request->filled('start') && $request->filled('end') && $request->filled('akt_ta1')) {
            if ($request->end < $request->start) {
                return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }
            $mahasiswa = Mahasiswa::with(['ta_satu'])
                ->whereHas('ta_satu.jadwal', function ($query) use ($request) {
                    $query->whereBetween('tanggal_seminar_ta_satu', [$request->start, $request->end]);
                })
                ->where('angkatan', $request->akt_ta1)
                ->get();
        } else if ($request->filled('start') && $request->filled('akt_ta1')) {
            $mahasiswa = Mahasiswa::with(['ta_satu'])
                ->whereHas('ta_satu.jadwal', function ($query) use ($request) {
                    $query->where('tanggal_seminar_ta_satu', '>=', $request->start);
                })
                ->where('angkatan', $request->akt_ta1)
                ->get();
        } else if ($request->filled('end') && $request->filled('akt_ta1')) {
            $mahasiswa = Mahasiswa::with(['ta_satu'])
                ->whereHas('ta_satu.jadwal', function ($query) use ($request) {
                    $query->where('tanggal_seminar_ta_satu', '<=', $request->end);
                })
                ->where('angkatan', $request->akt_ta1)
                ->get();
        } else {
            $mahasiswa = Mahasiswa::whereHas('ta_satu')->where('angkatan', $request->akt_ta1)->get();
        }
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar TA 1');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul TA 1');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas');
        $sheet->setCellValue('I1', 'Status Admin');
        $sheet->setCellValue('J1', 'Status Koordinator');
        $sheet->setCellValue('K1', 'Huruf Mutu');
        $sheet->setCellValue('L1', 'Nilai');
        $sheet->setCellValue('M1', 'No BA');
        $sheet->setCellValue('N1', 'URL');
        $sheet->setCellValue('O1', 'Tanggal Realisasi');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->ta_satu->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->ta_satu->pembimbing_satu->nama_dosen);
            if ($value->ta_satu->id_pembimbing_dua != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->ta_satu->pembimbing_dua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->ta_satu->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->ta_satu->pembahas->nama_dosen);
            $sheet->setCellValue('I' . ($key + 2), $value->ta_satu->status_admin);
            $sheet->setCellValue('J' . ($key + 2), $value->ta_satu->status_koor);
            if ($value->ta_satu->ba_seminar) {
                $sheet->setCellValue('K' . ($key + 2), $value->ta_satu->ba_seminar->huruf_mutu);
                $sheet->setCellValue('L' . ($key + 2), $value->ta_satu->ba_seminar->nilai);
                $sheet->setCellValue('M' . ($key + 2), $value->ta_satu->ba_seminar->no_berkas_ba_seminar_ta_satu);
                $sheet->setCellValue('N' . ($key + 2), url('/uploads/ba_seminar_ta_satu/' . $value->ta_satu->ba_seminar->berkas_ba_seminar_ta_satu));
                $sheet->setCellValue('O' . ($key + 2), $value->ta_satu->jadwal->tanggal_seminar_ta_satu);
            } else {
                $sheet->setCellValue('K' . ($key + 2), '-');
                $sheet->setCellValue('L' . ($key + 2), '-');
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_ta_1_' . $request->akt_kp . '.xlsx');
        return response()->download('seminar_ta_1_' . $request->akt_kp . '.xlsx')->deleteFileAfterSend(true);
    }

    public function kp(Request $request)
    {
        if ($request->filled('start') && $request->filled('end') && $request->filled('akt_kp')) {
            $mahasiswa = Mahasiswa::with(['seminar_kp'])
                ->whereHas('seminar_kp.jadwal', function ($query) use ($request) {
                    $query->whereBetween('tanggal_skp', [$request->start, $request->end]);
                })
                ->where('angkatan', $request->akt_kp)
                ->get();
        } else if ($request->filled('start') && $request->filled('akt_kp')) {
            $mahasiswa = Mahasiswa::with(['seminar_kp'])
                ->whereHas('seminar_kp.jadwal', function ($query) use ($request) {
                    $query->where('tanggal_skp', '>=', $request->start);
                })
                ->where('angkatan', $request->akt_kp)
                ->get();
        } else if ($request->filled('end') && $request->filled('akt_kp')) {
            $mahasiswa = Mahasiswa::with(['seminar_kp'])
                ->whereHas('seminar_kp.jadwal', function ($query) use ($request) {
                    $query->where('tanggal_skp', '<=', $request->end);
                })
                ->where('angkatan', $request->akt_kp)
                ->get();
        } else {
            $mahasiswa = Mahasiswa::whereHas('seminar_kp')->where('angkatan', $request->akt_kp)->get();
        }

        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Kerja Praktik');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Tahun Akademik');
        $sheet->setCellValue('F1', 'Semester');
        $sheet->setCellValue('G1', 'Tema KP/PKL');
        $sheet->setCellValue('H1', 'Mitra');
        $sheet->setCellValue('I1', 'Region');
        $sheet->setCellValue('J1', 'Dosen Pembimbing');
        $sheet->setCellValue('K1', 'NP/NI/NIP Pembimbing Lapangan');
        $sheet->setCellValue('L1', 'Pembimbing Lapangan');
        $sheet->setCellValue('M1', 'Status Admin');
        $sheet->setCellValue('N1', 'Status Koordinator');
        $sheet->setCellValue('O1', 'Huruf Mutu');
        $sheet->setCellValue('P1', 'Nilai Angka');
        $sheet->setCellValue('Q1', 'No BA');
        $sheet->setCellValue('R1', 'URL');
        $sheet->setCellValue('S1', 'Tanggal Realisasi');

        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->seminar_kp->tahun_akademik);
            $sheet->setCellValue('F' . ($key + 2), $value->seminar_kp->semester);
            $sheet->setCellValue('G' . ($key + 2), $value->seminar_kp->judul_kp);
            $sheet->setCellValue('H' . ($key + 2), $value->seminar_kp->mitra);
            $sheet->setCellValue('I' . ($key + 2), $value->seminar_kp->region);
            $sheet->setCellValue('J' . ($key + 2), $value->seminar_kp->dosen->nama_dosen);
            $sheet->setCellValue('K' . ($key + 2), $value->seminar_kp->ni_pemlap);
            $sheet->setCellValue('L' . ($key + 2), $value->seminar_kp->pembimbing_lapangan);
            $sheet->setCellValue('M' . ($key + 2), $value->seminar_kp->proses_admin);
            $sheet->setCellValue('N' . ($key + 2), $value->seminar_kp->status_seminar);
            if ($value->seminar_kp->berita_acara) {
                $sheet->setCellValue('O' . ($key + 2), $value->seminar_kp->berita_acara->nilai_mutu);
                $sheet->setCellValue('P' . ($key + 2), $value->seminar_kp->berita_acara->nilai_akhir);
                $sheet->setCellValue('Q' . ($key + 2), $value->seminar_kp->berita_acara->no_ba_seminar_kp);
                $sheet->setCellValue('R' . ($key + 2), url('/uploads/berita_acara_seminar_kp/' . $value->seminar_kp->berita_acara->berkas_ba_seminar_kp));
                $sheet->setCellValue('S' . ($key + 2), $value->seminar_kp->jadwal->tanggal_skp);
            } else {
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
                $sheet->setCellValue('Q' . ($key + 2), '-');
                $sheet->setCellValue('R' . ($key + 2), '-');
                $sheet->setCellValue('S' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('kerja_praktik_' . $request->akt_kp . '.xlsx');
        return response()->download('kerja_praktik_' . $request->akt_kp . '.xlsx')->deleteFileAfterSend(true);
    }

    public function alumni(Request $request)
    {
        $mahasiswa = Mahasiswa::with(['user', 'pendataanAlumni', 'pekerjaanPertama', 'kegiatanTerakhir', 'dosen'])
            ->where('angkatan', $request->tahun_alumni)->whereHas('user', function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'mahasiswa');
                });
            })->whereHas('pendataanAlumni')
            ->where('status', 'Alumni')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Alumni');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'Tempat Lahir');
        $sheet->setCellValue('F1', 'No HP');
        $sheet->setCellValue('G1', 'Alamat');
        $sheet->setCellValue('H1', 'Jenis Kelamin');
        $sheet->setCellValue('I1', 'Tanggal Masuk');
        $sheet->setCellValue('J1', 'Angkatan');
        $sheet->setCellValue('K1', 'Dosen Pembimbing Akademik');
        $sheet->setCellValue('L1', 'IPK');
        $sheet->setCellValue('M1', 'Lama Studi');
        $sheet->setCellValue('N1', 'Pekerjaan Pertama');
        $sheet->setCellValue('O1', 'Salary');
        $sheet->setCellValue('P1', 'Mitra Kerja Pertama');
        $sheet->setCellValue('Q1', 'Lokasi');
        $sheet->setCellValue('R1', 'Status');
        $sheet->setCellValue('S1', 'Salary');
        $sheet->setCellValue('T1', 'Mitra');
        $sheet->setCellValue('U1', 'Lokasi');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->tanggal_lahir);
            $sheet->setCellValue('E' . ($key + 2), $value->tempat_lahir);
            $sheet->setCellValue('F' . ($key + 2), $value->no_hp);
            $sheet->setCellValue('G' . ($key + 2), $value->alamat);
            $sheet->setCellValue('H' . ($key + 2), $value->jenis_kelamin);
            $sheet->setCellValue('I' . ($key + 2), $value->tanggal_masuk);
            $sheet->setCellValue('J' . ($key + 2), $value->angkatan);
            $sheet->setCellValue('K' . ($key + 2), $value->dosen->nama_dosen);
            if ($value->pendataanAlumni) {
                $sheet->setCellValue('L' . ($key + 2), $value->pendataanAlumni->ipk);
                $sheet->setCellValue('M' . ($key + 2), $value->pendataanAlumni->masa_studi);
            } else {
                $sheet->setCellValue('L' . ($key + 2), '-');
                $sheet->setCellValue('M' . ($key + 2), '-');
            }
            if ($value->pekerjaanPertama) {
                $sheet->setCellValue('N' . ($key + 2), $value->pekerjaanPertama->jabatan);
                $sheet->setCellValue('O' . ($key + 2), $value->pekerjaanPertama->gaji);
                $sheet->setCellValue('P' . ($key + 2), $value->pekerjaanPertama->tempat);
                $sheet->setCellValue('Q' . ($key + 2), $value->pekerjaanPertama->alamat);
            } else {
                $sheet->setCellValue('N' . ($key + 2), "-");
                $sheet->setCellValue('O' . ($key + 2), "-");
                $sheet->setCellValue('P' . ($key + 2), "-");
                $sheet->setCellValue('Q' . ($key + 2), "-");
            }
            if ($value->kegiatanTerakhir) {
                $sheet->setCellValue('R' . ($key + 2), $value->kegiatanTerakhir->status);
                $sheet->setCellValue('S' . ($key + 2), $value->kegiatanTerakhir->gaji);
                $sheet->setCellValue('T' . ($key + 2), $value->kegiatanTerakhir->tempat);
                $sheet->setCellValue('U' . ($key + 2), $value->kegiatanTerakhir->alamat);
            } else {
                $sheet->setCellValue('R' . ($key + 2), "-");
                $sheet->setCellValue('S' . ($key + 2), "-");
                $sheet->setCellValue('T' . ($key + 2), "-");
                $sheet->setCellValue('U' . ($key + 2), "-");
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('alumni' . $request->tahun_alumni . '.xlsx');
        return response()->download('alumni' . $request->tahun_alumni . '.xlsx')->deleteFileAfterSend(true);
    }
    public function mahasiswa(Request $request)
    {
        $mahasiswa = Mahasiswa::with(['seminar_kp', 'ta_satu', 'ta_dua', 'komprehensif'])->where('angkatan', $request->tahun_mahasiswa)->whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            });
        })->get();

        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Mahasiswa');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'Tempat Lahir');
        $sheet->setCellValue('F1', 'No HP');
        $sheet->setCellValue('G1', 'Alamat');
        $sheet->setCellValue('H1', 'Jenis Kelamin');
        $sheet->setCellValue('I1', 'Tanggal Masuk');
        $sheet->setCellValue('J1', 'Angkatan');
        $sheet->setCellValue('K1', 'Semester');
        $sheet->setCellValue('L1', 'Status');
        $sheet->setCellValue('M1', 'Dosen Pembimbing');
        $sheet->setCellValue('N1', 'Seminar KP/PKL');
        $sheet->setCellValue('O1', 'Seminar TA 1');
        $sheet->setCellValue('P1', 'Seminar TA 2');
        $sheet->setCellValue('Q1', 'Seminar Komprehensif');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm ?? '-');
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa ?? '-');
            $sheet->setCellValue('D' . ($key + 2), $value->tanggal_lahir ?? '-');
            $sheet->setCellValue('E' . ($key + 2), $value->tempat_lahir ?? '-');
            $sheet->setCellValue('F' . ($key + 2), $value->no_hp ?? '-');
            $sheet->setCellValue('G' . ($key + 2), $value->alamat ?? '-');
            $sheet->setCellValue('H' . ($key + 2), $value->jenis_kelamin ?? '-');
            $sheet->setCellValue('I' . ($key + 2), $value->tanggal_masuk ?? '-');
            $sheet->setCellValue('J' . ($key + 2), $value->angkatan ?? '-');
            $sheet->setCellValue('K' . ($key + 2), $value->semester ?? '-');
            $sheet->setCellValue('L' . ($key + 2), $value->status ?? '-');
            $sheet->setCellValue('M' . ($key + 2), $value->dosen->nama_dosen ?? '-');
            $sheet->setCellValue('N' . ($key + 2), $value->seminar_kp ? $value->seminar_kp->status_seminar : '0');
            $sheet->setCellValue('O' . ($key + 2), $value->ta_satu ? $value->ta_satu->status_koor : '0');
            $sheet->setCellValue('P' . ($key + 2), $value->ta_dua ? $value->ta_dua->status_koor : '0');
            $sheet->setCellValue('Q' . ($key + 2), $value->komprehensif ? $value->komprehensif->status_koor : '0');
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('mahasiswa' . $request->tahun_mahasiswa . '.xlsx');
        return response()->download('mahasiswa_' . $request->tahun_mahasiswa . '.xlsx')->deleteFileAfterSend(true);
    }

    public function aktivitas(Request $request)
    {
        if ($request->filled('start') && $request->filled('end')) {
            $aktivitas = AktivitasMahasiswa::with('mahasiswa')
                ->whereBetween('tanggal', [$request->start, $request->end])
                ->get();
            $file_name = 'aktivitas_' . $request->start . '_' . $request->end;
        } else if ($request->filled('start')) {
            $aktivitas = AktivitasMahasiswa::with('mahasiswa')
                ->where('tanggal', '>=', $request->start)
                ->get();
            $file_name = 'aktivitas_greater_than_' . $request->start;
        } else if ($request->filled('end')) {
            $aktivitas = AktivitasMahasiswa::with('mahasiswa')
                ->where('tanggal', '<=', $request->end)
                ->get();
            $file_name = 'aktivitas_less_than_' . $request->end;
        } else {
            $aktivitas = AktivitasMahasiswa::with('mahasiswa')->get();
            $file_name = 'aktivitas_all';
        }
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Aktivitas Mahasiswa');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Aktivitas');
        $sheet->setCellValue('C1', 'Peran');
        $sheet->setCellValue('D1', 'SKS');
        $sheet->setCellValue('E1', 'Tanggal');
        $sheet->setCellValue('F1', 'URL');
        $sheet->setCellValue('G1', 'Tingkatan');
        $sheet->setCellValue('H1', 'Jenis');
        $sheet->setCellValue('I1', 'Kategori');
        $sheet->setCellValue('J1', 'Mahasiswa');
        $sheet->setCellValue('K1', 'NPM');
        $sheet->setCellValue('L1', 'Nama Pembimbing');
        $sheet->setCellValue('M1', 'NIP Pembimbing');
        foreach ($aktivitas as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_aktivitas);
            $sheet->setCellValue('C' . ($key + 2), $value->peran);
            $sheet->setCellValue('D' . ($key + 2), $value->sks_konversi);
            $sheet->setCellValue('E' . ($key + 2), $value->tanggal);
            $sheet->setCellValue('F' . ($key + 2), url('/uploads/file_act_mhs/' . $value->file_aktivitas));
            $sheet->setCellValue('G' . ($key + 2), $value->skala);
            $sheet->setCellValue('H' . ($key + 2), $value->jenis);
            $sheet->setCellValue('I' . ($key + 2), $value->kategori);
            $sheet->setCellValue('J' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
            $sheet->setCellValue('K' . ($key + 2), $value->mahasiswa->npm);
            $sheet->setCellValue('L' . ($key + 2), ($value->dosen->nama_dosen) ?? $value->nama_pembimbing);
            $sheet->setCellValue('M' . ($key + 2), ($value->dosen->nip) ?? $value->nip_pembimbing);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save($file_name . '.xlsx');
        return response()->download($file_name . '.xlsx')->deleteFileAfterSend(true);
    }
    public function prestasi(Request $request)
    {
        if ($request->filled(['start', 'end'])) {
            $date = $request->start . '-' . $request->end;
            $prestasi = PrestasiMahasiswa::with('mahasiswa')
                ->whereBetween('tanggal', [$request->start, $request->end])
                ->get();
        } elseif ($request->filled('start')) {
            $date = 'GreaterThan_' . $request->start;
            $prestasi = PrestasiMahasiswa::with('mahasiswa')
                ->where('tanggal', '>=', $request->start)
                ->get();
        } elseif ($request->filled('end')) {
            $date = 'LessThan_' . $request->end;
            $prestasi = PrestasiMahasiswa::with('mahasiswa')
                ->where('tanggal', '<=', $request->end)
                ->get();
        } else {
            $date = 'All';
            $prestasi = PrestasiMahasiswa::with('mahasiswa')->get();
        }
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Prestasi Mahasiswa');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Prestasi');
        $sheet->setCellValue('C1', 'Scala');
        $sheet->setCellValue('D1', 'Capaian');
        $sheet->setCellValue('E1', 'Tanggal');
        $sheet->setCellValue('F1', 'URL');
        $sheet->setCellValue('G1', 'Mahasiswa');
        $sheet->setCellValue('H1', 'Jenis');
        $sheet->setCellValue('I1', 'Nama Pembimbing');
        $sheet->setCellValue('J1', 'NIP Pembimbing');
        foreach ($prestasi as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_prestasi);
            $sheet->setCellValue('C' . ($key + 2), $value->scala);
            $sheet->setCellValue('D' . ($key + 2), $value->capaian);
            $sheet->setCellValue('E' . ($key + 2), $value->tanggal);
            $sheet->setCellValue('F' . ($key + 2), url('/uploads/file_prestasi/' . $value->file_prestasi));
            $sheet->setCellValue('G' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
            $sheet->setCellValue('H' . ($key + 2), $value->jenis);
            $sheet->setCellValue('I' . ($key + 2), ($value->dosen->nama_dosen) ?? $value->nama_pembimbing);
            $sheet->setCellValue('J' . ($key + 2), ($value->dosen->nip) ?? $value->nip_pembimbing);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('prestasi' . $date . '.xlsx');
        return response()->download('prestasi' . $date . '.xlsx')->deleteFileAfterSend(true);
    }

    public function penelitian(Request $request)
    {
        $penelitian = LitabmasDosen::with('anggota_litabmas')->where('tahun_penelitian', $request->tahun_penelitian)->where('kategori', 'Penelitian')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Penelitian Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Penelitian');
        $sheet->setCellValue('C1', 'Sumber Dana');
        $sheet->setCellValue('D1', 'Jumlah Dana');
        $sheet->setCellValue('E1', 'Tahun Penelitian');
        $sheet->setCellValue('F1', 'Anggota');
        $sheet->setCellValue('G1', 'Anggota External');
        foreach ($penelitian as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_litabmas);
            $sheet->setCellValue('C' . ($key + 2), $value->sumber_dana);
            $sheet->setCellValue('D' . ($key + 2), $value->jumlah_dana);
            $sheet->setCellValue('E' . ($key + 2), $value->tahun_penelitian);
            $sheet->setCellValue('F' . ($key + 2), $value->dosen->pluck('nama_dosen')->implode(', '));
            $sheet->setCellValue('G' . ($key + 2), $value->anggota_external);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('penelitian.xlsx');
        return response()->download('penelitian.xlsx')->deleteFileAfterSend(true);
    }
    public function pengabdian(Request $request)
    {
        $penelitian = LitabmasDosen::with('anggota_litabmas')->where('tahun_penelitian', $request->tahun_pengabdian)->where('kategori', 'Pengabdian')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Pengabdian Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Penelitian');
        $sheet->setCellValue('C1', 'Sumber Dana');
        $sheet->setCellValue('D1', 'Jumlah Dana');
        $sheet->setCellValue('E1', 'Tahun Penelitian');
        $sheet->setCellValue('F1', 'Anggota');
        $sheet->setCellValue('G1', 'Anggota External');
        foreach ($penelitian as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_litabmas);
            $sheet->setCellValue('C' . ($key + 2), $value->sumber_dana);
            $sheet->setCellValue('D' . ($key + 2), $value->jumlah_dana);
            $sheet->setCellValue('E' . ($key + 2), $value->tahun_penelitian);
            $sheet->setCellValue('F' . ($key + 2), $value->dosen->pluck('nama_dosen')->implode(', '));
            $sheet->setCellValue('G' . ($key + 2), $value->anggota_external);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('pengabdian.xlsx');
        return response()->download('pengabdian.xlsx')->deleteFileAfterSend(true);
    }
    public function publikasi(Request $request)
    {
        $publikasi = PublikasiDosen::with('anggotaPublikasi')->where('tahun', $request->tahun_publikasi)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Publikasi Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Publikasi');
        $sheet->setCellValue('C1', 'Volume');
        $sheet->setCellValue('D1', 'Halaman');
        $sheet->setCellValue('E1', 'Judul');
        $sheet->setCellValue('F1', 'Tahun');
        $sheet->setCellValue('G1', 'Scala');
        $sheet->setCellValue('H1', 'Kategori');
        $sheet->setCellValue('I1', 'Kategori Litabmas');
        $sheet->setCellValue('J1', 'URL');
        $sheet->setCellValue('K1', 'Anggota');
        $sheet->setCellValue('L1', 'Anggota External');
        foreach ($publikasi as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_publikasi);
            $sheet->setCellValue('C' . ($key + 2), $value->vol);
            $sheet->setCellValue('D' . ($key + 2), $value->halaman);
            $sheet->setCellValue('E' . ($key + 2), $value->judul);
            $sheet->setCellValue('F' . ($key + 2), $value->tahun);
            $sheet->setCellValue('G' . ($key + 2), $value->scala);
            $sheet->setCellValue('H' . ($key + 2), $value->kategori);
            $sheet->setCellValue('I' . ($key + 2), $value->kategori_litabmas);
            $sheet->setCellValue('J' . ($key + 2), $value->url);
            $sheet->setCellValue('K' . ($key + 2), $value->dosen->pluck('nama_dosen')->implode(', '));
            $sheet->setCellValue('L' . ($key + 2), $value->anggota_external);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('publikasi.xlsx');
        return response()->download('publikasi.xlsx')->deleteFileAfterSend(true);
    }
}
