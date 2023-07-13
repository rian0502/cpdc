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

    public function destroy()
    {
        //

    }
}
