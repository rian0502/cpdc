<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBaTaSatuRequest;
use App\Http\Requests\UpdateBaTaSatuRequest;
use App\Models\ModelBaSeminarTaSatu;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\AktivitasAlumni;
use App\Models\ModelSeminarTaDua;
use App\Models\ModelSeminarKompre;
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
        if($mahasiswa->ta_satu()->exists()){
            $ta_satu = $mahasiswa->ta_satu()->first();
            $ta_satu->delete();
        }
        if ($mahasiswa->ta_dua()->exists()) {
            $ta_dua = $mahasiswa->ta_dua()->first();
            $ta_dua->delete();
        }
        if ($mahasiswa->komprehensif()->exists()) {
            $seminar_kompre = $mahasiswa->seminar_kompre()->first();
            $seminar_kompre->delete();
        }
        return redirect()->route('sudo.reset.seminar.index')->with('success', 'Data berhasil dihapus');
    }
}