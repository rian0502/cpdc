<?php

namespace App\Http\Controllers\sudo;

use App\Models\Dosen;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ImportMahasiswaS2Controller extends Controller
{
    //
    public function index()
    {
        return view('sudo.import.mahasiswas2');
    }

    public function unduh()
    {
        $dosen = Dosen::select('id', 'nama_dosen')->where('status', 'Aktif')->get();
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('jenis_ruangan', 'Kelas')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Data Mahasiswa');
        $sheet->setCellValue('A1', 'NPM');
        $sheet->setCellValue('B1', 'Nama Mahasiswa');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'No. HP');
        $sheet->setCellValue('E1', 'Tanggal Masuk');
        $sheet->setCellValue('F1', 'Tanggal Lahir');
        $sheet->setCellValue('G1', 'Angkatan');
        $sheet->setCellValue('H1', 'Jenis Kelamin');
        $sheet->setCellValue('I1', 'Dosen');

        $sheet2 = $spdsheet->createSheet();
        $sheet2->setTitle('Seminar Tugas Akhir 1');
        $sheet2->setCellValue('A1', 'NPM');
        $sheet2->setCellValue('B1', 'Tahun Akademik');
        $sheet2->setCellValue('C1', 'Semester');
        $sheet2->setCellValue('D1', 'Periode Seminar');
        $sheet2->setCellValue('E1', 'Judul Tugas Akhir');
        $sheet2->setCellValue('F1', 'SKS');
        $sheet2->setCellValue('G1', 'IPK');
        $sheet2->setCellValue('H1', 'TOEFL');
        $sheet2->setCellValue('I1', 'Berkas Persyaratan');
        $sheet2->setCellValue('J1', 'Dosen Pembimbing 1');
        $sheet2->setCellValue('K1', 'Dosen Pembimbing 2');
        $sheet2->setCellValue('L1', 'Dosen Pembimbing External');
        $sheet2->setCellValue('M1', 'NIP Dosen Pembimbing External');
        $sheet2->setCellValue('N1', 'Pembahas 1');
        $sheet2->setCellValue('O1', 'Pembahas 2');
        $sheet2->setCellValue('P1', 'Pembahas 3');
        $sheet2->setCellValue('Q1', 'Pembahas External 1');
        $sheet2->setCellValue('R1', 'NI Pembahas External 1');
        $sheet2->setCellValue('S1', 'Pembahas External 2');
        $sheet2->setCellValue('T1', 'NI Pembahas External 2');
        $sheet2->setCellValue('U1', 'Pembahas External 3');
        $sheet2->setCellValue('V1', 'NI Pembahas External 3');
        $sheet2->setCellValue('W1', 'Tanggal');
        $sheet2->setCellValue('X1', 'Jam Mulai');
        $sheet2->setCellValue('Y1', 'Jam Selesai');
        $sheet2->setCellValue('Z1', 'Lokasi');
        $sheet2->setCellValue('AA1', 'No. BA');
        $sheet2->setCellValue('AB1', 'Nilai');
        $sheet2->setCellValue('AC1', 'Huruf Mutu');
        $sheet2->setCellValue('AD1', 'PPT');
        $sheet2->setCellValue('AE1', 'Berkas Berita Acara');
        $sheet2->setCellValue('AF1', 'Berkas Nilai');

        $sheet3 = $spdsheet->createSheet();
        $sheet3->setTitle('Seminar Tugas Akhir 2');
        $sheet3->setCellValue('A1', 'NPM');
        $sheet3->setCellValue('B1', 'Tahun Akademik');
        $sheet3->setCellValue('C1', 'Semester');
        $sheet3->setCellValue('D1', 'Periode Seminar');
        $sheet3->setCellValue('E1', 'Judul Tugas Akhir');
        $sheet3->setCellValue('F1', 'SKS');
        $sheet3->setCellValue('G1', 'IPK');
        $sheet3->setCellValue('H1', 'TOEFL');
        $sheet3->setCellValue('I1', 'Berkas Persyaratan');
        $sheet3->setCellValue('J1', 'Dosen Pembimbing 1');
        $sheet3->setCellValue('K1', 'Dosen Pembimbing 2');
        $sheet3->setCellValue('L1', 'Dosen Pembimbing External');
        $sheet3->setCellValue('M1', 'NIP Dosen Pembimbing External');
        $sheet3->setCellValue('N1', 'Pembahas 1');
        $sheet3->setCellValue('O1', 'Pembahas 2');
        $sheet3->setCellValue('P1', 'Pembahas 3');
        $sheet3->setCellValue('Q1', 'Pembahas External 1');
        $sheet3->setCellValue('R1', 'NI Pembahas External 1');
        $sheet3->setCellValue('S1', 'Pembahas External 2');
        $sheet3->setCellValue('T1', 'NI Pembahas External 2');
        $sheet3->setCellValue('U1', 'Pembahas External 3');
        $sheet3->setCellValue('V1', 'NI Pembahas External 3');
        $sheet3->setCellValue('W1', 'Tanggal');
        $sheet3->setCellValue('X1', 'Jam Mulai');
        $sheet3->setCellValue('Y1', 'Jam Selesai');
        $sheet3->setCellValue('Z1', 'Lokasi');
        $sheet3->setCellValue('AA1', 'No. BA');
        $sheet3->setCellValue('AB1', 'Nilai');
        $sheet3->setCellValue('AC1', 'Huruf Mutu');
        $sheet3->setCellValue('AD1', 'PPT');
        $sheet3->setCellValue('AE1', 'Berkas Berita Acara');
        $sheet3->setCellValue('AF1', 'Berkas Nilai');

        $sheet4 = $spdsheet->createSheet();
        $sheet4->setTitle('Seminar Komprehensif');
        $sheet4->setCellValue('A1', 'NPM');
        $sheet4->setCellValue('B1', 'Tahun Akademik');
        $sheet4->setCellValue('C1', 'Semester');
        $sheet4->setCellValue('D1', 'Periode Seminar');
        $sheet4->setCellValue('E1', 'Judul Tugas Akhir');
        $sheet4->setCellValue('F1', 'SKS');
        $sheet4->setCellValue('G1', 'IPK');
        $sheet4->setCellValue('H1', 'TOEFL');
        $sheet4->setCellValue('I1', 'Berkas Persyaratan');
        $sheet4->setCellValue('J1', 'Dosen Pembimbing 1');
        $sheet4->setCellValue('K1', 'Dosen Pembimbing 2');
        $sheet4->setCellValue('L1', 'Dosen Pembimbing External');
        $sheet4->setCellValue('M1', 'NIP Dosen Pembimbing External');
        $sheet4->setCellValue('N1', 'Pembahas 1');
        $sheet4->setCellValue('O1', 'Pembahas 2');
        $sheet4->setCellValue('P1', 'Pembahas 3');
        $sheet4->setCellValue('Q1', 'Pembahas External 1');
        $sheet4->setCellValue('R1', 'NI Pembahas External 1');
        $sheet4->setCellValue('S1', 'Pembahas External 2');
        $sheet4->setCellValue('T1', 'NI Pembahas External 2');
        $sheet4->setCellValue('U1', 'Pembahas External 3');
        $sheet4->setCellValue('V1', 'NI Pembahas External 3');
        $sheet4->setCellValue('W1', 'URL ARTIKEL');
        $sheet4->setCellValue('X1', 'Tanggal');
        $sheet4->setCellValue('Y1', 'Jam Mulai');
        $sheet4->setCellValue('Z1', 'Jam Selesai');
        $sheet4->setCellValue('AA1', 'Lokasi');
        $sheet4->setCellValue('AB1', 'No. BA');
        $sheet4->setCellValue('AC1', 'Nilai');
        $sheet4->setCellValue('AD1', 'Huruf Mutu');
        $sheet4->setCellValue('AE1', 'Pengesahan');
        $sheet4->setCellValue('AF1', 'Berkas Berita Acara');
        $sheet4->setCellValue('AG1', 'Berkas Nilai');
        
        $sheet5 = $spdsheet->createSheet();
        $sheet5->setTitle('Dosen');
        $sheet5->setCellValue('A1', 'ID');
        $sheet5->setCellValue('B1', 'Nama Dosen');
        foreach ($dosen as $key => $value) {
            $sheet5->setCellValue('A' . ($key + 2), $value->id);
            $sheet5->setCellValue('B' . ($key + 2), $value->nama_dosen);
        }

        $sheet6 = $spdsheet->createSheet();
        $sheet6->setTitle('Lokasi');
        $sheet6->setCellValue('A1', 'ID');
        $sheet6->setCellValue('B1', 'Nama Lokasi');
        foreach ($lokasi as $key => $value) {
            $sheet6->setCellValue('A' . ($key + 2), $value->id);
            $sheet6->setCellValue('B' . ($key + 2), $value->nama_lokasi);
        }
        $writer = IOFactory::createWriter($spdsheet, 'Xlsx');
        $writer->save('template_imports2.xlsx');
        return response()->download('template_imports2.xlsx')->deleteFileAfterSend(true);
    }

    public function store(Request $request)
    {
        //show data from excel
        $fileXl = $request->file('data_mahasiswa');
        $reader = new Xlsx();
        $spreadsheet = $reader->load($fileXl);
        $sheet1 = $spreadsheet->getSheet(0)->toArray();
        $sheet2 = $spreadsheet->getSheet(1)->toArray();
        $sheet3 = $spreadsheet->getSheet(2)->toArray();
        $sheet4 = $spreadsheet->getSheet(3)->toArray();

        return dd(count($sheet1), count($sheet2), count($sheet3), count($sheet4));
        dispatch(new \App\Jobs\ImportMahasiswaS2Job($sheet1, $sheet2, $sheet3, $sheet4));
        return dd($sheet1);
    }
}
