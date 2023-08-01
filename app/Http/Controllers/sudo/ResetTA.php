<?php

namespace App\Http\Controllers\sudo;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ResetTA extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ModelSeminarTaSatu::query()->with('mahasiswa');
            return DataTables::of($data)->toJson();
        }
        return view('sudo.reset_ta.index');
    }

    public function destroy($id)
    {
        //
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        if ($mahasiswa->ta_satu) {
            $ta_satu = $mahasiswa->ta_satu;
            $ta_satu->delete();
        }
        if ($mahasiswa->ta_dua) {
            $ta_dua = $mahasiswa->ta_dua;
            $ta_dua->delete();
        }
        if ($mahasiswa->komprehensif) {
            $seminar_kompre = $mahasiswa->komprehensif;
            $seminar_kompre->delete();
        }
        return redirect()->route('sudo.reset.seminar.index')->with('success', 'Data berhasil dihapus');
    }
}
