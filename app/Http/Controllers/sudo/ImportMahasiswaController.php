<?php

namespace App\Http\Controllers\sudo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class ImportMahasiswaController extends Controller
{
    //
    public function index(){
        return view('sudo.import.mahasiswa');
    }


    public function store(Request $request){

        //show data from excel
        $fileXl = $request->file('data_mahasiswa');
        $reader = new Xlsx();
        $spreadsheet = $reader->load($fileXl);
        $sheet = $spreadsheet->getActiveSheet()->toArray();
        $data = [];
        foreach ($sheet as $key => $value) {
            if ($key > 0) {
                $data[] = $value;
            }
        }
        return dd($data);
    }
}
