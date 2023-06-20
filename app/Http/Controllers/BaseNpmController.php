<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\BaseNpm;
use App\Models\PrestasiMahasiswa;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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
            $data = new BaseNpm();
            $data->npm = $npm;
            $data->save();
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
            $baseNPM = new BaseNpm();
            $baseNPM->npm = $row[0];
            $baseNPM->status = $row[1];
            $baseNPM->created_at = now();
            $baseNPM->updated_at = now();
            $baseNPM->save();
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
        //
        return view('npm.edit');
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
    }
    public function BaseNpm(Request $request)
    {
        if ($request->ajax()) {
            $data = BaseNpm::latest()->get();
            return DataTables::of($data)
                ->toJson();
        }
    }
}
