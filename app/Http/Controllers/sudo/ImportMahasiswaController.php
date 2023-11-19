<?php

namespace App\Http\Controllers\sudo;

use App\Models\User;

use App\Models\BaSKP;
use App\Models\JadwalSKP;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ModelBaSeminarTaSatu;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaSatu;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class ImportMahasiswaController extends Controller
{
    //
    public function index()
    {
        return view('sudo.import.mahasiswa');
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
        dispatch(new \App\Jobs\ImportMahasiswaS1Job($sheet1, $sheet2, $sheet3, $sheet4, $sheet5));
        return dd($sheet1);
        
    }
}
