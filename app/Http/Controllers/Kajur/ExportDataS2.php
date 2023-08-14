<?php

namespace App\Http\Controllers\Kajur;

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
        ];
        return view('jurusan.exportS2.index', $data);
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

        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->komprehensifS2->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->komprehensifS2->pembahasSatu->nama_dosen);
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
                $sheet->setCellValue('P' . ($key + 2), url('/uploads/ba_seminar_tesis_2/' . $value->taDuaS2->beritaAcara->file_ba));
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('sidang_tesis_' . $request->akt_sidang     . '.xlsx');
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

        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->taDuaS2->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->taDuaS2->pembahasSatu->nama_dosen);
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
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
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

        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->taSatuS2->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->taSatuS2->pembahasSatu->nama_dosen);
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
            } else {
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
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
        $sheet->setCellValue('G1', 'Mahasiswa');
        foreach ($aktivitas as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_aktivitas);
            $sheet->setCellValue('C' . ($key + 2), $value->peran);
            $sheet->setCellValue('D' . ($key + 2), $value->sks_konversi);
            $sheet->setCellValue('E' . ($key + 2), $value->tanggal);
            $sheet->setCellValue('F' . ($key + 2), url('/uploads/file_act_mhs/' . $value->file_aktivitas));
            $sheet->setCellValue('G' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
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
        foreach ($prestasi as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_prestasi);
            $sheet->setCellValue('C' . ($key + 2), $value->scala);
            $sheet->setCellValue('D' . ($key + 2), $value->capaian);
            $sheet->setCellValue('E' . ($key + 2), $value->tanggal);
            $sheet->setCellValue('F' . ($key + 2), url('/uploads/file_prestasi/' . $value->file_prestasi));
            $sheet->setCellValue('G' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('prestasi_s2_' . $request->tahun_prestasi . '.xlsx');
        return response()->download('prestasi_s2_' . $request->tahun_prestasi . '.xlsx')->deleteFileAfterSend(true);
    }
}
