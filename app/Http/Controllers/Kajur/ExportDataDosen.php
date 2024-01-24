<?php

namespace App\Http\Controllers\Kajur;

use App\Models\ModelSPDosen;
use Illuminate\Http\Request;
use App\Models\LitabmasDosen;
use App\Models\PublikasiDosen;
use App\Http\Controllers\Controller;
use App\Models\ModelKinerjaDosen;
use App\Models\ModelPenghargaanDosen;
use KinerjaDosen;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportDataDosen extends Controller
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
            'publikasi' => PublikasiDosen::select('tahun')
                ->distinct()->orderBy('tahun', 'desc')
                ->get(),
            'seminar_dosen' => ModelSPDosen::selectRaw('YEAR(tanggal) as tahun')
                ->distinct()->orderBy('tahun', 'desc')
                ->get(),
            'penghargaan_dosen' => ModelPenghargaanDosen::selectRaw('YEAR(tanggal) as tahun')
                ->distinct()->orderBy('tahun', 'desc')
                ->get(),
            'kinerja_dosen' => ModelKinerjaDosen::select('tahun_akademik')->distinct()
                ->orderBy('tahun_akademik', 'desc')->get(),
        ];
        return view('jurusan.exportDosen.index', $data);
    }

    public function kinerja_dosen(Request $request)
    {
        $request->validate([
            'tahun_akademik' => 'required',
            'semester' => 'required',
        ]);
        $kinerja_dosen = ModelKinerjaDosen::with('dosen')->where(
            'tahun_akademik',
            $request->tahun_akademik
        )->where(
            'semester',
            $request->semester
        )
            ->orderBy('created_at', 'asc')
            ->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Kinerja Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIP');
        $sheet->setCellValue('C1', 'NIDN');
        $sheet->setCellValue('D1', 'Nama Dosen');
        $sheet->setCellValue('E1', 'Jenis Kinerja');
        $sheet->setCellValue('F1', 'SKS Pendidikan');
        $sheet->setCellValue('G1', 'SKS Penelitian');
        $sheet->setCellValue('H1', 'SKS Pengabdian');
        $sheet->setCellValue('I1', 'SKS Penunjang');
        $sheet->setCellValue('J1', 'Total SKS');
        $sheet->setCellValue('K1', 'Tahun Akademik');
        $sheet->setCellValue('L1', 'Semester');

        foreach ($kinerja_dosen as $key => $value) {
            $total_sks = $value->sks_pendidikan + $value->sks_penelitian
                + $value->sks_pengabdian + $value->sks_penunjang;
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->dosen->nip);
            $sheet->setCellValue('C' . ($key + 2), $value->dosen->nidn);
            $sheet->setCellValue('D' . ($key + 2), $value->dosen->nama_dosen);
            $sheet->setCellValue('E' . ($key + 2), $value->kategori);
            $sheet->setCellValue('F' . ($key + 2), $value->sks_pendidikan);
            $sheet->setCellValue('G' . ($key + 2), $value->sks_penelitian);
            $sheet->setCellValue('H' . ($key + 2), $value->sks_pengabdian);
            $sheet->setCellValue('I' . ($key + 2), $value->sks_penunjang);
            $sheet->setCellValue('J' . ($key + 2), $total_sks);
            $sheet->setCellValue('K' . ($key + 2), $value->tahun_akademik);
            $sheet->setCellValue('L' . ($key + 2), $value->semester);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('kinerja_dosen'.'.xlsx');
        return response()->download('kinerja_dosen'.'.xlsx')
            ->deleteFileAfterSend(true);
    }
    public function seminar(Request $request)
    {
        $seminar = ModelSPDosen::with('dosen')
            ->whereYear('tanggal', $request->tahun_seminar)->get();
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
            $sheet->setCellValue('D' . ($key + 2), $value->tanggal);
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
        $penghargaan = ModelPenghargaanDosen::with('dosen')
            ->whereYear('tanggal', $request->tahun_penghargaan)->get();
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
        $sheet->setCellValue('H1', 'kategori');
        foreach ($penghargaan as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->dosen->nama_dosen);
            $sheet->setCellValue('C' . ($key + 2), $value->nama);
            $sheet->setCellValue('D' . ($key + 2), $value->tanggal);
            $sheet->setCellValue('E' . ($key + 2), $value->scala);
            $sheet->setCellValue('F' . ($key + 2), $value->uraian);
            $sheet->setCellValue('G' . ($key + 2), $value->url);
            $sheet->setCellValue('H' . ($key + 2), $value->kategori);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('penghargaan_dosen-' . $request->tahun_penghargaan . '.xlsx');
        return response()->download('penghargaan_dosen-' . $request->tahun_penghargaan . '.xlsx')->deleteFileAfterSend(true);
    }



    public function penelitian(Request $request)
    {
        $penelitian = LitabmasDosen::with('anggota_litabmas')->where(
            'tahun_penelitian',
            $request->tahun_penelitian
        )->where('kategori', 'Penelitian')->get();
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
        $penelitian = LitabmasDosen::with('anggota_litabmas')->where(
            'tahun_penelitian',
            $request->tahun_pengabdian
        )->where('kategori', 'Pengabdian')->get();
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
        $publikasi = PublikasiDosen::with('anggotaPublikasi')->where(
            'tahun',
            $request->tahun_publikasi
        )->get();
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
