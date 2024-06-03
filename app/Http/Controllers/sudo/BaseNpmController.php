<?php

namespace App\Http\Controllers\sudo;

use App\Models\BaseNPM;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class BaseNpmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //



        return view('npm.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        foreach ($request->npm as $npm) {
            $validator = Validator::make(['npm' => $npm], [
                'npm' => 'required|unique:base_npm,npm',
            ]);
            if (!$validator->fails()) {
                $data = new BaseNPM();
                $data->npm = $npm;
                $data->save();
            }
        }
        return redirect()->route('sudo.base_npm.index')->with('success', 'Data Berhasil Diupload');
    }
    public function storeExcel(Request $request)
    {
        //

        $fileXl = $request->file('npm');
        $reader = new Xlsx();
        $spreadsheet = $reader->load($fileXl);
        $sheet = $spreadsheet->getActiveSheet()->toArray();
        //loop data
        foreach ($sheet as $key => $row) {
            if ($key == 0) {
                continue;
            }
            $validator = Validator::make(['npm' => $row[0]], [
                'npm' => 'required|unique:base_npm,npm',
            ]);
            if (!$validator->fails()) {
                $baseNPM = new BaseNPM();
                $baseNPM->npm = $row[0];
                $baseNPM->status = $row[1];
                $baseNPM->created_at = now();
                $baseNPM->updated_at = now();
                $baseNPM->save();
            }
        }
        return redirect()->route('sudo.base_npm.index')->with('success', 'Data Berhasil Diupload');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'item' => BaseNPM::where('id', $id)->first(),
        ];
        //
        return view('npm.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $data = [
            'npm' => $request->npm,
            'updated_at' => now()
        ];
        $update = BaseNPM::where('id', $id)->update($data);
        if ($update) {
            return redirect()->route('sudo.base_npm.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('sudo.base_npm.index')->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        BaseNPM::where('id', $id)->delete();
        return redirect()->route('sudo.base_npm.index')->with('success', 'Data berhasil dihapus');
    }
    public function BaseNpm(Request $request)
    {
        if ($request->ajax()) {
            $model = BaseNPM::query();
            return DataTables::of($model)->toJson();
        }
    }

    public function exportNpm(Request $request)
    {
        $baseNPM = BaseNpm::query()->orderBy('npm')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Data Npm');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Status');
        foreach ($baseNPM as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->status);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('Data_Npm_Keseluruhan'.'.xlsx');
        return response()->download('Data_Npm_Keseluruhan' . '.xlsx')->deleteFileAfterSend(true);
    }
}
