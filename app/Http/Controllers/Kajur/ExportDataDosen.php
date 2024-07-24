<?php

namespace App\Http\Controllers\Kajur;

use KinerjaDosen;
use App\Models\ModelSPDosen;
use Illuminate\Http\Request;
use App\Models\LitabmasDosen;
use App\Models\PublikasiDosen;
use App\Models\OrganisasiDosen;
use App\Models\ModelKinerjaDosen;
use App\Http\Controllers\Controller;
use App\Models\ModelPenghargaanDosen;
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
    public function organisasi_dosen(Request $request)
    {
        // $request->validate([
        //     'tahun_akademik' => 'required',
        //     'semester' => 'required',
        // ]);
        $organisasi_dosen = OrganisasiDosen::with('dosen')->get();
        // dd($organisasi_dosen);
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Kinerja Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIP');
        $sheet->setCellValue('C1', 'NIDN');
        $sheet->setCellValue('D1', 'Nama Dosen');
        $sheet->setCellValue('E1', 'Tahun Menjabat');
        $sheet->setCellValue('F1', 'Tahun Berakhir');
        $sheet->setCellValue('G1', 'Jabatan');
        $sheet->setCellValue('H1', 'Organisasi');

        foreach ($organisasi_dosen as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->dosen->nip);
            $sheet->setCellValue('C' . ($key + 2), $value->dosen->nidn);
            $sheet->setCellValue('D' . ($key + 2), $value->dosen->nama_dosen);
            $sheet->setCellValue('E' . ($key + 2), $value->tahun_menjabat);
            $sheet->setCellValue('F' . ($key + 2), $value->tahun_berakhir);
            $sheet->setCellValue('G' . ($key + 2), $value->jabatan);
            $sheet->setCellValue('H' . ($key + 2), $value->nama_organisasi);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('organisasi_dosen'.'.xlsx');
        return response()->download('organisasi_dosen'.'.xlsx')
            ->deleteFileAfterSend(true);
    }
    public function seminar(Request $request)
    {
        if ($request->filled('start') && $request->filled('end')) {
            if ($request->end < $request->start) {
                return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }
            $seminar = ModelSPDosen::with(['dosen'])
                ->whereBetween('tanggal', [$request->start, $request->end])
                ->get();
        } else if ($request->filled('start')) {
            $seminar = ModelSPDosen::with(['dosen'])
                ->where('tanggal', '>=', $request->start)
                ->get();
        } else if ($request->filled('end')) {
            $seminar = ModelSPDosen::with(['dosen'])
                ->where('tanggal', '<=', $request->end)
                ->get();
        } else {
            $seminar = ModelSPDosen::with(['dosen'])
                ->get();

        }
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
        $writer->save('seminar_dosen-' . '.xlsx');
        return response()->download('seminar_dosen-' . '.xlsx')->deleteFileAfterSend(true);
    }

    public function penghargaan(Request $request)
    {
        if ($request->filled('start') && $request->filled('end')) {
            if ($request->end < $request->start) {
                return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }
            $penghargaan = ModelPenghargaanDosen::with(['dosen'])
                ->whereBetween('tanggal', [$request->start, $request->end])
                ->get();
        } else if ($request->filled('start')) {
            $penghargaan = ModelPenghargaanDosen::with(['dosen'])
                ->where('tanggal', '>=', $request->start)
                ->get();
        } else if ($request->filled('end')) {
            $penghargaan = ModelPenghargaanDosen::with(['dosen'])
                ->where('tanggal', '<=', $request->end)
                ->get();
        } else {
            $penghargaan = ModelPenghargaanDosen::with(['dosen'])
                ->get();

        }
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
        if ($request->filled('start') && $request->filled('end')) {
            if ($request->end < $request->start) {
                return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }
            $penelitian = LitabmasDosen::with(['anggota_litabmas'])
                ->whereBetween('tahun_penelitian', [$request->start, $request->end])
                ->where('kategori', 'penelitian')->get();
        } else if ($request->filled('start')) {
            $penelitian = LitabmasDosen::with(['anggota_litabmas'])
                ->where('tahun_penelitian', '>=', $request->start)
                ->where('kategori', 'penelitian')->get();
        } else if ($request->filled('end')) {
            $penelitian = LitabmasDosen::with(['anggota_litabmas'])
                ->where('tahun_penelitian', '<=', $request->end)
                ->where('kategori', 'penelitian')->get();
        } else {
            $penelitian = LitabmasDosen::with(['anggota_litabmas'])
                ->where('kategori', 'penelitian')->get();

        }
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
        if ($request->filled('start') && $request->filled('end')) {
            if ($request->end < $request->start) {
                return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }
            $penelitian = LitabmasDosen::with(['anggota_litabmas'])
                ->whereBetween('tahun_penelitian', [$request->start, $request->end])
                ->where('kategori', 'Pengabdian')->get();
        } else if ($request->filled('start')) {
            $penelitian = LitabmasDosen::with(['anggota_litabmas'])
                ->where('tahun_penelitian', '>=', $request->start)
                ->where('kategori', 'Pengabdian')->get();
        } else if ($request->filled('end')) {
            $penelitian = LitabmasDosen::with(['anggota_litabmas'])
                ->where('tahun_penelitian', '<=', $request->end)
                ->where('kategori', 'Pengabdian')->get();
        } else {
            $penelitian = LitabmasDosen::with(['anggota_litabmas'])
                ->where('kategori', 'Pengabdian')->get();

        }
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

        if ($request->filled('start') && $request->filled('end')) {
            if ($request->end < $request->start) {
                return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal');
            }
            $seminar = PublikasiDosen::with(['anggotaPublikasi'])
                ->whereBetween('tahun', [$request->start, $request->end])
                ->get();
        } else if ($request->filled('start')) {
            $seminar = PublikasiDosen::with(['anggotaPublikasi'])
                ->where('tahun', '>=', $request->start)
                ->get();
        } else if ($request->filled('end')) {
            $seminar = PublikasiDosen::with(['anggotaPublikasi'])
                ->where('tahun', '<=', $request->end)
                ->get();
        } else {
            $seminar = PublikasiDosen::with(['anggotaPublikasi'])
                ->get();

        }
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
        foreach ($seminar as $key => $value) {
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
