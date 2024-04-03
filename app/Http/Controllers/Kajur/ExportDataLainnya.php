<?php

namespace App\Http\Controllers\Kajur;

use App\Models\User;
use App\Models\Barang;
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

class ExportDataLainnya extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('jurusan.exportLainnya.index');
    }


    public function export_inventaris(Request $request){

        $inventarisList = Barang::with('modelBarang', 'lokasi', 'modelBarang.kategori')->get();

        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Inventaris');
        $sheet->setCellValue('A1', 'Nama Model');
        $sheet->setCellValue('B1', 'Merk');
        $sheet->setCellValue('C1', 'Kategori');
        $sheet->setCellValue('D1', 'Lokasi');
        $sheet->setCellValue('E1', 'Jumlah Akhir');
        $row = 2;
        foreach ($inventarisList as $item) {
            $sheet->setCellValue('A' . $row, $item->modelBarang->nama_model);
            $sheet->setCellValue('B' . $row, $item->modelBarang->merk);
            $sheet->setCellValue('C' . $row, $item->modelBarang->kategori->nama_kategori);
            $sheet->setCellValue('D' . $row, $item->lokasi->nama_lokasi);
            $sheet->setCellValue('E' . $row, $item->jumlah_akhir); // Menulis nilai Jumlah Akhir
            $row++;
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('inventaris'.'.xlsx');
        return response()->download('inventaris'.'.xlsx')->deleteFileAfterSend(true);
    }
}
