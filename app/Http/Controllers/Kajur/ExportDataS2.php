<?php

namespace App\Http\Controllers\Kajur;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\ModelSPDosen;
use Illuminate\Http\Request;
use App\Models\LitabmasDosen;
use App\Models\PublikasiDosen;
use App\Models\PrestasiMahasiswaS2;
use App\Http\Controllers\Controller;
use App\Models\AktivitasMahasiswaS2;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class ExportDataS2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pengabdian' => LitabmasDosen::select('tahun_penelitian')->distinct()->orderBy('tahun_penelitian', 'desc')
                ->where('kategori', 'Pengabdian')
                ->get(),
            'penelitian' => LitabmasDosen::select('tahun_penelitian')->distinct()->orderBy('tahun_penelitian', 'desc')
                ->where('kategori', 'Penelitian')
                ->get(),
            'publikasi' => PublikasiDosen::select('tahun')->distinct()->orderBy('tahun', 'desc')
                ->get(),
            'prestasi' => PrestasiMahasiswaS2::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')
                ->get(),
            'aktivitas' => AktivitasMahasiswaS2::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')
                ->get(),
            'seminar_dosen' => ModelSPDosen::selectRaw('YEAR(tahun) as tahun')->distinct()->where('jenis', 'Seminar')->orderBy('tahun', 'desc')
                ->get(),
            'penghargaan_dosen' => ModelSPDosen::selectRaw('YEAR(tahun) as tahun')->distinct()->where('jenis', 'Penghargaan')->orderBy('tahun', 'desc')
                ->get(),
            'tesis_1' => Mahasiswa::select('angkatan')->distinct()->whereHas('taSatuS2')->orderBy('angkatan', 'desc')
                ->get(),
            'tesis_2' => Mahasiswa::select('angkatan')->distinct()->whereHas('taDuaS2')->orderBy('angkatan', 'desc')
                ->get(),
            'sidang' =>  Mahasiswa::select('angkatan')->distinct()->whereHas('komprehensifS2')->orderBy('angkatan', 'desc')
                ->get(),
            'mahasiswa' => Mahasiswa::select('angkatan')->distinct()->whereHas('user', function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'mahasiswaS2');
                });
            })->orderBy('angkatan', 'desc')
                ->get(),
            'alumni' => Mahasiswa::select('angkatan')->distinct()->where('status', 'Alumni')->whereHas('user', function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'mahasiswaS2');
                });
            })->orderBy('angkatan', 'desc')
                ->get(),
        ];
        return view('jurusan.exportS2.index', $data);
    }
    public function alumni(Request $request)
    {
        $mahasiswa = Mahasiswa::where('angkatan', $request->tahun_alumni)->whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswaS2');
            });
        })->where('status', 'Alumni')->get();

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
        $sheet->setCellValue('L1', 'Pekerjaan Pertama');
        $sheet->setCellValue('M1', 'Salary');
        $sheet->setCellValue('N1', 'Mitra Kerja Pertama');
        $sheet->setCellValue('O1', 'Lokasi');
        $sheet->setCellValue('P1', 'Status');
        $sheet->setCellValue('Q1', 'Salary');
        $sheet->setCellValue('R1', 'Mitra');
        $sheet->setCellValue('S1', 'Lokasi');
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
            if ($value->pekerjaanPertama) {
                $sheet->setCellValue('L' . ($key + 2), $value->pekerjaanPertama->jabatan);
                $sheet->setCellValue('M' . ($key + 2), $value->pekerjaanPertama->gaji);
                $sheet->setCellValue('N' . ($key + 2), $value->pekerjaanPertama->tempat);
                $sheet->setCellValue('O' . ($key + 2), $value->pekerjaanPertama->alamat);
            } else {
                $sheet->setCellValue('L' . ($key + 2), '-');
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
            }
            if ($value->kegiatanTerakhir) {
                $sheet->setCellValue('p' . ($key + 2), $value->kegiatanTerakhir->status);
                $sheet->setCellValue('Q' . ($key + 2), $value->kegiatanTerakhir->gaji);
                $sheet->setCellValue('R' . ($key + 2), $value->kegiatanTerakhir->tempat);
                $sheet->setCellValue('S' . ($key + 2), $value->kegiatanTerakhir->alamat);
            } else {
                $sheet->setCellValue('p' . ($key + 2), "-");
                $sheet->setCellValue('Q' . ($key + 2), "-");
                $sheet->setCellValue('R' . ($key + 2), "-");
                $sheet->setCellValue('S' . ($key + 2), "-");
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('alumniS2_' . $request->tahun_alumni . '.xlsx');
        return response()->download('alumniS2_' . $request->tahun_alumni . '.xlsx')->deleteFileAfterSend(true);
    }
    public function mahasiswaS2Seminar(Request $request)
    {
        $mahasiswa = User::with('mahasiswa');
        if ($request->angkatan != '1') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                if ($request->angkatan != '1') {
                    $query->where('angkatan', $request->angkatan);
                }
            });
        }
        if ($request->tesis1 != '1' && $request->tesis1 != 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereHas('taSatuS2', function ($query) use ($request) {
                    $query->where('status_koor', $request->tesis1);
                });
            });
        } else if ($request->tesis1 == 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereDoesntHave('taSatuS2');
            });
        }

        if ($request->tesis2 != '1' && $request->tesis2 != 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereHas('taDuaS2', function ($query) use ($request) {
                    $query->where('status_koor', $request->tesis2);
                });
            });
        } else if ($request->tesis2 == 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereDoesntHave('taDuaS2');
            });
        }

        if ($request->tesis3 != '1' && $request->tesis3 != 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereHas('komprehensifS2', function ($query) use ($request) {
                    $query->where('status_koor', $request->tesis3);
                });
            });
        } else if ($request->tesis3 == 'null') {
            $mahasiswa->whereHas('mahasiswa', function ($query) use ($request) {
                $query->whereDoesntHave('komprehensifS2');
            });
        }

        $mahasiswa = $mahasiswa->role('mahasiswaS2')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Data Mahasiswa Seminar');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Angkatan');
        $sheet->setCellValue('F1', 'Dosen Pembimbing Akademik');
        $sheet->setCellValue('G1', 'Seminar Tesis 1');
        $sheet->setCellValue('H1', 'Seminar Tesis 2');
        $sheet->setCellValue('I1', 'Sidang Tesis');
        foreach ($mahasiswa as $key => $item) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $item->mahasiswa->npm);
            $sheet->setCellValue('C' . ($key + 2), $item->mahasiswa->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $item->mahasiswa->status);
            $sheet->setCellValue('E' . ($key + 2), $item->mahasiswa->angkatan);
            $sheet->setCellValue('F' . ($key + 2), $item->mahasiswa->dosen->nama_dosen ?? '-');
            $sheet->setCellValue('G' . ($key + 2), $item->mahasiswa->taSatuS2 ?  $item->mahasiswa->taSatuS2->status_koor : '-');
            $sheet->setCellValue('H' . ($key + 2), $item->mahasiswa->taDuaS2 ?  $item->mahasiswa->taDuaS2->status_koor : '-');
            $sheet->setCellValue('I' . ($key + 2), $item->mahasiswa->komprehensifS2 ?  $item->mahasiswa->komprehensifS2->status_koor : '-');
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('data_mahasiswaS2_seminar.xlsx');
        return response()->download('data_mahasiswaS2_seminar.xlsx')->deleteFileAfterSend(true);
    }

    public function mahasiswas2(Request $request)
    {
        $mahasiswa = Mahasiswa::with(['taSatuS2', 'taDuaS2', 'komprehensifS2'])->where('angkatan', $request->tahun_mahasiswa)->whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswaS2');
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
        $sheet->setCellValue('N1', 'Seminar Tesis 1');
        $sheet->setCellValue('O1', 'Seminar Tesis 2');
        $sheet->setCellValue('P1', 'Seminar Sidang Tesis');
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
            $sheet->setCellValue('N' . ($key + 2), $value->taSatuS2 ? $value->taSatuS2->status_koor : '0');
            $sheet->setCellValue('O' . ($key + 2), $value->taDuaS2 ? $value->taDuaS2->status_koor : '0');
            $sheet->setCellValue('P' . ($key + 2), $value->komprehensifS2 ? $value->komprehensifS2->status_koor : '0');
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('mahasiswa_s2_' . $request->tahun_mahasiswa . '.xlsx');
        return response()->download('mahasiswa_s2_' . $request->tahun_mahasiswa . '.xlsx')->deleteFileAfterSend(true);
    }

    public function sidang(Request $request)
    {
        $mahasiswa = Mahasiswa::whereHas('komprehensifS2')->where('angkatan', $request->akt_sidang)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Sidang Tesis');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul Tesis');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas 1');
        $sheet->setCellValue('I1', 'Pembahas 2');
        $sheet->setCellValue('J1', 'Pembahas 3');
        $sheet->setCellValue('K1', 'Status Admin');
        $sheet->setCellValue('L1', 'Status Koordinator');
        $sheet->setCellValue('M1', 'Nilai Mutu');
        $sheet->setCellValue('N1', 'Nilai');
        $sheet->setCellValue('O1', 'No BA');
        $sheet->setCellValue('P1', 'URL');
        $sheet->setCellValue('Q1', 'Tanggal Sidang');

        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->komprehensifS2->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->komprehensifS2->pembimbingSatu->nama_dosen);
            if ($value->komprehensifS2->id_pembimbing_2 != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->komprehensifS2->pembimbingDua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->komprehensifS2->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->komprehensifS2->pembahasSatu ? $value->komprehensifS2->pembahasSatu->nama_dosen : $value->komprehensifS2->pembahas_external_1);
            $sheet->setCellValue('I' . ($key + 2), $value->komprehensifS2->pembahasDua ? $value->komprehensifS2->pembahasDua->nama_dosen : $value->komprehensifS2->pembahas_external_2);
            $sheet->setCellValue('J' . ($key + 2), $value->komprehensifS2->pembahasTiga ? $value->komprehensifS2->pembahasTiga->nama_dosen : $value->komprehensifS2->pembahas_external_3);

            $sheet->setCellValue('K' . ($key + 2), $value->komprehensifS2->status_admin);
            $sheet->setCellValue('L' . ($key + 2), $value->komprehensifS2->status_koor);
            if ($value->komprehensifS2->beritaAcara) {
                $sheet->setCellValue('M' . ($key + 2), $value->komprehensifS2->beritaAcara->nilai_mutu);
                $sheet->setCellValue('N' . ($key + 2), $value->komprehensifS2->beritaAcara->nilai);
                $sheet->setCellValue('O' . ($key + 2), $value->komprehensifS2->beritaAcara->no_ba);
                $sheet->setCellValue('P' . ($key + 2), url('/uploads/ba_sidang_tesis/' . $value->taDuaS2->beritaAcara->file_ba));
                $sheet->setCellValue('Q' . ($key + 2), $value->komprehensifS2->jadwal->tanggal);
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
                $sheet->setCellValue('Q' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('sidang_tesis_' . $request->akt_sidang. '.xlsx');
        return response()->download('sidang_tesis_' . $request->akt_sidang   . '.xlsx')->deleteFileAfterSend(true);
    }

    public function tesis2(Request $request)
    {
        $mahasiswa = Mahasiswa::whereHas('taDuaS2')->where('angkatan', $request->akt_tesis_2)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar Tesis 2');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul Tesis');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas 1');
        $sheet->setCellValue('I1', 'Pembahas 2');
        $sheet->setCellValue('J1', 'Pembahas 3');
        $sheet->setCellValue('K1', 'Status Admin');
        $sheet->setCellValue('L1', 'Status Koordinator');
        $sheet->setCellValue('M1', 'Nilai Mutu');
        $sheet->setCellValue('N1', 'Nilai');
        $sheet->setCellValue('O1', 'No BA');
        $sheet->setCellValue('P1', 'URL');
        $sheet->setCellValue('Q1', 'Tanggal Seminar');

        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->taDuaS2->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->taDuaS2->pembimbingSatu->nama_dosen);
            if ($value->taDuaS2->id_pembimbing_2 != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->taDuaS2->pembimbingDua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->taDuaS2->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->taDuaS2->pembahasSatu ? $value->taDuaS2->pembahasSatu->nama_dosen : $value->taDuaS2->pembahas_external_1);
            $sheet->setCellValue('I' . ($key + 2), $value->taDuaS2->pembahasDua ? $value->taDuaS2->pembahasDua->nama_dosen : $value->taDuaS2->pembahas_external_2);
            $sheet->setCellValue('J' . ($key + 2), $value->taDuaS2->pembahasTiga ? $value->taDuaS2->pembahasTiga->nama_dosen : $value->taDuaS2->pembahas_external_3);

            $sheet->setCellValue('K' . ($key + 2), $value->taDuaS2->status_admin);
            $sheet->setCellValue('L' . ($key + 2), $value->taDuaS2->status_koor);
            if ($value->taDuaS2->beritaAcara) {
                $sheet->setCellValue('M' . ($key + 2), $value->taDuaS2->beritaAcara->nilai_mutu);
                $sheet->setCellValue('N' . ($key + 2), $value->taDuaS2->beritaAcara->nilai);
                $sheet->setCellValue('O' . ($key + 2), $value->taDuaS2->beritaAcara->no_ba);
                $sheet->setCellValue('P' . ($key + 2), url('/uploads/ba_seminar_tesis_2/' . $value->taDuaS2->beritaAcara->file_ba));
                $sheet->setCellValue('Q' . ($key + 2), $value->taDuaS2->jadwal->tanggal);
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
                $sheet->setCellValue('Q' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_tesis_2_' . $request->akt_tesis_2     . '.xlsx');
        return response()->download('seminar_tesis_2_' . $request->akt_tesis_2   . '.xlsx')->deleteFileAfterSend(true);
    }
    public function tesis1(Request $request)
    {
        $mahasiswa = Mahasiswa::whereHas('taSatuS2')->where('angkatan', $request->akt_tesis_1)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar Tesis 1');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul Tesis');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas 1');
        $sheet->setCellValue('I1', 'Pembahas 2');
        $sheet->setCellValue('J1', 'Pembahas 3');
        $sheet->setCellValue('K1', 'Status Admin');
        $sheet->setCellValue('L1', 'Status Koordinator');
        $sheet->setCellValue('M1', 'Nilai Mutu');
        $sheet->setCellValue('N1', 'Nilai');
        $sheet->setCellValue('O1', 'No BA');
        $sheet->setCellValue('P1', 'URL');
        $sheet->setCellValue('Q1', 'Tanggal Seminar');

        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->taSatuS2->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->taSatuS2->pembimbingSatu->nama_dosen);
            if ($value->taSatuS2->id_pembimbing_2 != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->taSatuS2->pembimbingDua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->taSatuS2->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->taSatuS2->pembahasSatu ? $value->taSatuS2->pembahasSatu->nama_dosen : $value->taSatuS2->pembahas_external_1);
            $sheet->setCellValue('I' . ($key + 2), $value->taSatuS2->pembahasDua ? $value->taSatuS2->pembahasDua->nama_dosen : $value->taSatuS2->pembahas_external_2);
            $sheet->setCellValue('J' . ($key + 2), $value->taSatuS2->pembahasTiga ? $value->taSatuS2->pembahasTiga->nama_dosen : $value->taSatuS2->pembahas_external_3);

            $sheet->setCellValue('K' . ($key + 2), $value->taSatuS2->status_admin);
            $sheet->setCellValue('L' . ($key + 2), $value->taSatuS2->status_koor);
            if ($value->taSatuS2->beritaAcara) {
                $sheet->setCellValue('M' . ($key + 2), $value->taSatuS2->beritaAcara->nilai_mutu);
                $sheet->setCellValue('N' . ($key + 2), $value->taSatuS2->beritaAcara->nilai);
                $sheet->setCellValue('O' . ($key + 2), $value->taSatuS2->beritaAcara->no_ba);
                $sheet->setCellValue('P' . ($key + 2), url('/uploads/ba_seminar_tesis_1/' . $value->taSatuS2->beritaAcara->file_ba));
                $sheet->setCellValue('Q' . ($key + 2), $value->taSatuS2->jadwal->tanggal);
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
                $sheet->setCellValue('Q' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_tesis_1_' . $request->akt_tesis_1 . '.xlsx');
        return response()->download('seminar_tesis_1_' . $request->akt_tesis_1 . '.xlsx')->deleteFileAfterSend(true);
    }
    public function aktivitasS2(Request $request)
    {
        $aktivitas = AktivitasMahasiswaS2::with('mahasiswa')->whereYear('tanggal', $request->tahun_aktivitas)->get();
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
            $sheet->setCellValue('L' . ($key + 2), ($value->dosen->nama_dosen)??$value->nama_pembimbing);
            $sheet->setCellValue('M' . ($key + 2), ($value->dosen->nip)??$value->nip_pembimbing);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('aktivitas_s2_' . $request->tahun_aktivitas . '.xlsx');
        return response()->download('aktivitas_s2_' . $request->tahun_aktivitas . '.xlsx')->deleteFileAfterSend(true);
    }

    public function prestasiS2(Request $request)
    {
        $prestasi = PrestasiMahasiswaS2::with('mahasiswa')->whereYear('tanggal', $request->tahun_prestasi)->get();
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
            $sheet->setCellValue('I' . ($key + 2), ($value->dosen->nama_dosen)??$value->nama_pembimbing);
            $sheet->setCellValue('J' . ($key + 2), ($value->dosen->nip)??$value->nip_pembimbing);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('prestasi_s2_' . $request->tahun_prestasi . '.xlsx');
        return response()->download('prestasi_s2_' . $request->tahun_prestasi . '.xlsx')->deleteFileAfterSend(true);
    }
}
