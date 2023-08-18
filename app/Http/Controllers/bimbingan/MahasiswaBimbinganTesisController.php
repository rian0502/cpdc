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
            $sheet->setCellValue('L' . ($key + 2), ($value->taSatuS2->jadwal != null) ? $value->taSatuS2->jadwal->tanggal_seminar_taSatuS2 : '-');
            if ($value->taSatuS2->beritaAcara) {
                $sheet->setCellValue('M' . ($key + 2), $value->taSatuS2->beritaAcara->nilai);
                $sheet->setCellValue('N' . ($key + 2), $value->taSatuS2->beritaAcara->huruf_mutu);
                $sheet->setCellValue('O' . ($key + 2), $value->taSatuS2->beritaAcara->no_berkas_beritaAcara_taSatuS2);
                $sheet->setCellValue('P' . ($key + 2), url('uploads/beritaAcara_taSatuS2/' . $value->taSatuS2->beritaAcara->berkas_beritaAcara_taSatuS2));
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

        foreach ($ta2 as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->taDuaS2->semester);
            $sheet->setCellValue('E' . ($key + 2), $value->taDuaS2->tahun_akademik);
            $sheet->setCellValue('F' . ($key + 2), $value->taDuaS2->judul_ta);
            $sheet->setCellValue('G' . ($key + 2), $value->taDuaS2->pembimbingSatu->nama_dosen);
            if ($value->taDuaS2->id_pembimbing_2 != null) {
                $sheet->setCellValue('H' . ($key + 2), $value->taDuaS2->pembimbingDua->nama_dosen);
            } else {
                $sheet->setCellValue('H' . ($key + 2), $value->taDuaS2->pbl2_nama);
            }
            if ($value->taDuaS2->id_pembahas_1 != null) {
                $sheet->setCellValue('I' . ($key + 2), $value->taDuaS2->pembahasSatu->nama_dosen);
            } else {
                $sheet->setCellValue('I' . ($key + 2), $value->taDuaS2->pembahas_external_1);
            }
            if ($value->taDuaS2->id_pembahas_2 != null) {
                $sheet->setCellValue('J' . ($key + 2), $value->taDuaS2->pembahasDua->nama_dosen);
            } else {
                $sheet->setCellValue('J' . ($key + 2), $value->taDuaS2->pembahas_external_2);
            }
            if ($value->taDuaS2->id_pembahas_3 != null) {
                $sheet->setCellValue('K' . ($key + 2), $value->taDuaS2->pembahasTiga->nama_dosen);
            } else {
                $sheet->setCellValue('K' . ($key + 2), $value->taDuaS2->pembahas_external_3);
            }
            $sheet->setCellValue('L' . ($key + 2), ($value->taDuaS2->jadwal != null) ? $value->taDuaS2->jadwal->tanggal_seminar_taDuaS2 : '-');
            if ($value->taDuaS2->beritaAcara) {
                $sheet->setCellValue('M' . ($key + 2), $value->taDuaS2->beritaAcara->nilai);
                $sheet->setCellValue('N' . ($key + 2), $value->taDuaS2->beritaAcara->huruf_mutu);
                $sheet->setCellValue('O' . ($key + 2), $value->taDuaS2->beritaAcara->no_berkas_beritaAcara_taDuaS2);
                $sheet->setCellValue('P' . ($key + 2), url('uploads/beritaAcara_taDuaS2/' . $value->taDuaS2->beritaAcara->berkas_beritaAcara_taDuaS2));
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
            }
            $sheet->setCellValue('Q' . ($key + 2), $value->taDuaS2->status_admin);
            $sheet->setCellValue('R' . ($key + 2), $value->taDuaS2->status_koor);
        }
        $sheet3 = $spreadsheet->createSheet();
        $sheet3->setTitle('Bimbingan Komprehensif S2');
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

        foreach ($kompre as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->taTigaS2->semester);
            $sheet->setCellValue('E' . ($key + 2), $value->taTigaS2->tahun_akademik);
            $sheet->setCellValue('F' . ($key + 2), $value->taTigaS2->judul_ta);
            $sheet->setCellValue('G' . ($key + 2), $value->taTigaS2->pembimbingSatu->nama_dosen);
            if ($value->taTigaS2->id_pembimbing_2 != null) {
                $sheet->setCellValue('H' . ($key + 2), $value->taTigaS2->pembimbingDua->nama_dosen);
            } else {
                $sheet->setCellValue('H' . ($key + 2), $value->taTigaS2->pbl2_nama);
            }
            if ($value->taTigaS2->id_pembahas_1 != null) {
                $sheet->setCellValue('I' . ($key + 2), $value->taTigaS2->pembahasSatu->nama_dosen);
            } else {
                $sheet->setCellValue('I' . ($key + 2), $value->taTigaS2->pembahas_external_1);
            }
            if ($value->taTigaS2->id_pembahas_2 != null) {
                $sheet->setCellValue('J' . ($key + 2), $value->taTigaS2->pembahasDua->nama_dosen);
            } else {
                $sheet->setCellValue('J' . ($key + 2), $value->taTigaS2->pembahas_external_2);
            }
            if ($value->taTigaS2->id_pembahas_3 != null) {
                $sheet->setCellValue('K' . ($key + 2), $value->taTigaS2->pembahasTiga->nama_dosen);
            } else {
                $sheet->setCellValue('K' . ($key + 2), $value->taTigaS2->pembahas_external_3);
            }
            $sheet->setCellValue('L' . ($key + 2), ($value->taTigaS2->jadwal != null) ? $value->taTigaS2->jadwal->tanggal_seminar_taTigaS2 : '-');
            if ($value->taTigaS2->beritaAcara) {
                $sheet->setCellValue('M' . ($key + 2), $value->taTigaS2->beritaAcara->nilai);
                $sheet->setCellValue('N' . ($key + 2), $value->taTigaS2->beritaAcara->huruf_mutu);
                $sheet->setCellValue('O' . ($key + 2), $value->taTigaS2->beritaAcara->no_berkas_beritaAcara_taTigaS2);
                $sheet->setCellValue('P' . ($key + 2), url('uploads/beritaAcara_taTigaS2/' . $value->taTigaS2->beritaAcara->berkas_beritaAcara_taTigaS2));
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
            }
            $sheet->setCellValue('Q' . ($key + 2), $value->taTigaS2->status_admin);
            $sheet->setCellValue('R' . ($key + 2), $value->taTigaS2->status_koor);
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
