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
        $kajur = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'jurusan');
        })->first();
        return dd($kajur);
        //show data from excel
        $fileXl = $request->file('data_mahasiswa');
        $reader = new Xlsx();

        $spreadsheet = $reader->load($fileXl);
        $sheet1 = $spreadsheet->getSheet(0)->toArray();
        $sheet2 = $spreadsheet->getSheet(1)->toArray();
        $sheet3 = $spreadsheet->getSheet(2)->toArray();
        $sheet4 = $spreadsheet->getSheet(3)->toArray();

        
        
       
   
    }
}
