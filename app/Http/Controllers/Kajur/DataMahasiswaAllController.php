<?php

namespace App\Http\Controllers\Kajur;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\AktivitasAlumni;
use App\Models\ModelSeminarTaDua;
use App\Models\ModelSeminarTaSatu;
use App\Models\ModelSeminarKompre;
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

            $status_kp = $request->input('status_kp');
            $status_ta1 = $request->input('status_ta1');
            $status_ta2 = $request->input('status_ta2');
            $status_kompre = $request->input('status_kompre');
            $angkatan = $request->input('angkatan');

            $data = User::whereHas('roles', function ($query) {
                $query->where('name', 'mahasiswa');
            })
                ->with(
                    'mahasiswa',
                    'mahasiswa.seminar_kp',
                    'mahasiswa.ta_satu',
                    'mahasiswa.ta_dua',
                    'mahasiswa.komprehensif'
                )
                ->select('users.*');

            if ($status_kp != 'null' && $status_kp != '1') {
                $data = $data->whereHas('mahasiswa.seminar_kp', function ($query) use ($status_kp) {
                    $query->where('status_seminar', $status_kp);
                });
            } elseif ($status_kp == 'null') {
                $data = $data->whereDoesntHave('mahasiswa.seminar_kp');
            }

            if ($status_ta1 != 'null' && $status_ta1 != '1') {
                $data = $data->whereHas('mahasiswa.ta_satu', function ($query) use ($status_ta1) {
                    $query->where('status_koor', $status_ta1);
                });
            } elseif ($status_ta1 == 'null') {
                $data = $data->whereDoesntHave('mahasiswa.ta_satu');
            }

            if ($status_ta2 != 'null' && $status_ta2 != '1') {
                $data = $data->whereHas('mahasiswa.ta_dua', function ($query) use ($status_ta2) {
                    $query->where('status_koor', $status_ta2);
                });
            } elseif ($status_ta2 == 'null') {
                $data = $data->whereDoesntHave('mahasiswa.ta_dua');
            }

            if ($status_kompre != 'null' && $status_kompre != '1') {
                $data = $data->whereHas('mahasiswa.komprehensif', function ($query) use ($status_kompre) {
                    $query->where('status_koor', $status_kompre);
                });
            } elseif ($status_kompre == 'null') {
                $data = $data->whereDoesntHave('mahasiswa.komprehensif');
            }
            if ($angkatan != 'null' && $angkatan != '1') {
                $data = $data->whereHas('mahasiswa', function ($query) use ($angkatan) {
                    $query->where('angkatan', $angkatan);
                });
            }
            return DataTables::of($data)
                ->addIndexColumn()->editColumn('mahasiswa.seminar_kp.status_seminar', function ($data) {
                    return $data->mahasiswa->seminar_kp->status_seminar ?? 'Belum Daftar';
                })
                ->addIndexColumn()->editColumn('mahasiswa.ta_satu.status_koor', function ($data) {
                    return $data->mahasiswa->ta_satu->status_koor ?? 'Belum Daftar';
                })
                ->addIndexColumn()->editColumn('mahasiswa.ta_dua.status_koor', function ($data) {
                    return $data->mahasiswa->ta_dua->status_koor ?? 'Belum Daftar';
                })
                ->addIndexColumn()->editColumn('mahasiswa.komprehensif.status_koor', function ($data) {
                    return  $data->mahasiswa->komprehensif->status_koor ?? 'Belum Daftar';
                })
                ->toJson();
        }
        $mahasiswa = [

            'mahasiswa' => Mahasiswa::select('angkatan')->distinct()
                ->where('status', 'Aktif')->whereHas('user', function ($query) {
                    $query->whereHas('roles', function ($query) {
                        $query->where('name', 'mahasiswa');
                    });
                })->orderBy('angkatan', 'desc')
                ->get(),

        ];
        return view('jurusan.data_mahasiswa.index', $mahasiswa);
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
        $seminarTa1 = ModelSeminarTaSatu::where('id_mahasiswa', $mahasiswa->id)->first();
        $seminarTa2 = ModelSeminarTaDua::where('id_mahasiswa', $mahasiswa->id)->first();
        $sidangKompre = ModelSeminarKompre::where('id_mahasiswa', $mahasiswa->id)->first();
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
            $data['alumni'] = AktivitasAlumni::where(
                'mahasiswa_id',
                $mahasiswa->id
            )->orderBy('tahun_masuk', 'desc')->get();
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
