<?php

namespace App\Http\Controllers\bimbingan;

use App\Models\Mahasiswa;
use App\Models\ModelKompreS2;
use App\Models\ModelSeminarTaDuaS2;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MahasiswaBimbinganTesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seminar = ModelSeminarTaSatuS2::where('id_pembimbing_1', Auth::user()->dosen->id)
            ->orWhere('id_pembimbing_2', Auth::user()->dosen->id)
            ->get();
        $mahasiswa = Mahasiswa::select('angkatan')->distinct()->whereHas('taSatuS2', function ($query) {
            $query->where('id_pembimbing_1', Auth::user()->dosen->id)
                ->orWhere('id_pembimbing_2', Auth::user()->dosen->id);
        })->orWhereHas('taDuaS2', function ($query) {
            $query->where('id_pembimbing_1', Auth::user()->dosen->id)
                ->orWhere('id_pembimbing_2', Auth::user()->dosen->id);
        })->orWhereHas('komprehensifS2', function ($query) {
            $query->where('id_pembimbing_1', Auth::user()->dosen->id)
                ->orWhere('id_pembimbing_2', Auth::user()->dosen->id);
        })->get();
        return view('dosen.mahasiswa.bimbingan.kompre.index', compact('seminar', 'mahasiswa'));
    }
    public function export(Request $request)
    {
        $ta1 = Mahasiswa::with(['taSatuS2.pembimbingSatu', 'taSatuS2.pembimbingDua', 'taSatuS2.pembahasSatu', 'taSatuS2.pembahasDua', 'taSatuS2.pembahasTiga', 'taSatuS2.jadwal', 'taSatuS2.beritaAcara'])
            ->where('angkatan', $request->ta_unduh)->whereHas('taSatuS2', function ($query) {
                $query->where('id_pembimbing_1', Auth::user()->dosen->id)
                    ->orWhere('id_pembimbing_2', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_1', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_2', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_3', Auth::user()->dosen->id);
            })->get();
        $ta2 = Mahasiswa::with(['taDuaS2.pembimbingSatu', 'taDuaS2.pembimbingDua', 'taDuaS2.pembahasSatu', 'taDuaS2.pembahasDua', 'taDuaS2.pembahasTiga', 'taDuaS2.jadwal', 'taDuaS2.beritaAcara'])
            ->where('angkatan', $request->ta_unduh)->whereHas('taDuaS2', function ($query) {
                $query->where('id_pembimbing_1', Auth::user()->dosen->id)
                    ->orWhere('id_pembimbing_2', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_1', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_2', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_3', Auth::user()->dosen->id);
            })->get();
        $kompre = Mahasiswa::with(['komprehensifS2.pembimbingSatu', 'komprehensifS2.pembimbingDua', 'komprehensifS2.pembahasSatu', 'komprehensifS2.pembahasDua', 'komprehensifS2.pembahasTiga', 'komprehensifS2.jadwal', 'komprehensifS2.beritaAcara'])
            ->where('angkatan', $request->ta_unduh)->whereHas('komprehensifS2', function ($query) {
                $query->where('id_pembimbing_1', Auth::user()->dosen->id)
                    ->orWhere('id_pembimbing_2', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_1', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_2', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas_3', Auth::user()->dosen->id);
            })->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('TESIS 1');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Semester');
        $sheet->setCellValue('E1', 'Tahun Akademik');
        $sheet->setCellValue('F1', 'Judul TESIS');
        $sheet->setCellValue('G1', 'Pembimbing 1');
        $sheet->setCellValue('H1', 'Pembimbing 2');
        $sheet->setCellValue('I1', 'Pembahas 1');
        $sheet->setCellValue('J1', 'Pembahas 2');
        $sheet->setCellValue('K1', 'Pembahas 3');
        $sheet->setCellValue('L1', 'Tanggal Seminar');
        $sheet->setCellValue('M1', 'Nilai');
        $sheet->setCellValue('N1', 'Nilai Mutu');
        $sheet->setCellValue('O1', 'NO BA');
        $sheet->setCellValue('P1', 'Berita Acara');
        $sheet->setCellValue('Q1', 'Status Admin');
        $sheet->setCellValue('R1', 'Status Koordinator');

        foreach ($ta1 as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->taSatuS2->semester);
            $sheet->setCellValue('E' . ($key + 2), $value->taSatuS2->tahun_akademik);
            $sheet->setCellValue('F' . ($key + 2), $value->taSatuS2->judul_ta);
            $sheet->setCellValue('G' . ($key + 2), $value->taSatuS2->pembimbingSatu->nama_dosen);
            if ($value->taSatuS2->id_pembimbing_2 != null) {
                $sheet->setCellValue('H' . ($key + 2), $value->taSatuS2->pembimbingDua->nama_dosen);
            } else {
                $sheet->setCellValue('H' . ($key + 2), $value->taSatuS2->pbl2_nama);
            }
            if ($value->taSatuS2->id_pembahas_1 != null) {
                $sheet->setCellValue('I' . ($key + 2), $value->taSatuS2->pembahasSatu->nama_dosen);
            } else {
                $sheet->setCellValue('I' . ($key + 2), $value->taSatuS2->pembahas_external_1);
            }
            if ($value->taSatuS2->id_pembahas_2 != null) {
                $sheet->setCellValue('J' . ($key + 2), $value->taSatuS2->pembahasDua->nama_dosen);
            } else {
                $sheet->setCellValue('J' . ($key + 2), $value->taSatuS2->pembahas_external_2);
            }
            if ($value->taSatuS2->id_pembahas_3 != null) {
                $sheet->setCellValue('K' . ($key + 2), $value->taSatuS2->pembahasTiga->nama_dosen);
            } else {
                $sheet->setCellValue('K' . ($key + 2), $value->taSatuS2->pembahas_external_3);
            }
            $sheet->setCellValue('L' . ($key + 2), ($value->taSatuS2->jadwal != null) ? $value->taSatuS2->jadwal->tanggal : '-');
            if ($value->taSatuS2->beritaAcara) {
                $sheet->setCellValue('M' . ($key + 2), $value->taSatuS2->beritaAcara->nilai);
                $sheet->setCellValue('N' . ($key + 2), $value->taSatuS2->beritaAcara->nilai_mutu);
                $sheet->setCellValue('O' . ($key + 2), $value->taSatuS2->beritaAcara->no_ba);
                $sheet->setCellValue('P' . ($key + 2), url('uploads/ba_seminar_tesis_1/' . $value->taSatuS2->beritaAcara->file_ba));
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
            }
            $sheet->setCellValue('Q' . ($key + 2), $value->taSatuS2->status_admin);
            $sheet->setCellValue('R' . ($key + 2), $value->taSatuS2->status_koor);
        }
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('TESIS 2');
        $sheet2->setCellValue('A1', 'No');
        $sheet2->setCellValue('B1', 'NPM');
        $sheet2->setCellValue('C1', 'Nama');
        $sheet2->setCellValue('D1', 'Semester');
        $sheet2->setCellValue('E1', 'Tahun Akademik');
        $sheet2->setCellValue('F1', 'Judul TESIS');
        $sheet2->setCellValue('G1', 'Pembimbing 1');
        $sheet2->setCellValue('H1', 'Pembimbing 2');
        $sheet2->setCellValue('I1', 'Pembahas 1');
        $sheet2->setCellValue('J1', 'Pembahas 2');
        $sheet2->setCellValue('K1', 'Pembahas 3');
        $sheet2->setCellValue('L1', 'Tanggal Seminar');
        $sheet2->setCellValue('M1', 'Nilai');
        $sheet2->setCellValue('N1', 'Nilai Mutu');
        $sheet2->setCellValue('O1', 'NO BA');
        $sheet2->setCellValue('P1', 'Berita Acara');
        $sheet2->setCellValue('Q1', 'Status Admin');
        $sheet2->setCellValue('R1', 'Status Koordinator');

        foreach ($ta2 as $key => $value) {
            $sheet2->setCellValue('A' . ($key + 2), $key + 1);
            $sheet2->setCellValue('B' . ($key + 2), $value->npm);
            $sheet2->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet2->setCellValue('D' . ($key + 2), $value->taDuaS2->semester);
            $sheet2->setCellValue('E' . ($key + 2), $value->taDuaS2->tahun_akademik);
            $sheet2->setCellValue('F' . ($key + 2), $value->taDuaS2->judul_ta);
            $sheet2->setCellValue('G' . ($key + 2), $value->taDuaS2->pembimbingSatu->nama_dosen);
            if ($value->taDuaS2->id_pembimbing_2 != null) {
                $sheet2->setCellValue('H' . ($key + 2), $value->taDuaS2->pembimbingDua->nama_dosen);
            } else {
                $sheet2->setCellValue('H' . ($key + 2), $value->taDuaS2->pbl2_nama);
            }
            if ($value->taDuaS2->id_pembahas_1 != null) {
                $sheet2->setCellValue('I' . ($key + 2), $value->taDuaS2->pembahasSatu->nama_dosen);
            } else {
                $sheet2->setCellValue('I' . ($key + 2), $value->taDuaS2->pembahas_external_1);
            }
            if ($value->taDuaS2->id_pembahas_2 != null) {
                $sheet2->setCellValue('J' . ($key + 2), $value->taDuaS2->pembahasDua->nama_dosen);
            } else {
                $sheet2->setCellValue('J' . ($key + 2), $value->taDuaS2->pembahas_external_2);
            }
            if ($value->taDuaS2->id_pembahas_3 != null) {
                $sheet2->setCellValue('K' . ($key + 2), $value->taDuaS2->pembahasTiga->nama_dosen);
            } else {
                $sheet2->setCellValue('K' . ($key + 2), $value->taDuaS2->pembahas_external_3);
            }
            $sheet2->setCellValue('L' . ($key + 2), ($value->taDuaS2->jadwal != null) ? $value->taDuaS2->jadwal->tanggal : '-');
            if ($value->taDuaS2->beritaAcara) {
                $sheet2->setCellValue('M' . ($key + 2), $value->taDuaS2->beritaAcara->nilai);
                $sheet2->setCellValue('N' . ($key + 2), $value->taDuaS2->beritaAcara->file_nilai);
                $sheet2->setCellValue('O' . ($key + 2), $value->taDuaS2->beritaAcara->no_ba);
                $sheet2->setCellValue('P' . ($key + 2), url('uploads/ba_seminar_tesis_2/' . $value->taDuaS2->beritaAcara->file_ba));
            } else {
                $sheet2->setCellValue('M' . ($key + 2), '-');
                $sheet2->setCellValue('N' . ($key + 2), '-');
                $sheet2->setCellValue('O' . ($key + 2), '-');
                $sheet2->setCellValue('P' . ($key + 2), '-');
            }
            $sheet2->setCellValue('Q' . ($key + 2), $value->taDuaS2->status_admin);
            $sheet2->setCellValue('R' . ($key + 2), $value->taDuaS2->status_koor);
        }
        $sheet3 = $spreadsheet->createSheet();
        $sheet3->setTitle('Sidang Tesis');
        $sheet3->setCellValue('A1', 'No');
        $sheet3->setCellValue('B1', 'NPM');
        $sheet3->setCellValue('C1', 'Nama');
        $sheet3->setCellValue('D1', 'Semester');
        $sheet3->setCellValue('E1', 'Tahun Akademik');
        $sheet3->setCellValue('F1', 'Judul TESIS');
        $sheet3->setCellValue('G1', 'Pembimbing 1');
        $sheet3->setCellValue('H1', 'Pembimbing 2');
        $sheet3->setCellValue('I1', 'Pembahas 1');
        $sheet3->setCellValue('J1', 'Pembahas 2');
        $sheet3->setCellValue('K1', 'Pembahas 3');
        $sheet3->setCellValue('L1', 'Tanggal Seminar');
        $sheet3->setCellValue('M1', 'Nilai');
        $sheet3->setCellValue('N1', 'Nilai Mutu');
        $sheet3->setCellValue('O1', 'NO BA');
        $sheet3->setCellValue('P1', 'Berita Acara');
        $sheet3->setCellValue('Q1', 'Status Admin');
        $sheet3->setCellValue('R1', 'Status Koordinator');

        foreach ($kompre as $key => $value) {
            $sheet3->setCellValue('A' . ($key + 2), $key + 1);
            $sheet3->setCellValue('B' . ($key + 2), $value->npm);
            $sheet3->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet3->setCellValue('D' . ($key + 2), $value->komprehensifS2->semester);
            $sheet3->setCellValue('E' . ($key + 2), $value->komprehensifS2->tahun_akademik);
            $sheet3->setCellValue('F' . ($key + 2), $value->komprehensifS2->judul_ta);
            $sheet3->setCellValue('G' . ($key + 2), $value->komprehensifS2->pembimbingSatu->nama_dosen);
            if ($value->komprehensifS2->id_pembimbing_2 != null) {
                $sheet3->setCellValue('H' . ($key + 2), $value->komprehensifS2->pembimbingDua->nama_dosen);
            } else {
                $sheet3->setCellValue('H' . ($key + 2), $value->komprehensifS2->pbl2_nama);
            }
            if ($value->komprehensifS2->id_pembahas_1 != null) {
                $sheet3->setCellValue('I' . ($key + 2), $value->komprehensifS2->pembahasSatu->nama_dosen);
            } else {
                $sheet3->setCellValue('I' . ($key + 2), $value->komprehensifS2->pembahas_external_1);
            }
            if ($value->komprehensifS2->id_pembahas_2 != null) {
                $sheet3->setCellValue('J' . ($key + 2), $value->komprehensifS2->pembahasDua->nama_dosen);
            } else {
                $sheet3->setCellValue('J' . ($key + 2), $value->komprehensifS2->pembahas_external_2);
            }
            if ($value->komprehensifS2->id_pembahas_3 != null) {
                $sheet3->setCellValue('K' . ($key + 2), $value->komprehensifS2->pembahasTiga->nama_dosen);
            } else {
                $sheet3->setCellValue('K' . ($key + 2), $value->komprehensifS2->pembahas_external_3);
            }
            $sheet3->setCellValue('L' . ($key + 2), ($value->komprehensifS2->jadwal != null) ? $value->komprehensifS2->jadwal->tanggal : '-');
            if ($value->komprehensifS2->beritaAcara) {
                $sheet3->setCellValue('M' . ($key + 2), $value->komprehensifS2->beritaAcara->nilai);
                $sheet3->setCellValue('N' . ($key + 2), $value->komprehensifS2->beritaAcara->huruf_mutu);
                $sheet3->setCellValue('O' . ($key + 2), $value->komprehensifS2->beritaAcara->no_ba);
                $sheet3->setCellValue('P' . ($key + 2), url('uploads/ba_sidang_tesis/' . $value->komprehensifS2->beritaAcara->file_ba));
            } else {
                $sheet3->setCellValue('M' . ($key + 2), '-');
                $sheet3->setCellValue('N' . ($key + 2), '-');
                $sheet3->setCellValue('O' . ($key + 2), '-');
                $sheet3->setCellValue('P' . ($key + 2), '-');
            }
            $sheet3->setCellValue('Q' . ($key + 2), $value->komprehensifS2->status_admin);
            $sheet3->setCellValue('R' . ($key + 2), $value->komprehensifS2->status_koor);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save("Bimbingan TESIS Angkatan{$request->ta_unduh}.xlsx");
        return response()->download(("Bimbingan TESIS Angkatan{$request->ta_unduh}.xlsx"))->deleteFileAfterSend(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        $seminarTa1 = ModelSeminarTaSatuS2::where('id_mahasiswa', $mahasiswa->id)->first();
        $seminarTa2 = ModelSeminarTaDuaS2::where('id_mahasiswa', $mahasiswa->id)->first();
        $sidangKompre = ModelKompreS2::where('id_mahasiswa', $mahasiswa->id)->first();
        $data = [
            'mahasiswa' => $mahasiswa,
            'seminarTa1' => $seminarTa1,
            'seminarTa2' => $seminarTa2,
            'sidangKompre' => $sidangKompre,
            'ba_ta1' => $seminarTa1 ? $seminarTa1->beritaAcara : null,
            'ba_ta2' => $seminarTa2 ? $seminarTa2->beritaAcara : null,
            'ba_kompre' => $sidangKompre ? $sidangKompre->beritaAcara : null,
            'prestasi' => $mahasiswa->prestasi,
            'aktivitas' => $mahasiswa->aktivitas,
        ];
        // return dd($data);
        return view('dosen.mahasiswa.bimbingan.kompreS2.show', $data);
    }
}
