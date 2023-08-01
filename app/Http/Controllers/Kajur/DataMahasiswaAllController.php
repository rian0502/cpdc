<?php

namespace App\Http\Controllers\Kajur;


use App\Models\AktivitasAlumni;
use App\Models\Laboratorium;
use App\Models\Mahasiswa;
use App\Models\ModelSeminarKompre;
use App\Models\ModelSeminarTaDua;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class DataMahasiswaAllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Mahasiswa::query()->with(['seminar_kp', 'ta_satu', 'ta_dua', 'komprehensif'])->get();
            return DataTables::of($data)
                ->addColumn('kp', function ($data) {
                    return $data->seminar_kp->status_seminar ?? 'Belum Daftar';
                })
                ->addColumn('ta1', function ($data) {
                    return $data->ta_satu->status_koor ?? 'Belum Daftar';
                })
                ->addColumn('ta2', function ($data) {
                    return $data->ta_dua->status_koor ?? 'Belum Daftar';
                })
                ->addColumn('kompre', function ($data) {
                    return  $data->komprehensif->status_koor ?? 'Belum Daftar';
                })
                ->toJson();
        }
        return view('jurusan.data_mahasiswa.index');
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
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        $seminarTa1 = ModelSeminarTaSatu::where('id_mahasiswa', $mahasiswa->id)->get();
        $seminarTa2 = ModelSeminarTaDua::where('id_mahasiswa', $mahasiswa->id)->get();
        $sidangKompre = ModelSeminarKompre::where('id_mahasiswa', $mahasiswa->id)->get();
        $data = [
            'mahasiswa' => $mahasiswa,
            'kp' => $mahasiswa->seminar_kp,
            'ta1' => $mahasiswa->ta_satu,
            'prestasi' => $mahasiswa->prestasi,
            'aktivitas' => $mahasiswa->aktivitas,
            'seminarTa1' => $seminarTa1,
            'seminarTa2' => $seminarTa2,
            'sidangKompre' => $sidangKompre,
            'ba_ta1' => $seminarTa1 ? $seminarTa1->ba_seminar : null,
            'ba_ta2' => $seminarTa2 ? $seminarTa2->ba_seminar : null,
            'ba_kompre' => $sidangKompre ? $sidangKompre->beritaAcara : null,
            'presentsi' => Laboratorium::where('user_id', $mahasiswa->user->id)->get(),
        ];
        if ($mahasiswa->user->hasRole('alumni')) {
            $data['alumni'] = AktivitasAlumni::where('mahasiswa_id', $mahasiswa->id)->orderBy('tahun_masuk', 'desc')->get();
        }


        return view('jurusan.data_mahasiswa.show', $data);
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
}
