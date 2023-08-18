<?php

namespace App\Http\Controllers\Kajur;


use App\Models\AktivitasAlumni;
use App\Models\Laboratorium;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\ModelKompreS2;
use App\Models\ModelSeminarTaDuaS2;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class DataMahasiswaAllS2Controller extends Controller
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

            $tesis1 = $request->input('tesis1');
            $tesis2 = $request->input('tesis2');
            $tesis3 = $request->input('tesis3');
            $angkatan = $request->input('angkatan');

            $data = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswaS2');
            })
                ->with('mahasiswa', 'mahasiswa.taSatuS2', 'mahasiswa.taDuaS2', 'mahasiswa.komprehensifS2')
                ->select('users.*');

            if ($tesis1 != 'null' && $tesis1 != '1') {
                $data = $data->whereHas('mahasiswa.taSatuS2', function ($query) use ($tesis1) {
                    $query->where('status_koor', $tesis1);
                });
            } elseif ($tesis1 == 'null') {
                $data = $data->whereDoesntHave('mahasiswa.taSatuS2');
            }

            if ($tesis2 != 'null' && $tesis2 != '1') {
                $data = $data->whereHas('mahasiswa.taDuaS2', function ($query) use ($tesis2) {
                    $query->where('status_koor', $tesis2);
                });
            } elseif ($tesis2 == 'null') {
                $data = $data->whereDoesntHave('mahasiswa.taDuaS2');
            }

            if ($tesis3 != 'null' && $tesis3 != '1') {
                $data = $data->whereHas('mahasiswa.komprehensifS2', function ($query) use ($tesis3) {
                    $query->where('status_koor', $tesis3);
                });
            } elseif ($tesis3 == 'null') {
                $data = $data->whereDoesntHave('mahasiswa.komprehensifS2');
            }
            if ($angkatan != 'null' && $angkatan != '1') {
                $data = $data->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->where('angkatan', $angkatan);
                });
            }



            return DataTables::of($data)
                ->addIndexColumn()->editColumn('mahasiswa.taSatuS2.status_koor', function ($data) {
                    return $data->mahasiswa->taSatuS2->status_koor ?? 'Belum Daftar';
                })
                ->addIndexColumn()->editColumn('mahasiswa.taDuaS2.status_koor', function ($data) {
                    return $data->mahasiswa->taDuaS2->status_koor ?? 'Belum Daftar';
                })
                ->addIndexColumn()->editColumn('mahasiswa.komprehensifS2.status_koor', function ($data) {
                    return  $data->mahasiswa->komprehensifS2->status_koor ?? 'Belum Daftar';
                })
                ->toJson();
        }
        $mahasiswa = [

            'mahasiswa' => Mahasiswa::select('angkatan')->distinct()->where('status', 'Aktif')->whereHas('user', function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', 'mahasiswaS2');
                });
            })->orderBy('angkatan', 'desc')
                ->get(),

        ];
        return view('jurusan.data_mahasiswa_s2.index', $mahasiswa);
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
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        $seminarTa1 = ModelSeminarTaSatuS2::where('id_mahasiswa', $mahasiswa->id)->first();
        $seminarTa2 = ModelSeminarTaDuaS2::where('id_mahasiswa', $mahasiswa->id)->first();
        $sidangKompre = ModelKompreS2::where('id_mahasiswa', $mahasiswa->id)->first();
        $data = [
            'mahasiswa' => $mahasiswa,
            'seminarTa1' => $seminarTa1,
            'seminarTa2' => $seminarTa2,
            'sidangKompre' => $sidangKompre,
            'ba_ta1' => $seminarTa1 ? $seminarTa1->beritaAcara : null,
            'ba_ta2' => $seminarTa2 ? $seminarTa2->beritaAcara : null,
            'ba_kompre' => $sidangKompre ? $sidangKompre->beritaAcara : null,
            'prestasi' => $mahasiswa->prestasi,
            'aktivitas' => $mahasiswa->aktivitas,
        ];
        // return dd($data);
        return view('dosen.mahasiswa.bimbingan.kompreS2.show', $data);
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
