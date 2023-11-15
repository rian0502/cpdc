<?php

namespace App\Http\Controllers\sudo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        
        try {
            foreach ($sheet1 as $key => $value) {
                if ($key > 0) {
                    DB::transaction(function () use ($value) {
                        BaseNPM::create([
                            'npm' => $value[0],
                            'status' => 'aktif',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $user = User::create([
                            'name' => $value[1],
                            'email' => $value[2],
                            'password' => bcrypt($value[0]),
                            'email_verified_at' => now(),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        $user->assignRole(['mahasiswa', 'alumni']);
                        Mahasiswa::create([
                            'npm' => $value[0],
                            'nama_mahasiswa' => $value[1],
                            'tanggal_lahir' => $value[4],
                            'angkatan' => $value[5],
                            'tanggal_masuk' => $value[3],
                            'jenis_kelamin' => $value[6],
                            'semester' => '1',
                            'status' => 'Alumni',
                            'user_id' => $user->id,
                            'id_dosen' => $value[7],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    });
                }
            }
            return redirect()->route('sudo.import.mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Diimport');
        } catch (\Throwable $th) {
            //throw $th;
            return dd($th->getMessage());
        }
   
    }
}
