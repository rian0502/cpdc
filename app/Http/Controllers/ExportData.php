<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LitabmasDosen;
use App\Http\Controllers\Controller;
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
            'pengabdian' => LitabmasDosen::select('tahun_penelitian')->distinct()
            ->where('kategori', 'Pengabdian')
            ->get(),
            'penelitian' => LitabmasDosen::select('tahun_penelitian')->distinct()
            ->where('kategori', 'Penelitian')
            ->get(),
        ];
        return view('jurusan.export.index', $data);
    }

    public function penelitian(Request $request)
    {
        $penelitian = LitabmasDosen::with('anggota_litabmas')->
        where('tahun_penelitian', $request->tahun_penelitian)->
        where('kategori', 'Penelitian')->get();

        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Penelitian');
        $sheet->setCellValue('C1', 'Sumber Dana');
        $sheet->setCellValue('D1', 'Jumlah Dana');
        $sheet->setCellValue('E1', 'Tahun Penelitian');
        $sheet->setCellValue('F1', 'Anggota');

        foreach ($penelitian as $key => $value) {
            $sheet->setCellValue('A'.($key+2), $key+1);
            $sheet->setCellValue('B'.($key+2), $value->nama_litabmas);
            $sheet->setCellValue('C'.($key+2), $value->sumber_dana);
            $sheet->setCellValue('D'.($key+2), $value->jumlah_dana);
            $sheet->setCellValue('E'.($key+2), $value->tahun_penelitian);
            $sheet->setCellValue('F'.($key+2), $value->dosen->pluck('nama_dosen')->implode(', '));
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('penelitian.xlsx');
        return response()->download('penelitian.xlsx')->deleteFileAfterSend(true);
    }
    public function pengabdian(Request $request){
        $penelitian = LitabmasDosen::with('anggota_litabmas')->
        where('tahun_penelitian', $request->tahun_pengabdian)->
        where('kategori', 'Pengabdian')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Penelitian');
        $sheet->setCellValue('C1', 'Sumber Dana');
        $sheet->setCellValue('D1', 'Jumlah Dana');
        $sheet->setCellValue('E1', 'Tahun Penelitian');
        $sheet->setCellValue('F1', 'Anggota');
        foreach ($penelitian as $key => $value) {
            $sheet->setCellValue('A'.($key+2), $key+1);
            $sheet->setCellValue('B'.($key+2), $value->nama_litabmas);
            $sheet->setCellValue('C'.($key+2), $value->sumber_dana);
            $sheet->setCellValue('D'.($key+2), $value->jumlah_dana);
            $sheet->setCellValue('E'.($key+2), $value->tahun_penelitian);
            $sheet->setCellValue('F'.($key+2), $value->dosen->pluck('nama_dosen')->implode(', '));
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('pengabdian.xlsx');
        return response()->download('pengabdian.xlsx')->deleteFileAfterSend(true);
    }
}
