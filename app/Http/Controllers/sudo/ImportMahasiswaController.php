<?php

namespace App\Http\Controllers\sudo;

use App\Models\Dosen;
use App\Models\Lokasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class ImportMahasiswaController extends Controller
{
    //
    public function index()
    {
        return view('sudo.import.mahasiswa');
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
        $sheet2->setTitle('Seminar Kerja Praktik');
        $sheet2->setCellValue('A1', 'NPM');
        $sheet2->setCellValue('B1', 'Judul Seminar Kerja Praktik');
        $sheet2->setCellValue('C1', 'Semester');
        $sheet2->setCellValue('D1', 'Tahun Akademik');
        $sheet2->setCellValue('E1', 'Mitra');
        $sheet2->setCellValue('F1', 'Region');
        $sheet2->setCellValue('G1', 'Rencana Seminar');
        $sheet2->setCellValue('H1', 'Pembimbing Lapangan');
        $sheet2->setCellValue('I1', 'NIP Pembimbing Lapangan');
        $sheet2->setCellValue('J1', 'TOEFL');
        $sheet2->setCellValue('K1', 'SKS');
        $sheet2->setCellValue('L1', 'IPK');
        $sheet2->setCellValue('M1', 'Berkas Persyaratan');
        $sheet2->setCellValue('N1', 'Dosen Pembimbing');
        $sheet2->setCellValue('O1', 'Tanggal Seminar');
        $sheet2->setCellValue('P1', 'Jam Mulai');
        $sheet2->setCellValue('Q1', 'Jam Selesai');
        $sheet2->setCellValue('R1', 'Lokasi');
        $sheet2->setCellValue('S1', 'No. BA');
        $sheet2->setCellValue('T1', 'Nilai Lapangan');
        $sheet2->setCellValue('U1', 'Nilai Akademik');
        $sheet2->setCellValue('V1', 'Nilai Akhir');
        $sheet2->setCellValue('W1', 'Nilai Mutu');
        $sheet2->setCellValue('X1', 'Berkas BA');
        $sheet2->setCellValue('Y1', 'Laporan PKL');

        $sheet3 = $spdsheet->createSheet();
        $sheet3->setTitle('Seminar Tugas Akhir 1');
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
        $sheet3->setCellValue('N1', 'Pembahas');
        $sheet3->setCellValue('O1', 'Tanggal');
        $sheet3->setCellValue('P1', 'Jam Mulai');
        $sheet3->setCellValue('Q1', 'Jam Selesai');
        $sheet3->setCellValue('R1', 'Lokasi');
        $sheet3->setCellValue('S1', 'No. BA');
        $sheet3->setCellValue('T1', 'Berkas Berita Acara');
        $sheet3->setCellValue('U1', 'Berkas Nilai');
        $sheet3->setCellValue('V1', 'Berkas PPT');
        $sheet3->setCellValue('W1', 'Nilai');
        $sheet3->setCellValue('X1', 'Huruf Mutu');

        $sheet4 = $spdsheet->createSheet();
        $sheet4->setTitle('Seminar Tugas Akhir 2');
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
        $sheet4->setCellValue('N1', 'Pembahas');
        $sheet4->setCellValue('O1', 'Tanggal');
        $sheet4->setCellValue('P1', 'Jam Mulai');
        $sheet4->setCellValue('Q1', 'Jam Selesai');
        $sheet4->setCellValue('R1', 'Lokasi');
        $sheet4->setCellValue('S1', 'No. BA');
        $sheet4->setCellValue('T1', 'Berkas Berita Acara');
        $sheet4->setCellValue('U1', 'Berkas Nilai');
        $sheet4->setCellValue('V1', 'Berkas PPT');
        $sheet4->setCellValue('W1', 'Nilai');
        $sheet4->setCellValue('X1', 'Huruf Mutu');

        $sheet5 = $spdsheet->createSheet();
        $sheet5->setTitle('Seminar Komprehensif');
        $sheet5->setCellValue('A1', 'NPM');
        $sheet5->setCellValue('B1', 'Tahun Akademik');
        $sheet5->setCellValue('C1', 'Semester');
        $sheet5->setCellValue('D1', 'Periode Seminar');
        $sheet5->setCellValue('E1', 'Judul Tugas Akhir');
        $sheet5->setCellValue('F1', 'SKS');
        $sheet5->setCellValue('G1', 'IPK');
        $sheet5->setCellValue('H1', 'TOEFL');
        $sheet5->setCellValue('I1', 'Berkas Persyaratan');
        $sheet5->setCellValue('J1', 'Dosen Pembimbing 1');
        $sheet5->setCellValue('K1', 'Dosen Pembimbing 2');
        $sheet5->setCellValue('L1', 'Dosen Pembimbing External');
        $sheet5->setCellValue('M1', 'NIP Dosen Pembimbing External');
        $sheet5->setCellValue('N1', 'Pembahas');
        $sheet5->setCellValue('O1', 'Tanggal');
        $sheet5->setCellValue('P1', 'Jam Mulai');
        $sheet5->setCellValue('Q1', 'Jam Selesai');
        $sheet5->setCellValue('R1', 'Lokasi');
        $sheet5->setCellValue('S1', 'Berkas Berita Acara');
        $sheet5->setCellValue('T1', 'No. BA');
        $sheet5->setCellValue('U1', 'Berkas Nilai');
        $sheet5->setCellValue('V1', 'Laporan TA');
        $sheet5->setCellValue('W1', 'Nilai');
        $sheet5->setCellValue('X1', 'Huruf Mutu');

        $sheet6 = $spdsheet->createSheet();
        $sheet6->setTitle('Dosen');
        $sheet6->setCellValue('A1', 'ID');
        $sheet6->setCellValue('B1', 'Nama Dosen');
        foreach ($dosen as $key => $value) {
            $sheet6->setCellValue('A' . ($key + 2), $value->id);
            $sheet6->setCellValue('B' . ($key + 2), $value->nama_dosen);
        }

        $sheet7 = $spdsheet->createSheet();
        $sheet7->setTitle('Lokasi');
        $sheet7->setCellValue('A1', 'ID');
        $sheet7->setCellValue('B1', 'Nama Lokasi');
        foreach ($lokasi as $key => $value) {
            $sheet7->setCellValue('A' . ($key + 2), $value->id);
            $sheet7->setCellValue('B' . ($key + 2), $value->nama_lokasi);
        }
        $writer = IOFactory::createWriter($spdsheet, 'Xlsx');
        $writer->save('template_import.xlsx');
        return response()->download('template_import.xlsx')->deleteFileAfterSend(true);
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
        $sheet5 = $spreadsheet->getSheet(4)->toArray();
        return dd(count($sheet1), count($sheet2), count($sheet3), count($sheet4), count($sheet5));
        dispatch(new \App\Jobs\ImportMahasiswaS1Job($sheet1, $sheet2, $sheet3, $sheet4, $sheet5));
        return dd($sheet1);
    }
}
