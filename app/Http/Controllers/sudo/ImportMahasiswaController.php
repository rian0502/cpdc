<?php

namespace App\Http\Controllers\sudo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ImportMahasiswaS1Job;
use App\Models\BaseNPM;
use App\Models\Mahasiswa;
use App\Models\User;
use Faker\Provider\Base;
use Illuminate\Support\Facades\DB;
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
        dispatch(new ImportMahasiswaS1Job($sheet1, $sheet2, $sheet3, $sheet4, $sheet5));
        return dd($sheet1);
        
    }
}
