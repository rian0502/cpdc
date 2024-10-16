<?php

namespace App\Http\Controllers\sudo;

use App\Models\AktivitasMahasiswa;
use App\Models\BaseNPM;
use App\Models\Mahasiswa;
use App\Models\PrestasiMahasiswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AkunMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unvalidasi()
    {
        return view('layouts.blank');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::role(['mahasiswa', 'mahasiswaS2']);
            return DataTables::of($data)
                ->addColumn(
                    'aktivasi',
                    function ($data) {
                        if($data->email_verified_at == null){
                            return "Belum Aktivasi";
                        }else{
                            return Carbon::parse($data->email_verified_at)->locale('id_ID')->isoFormat('D MMMM YYYY');
                        }
                    }
                )
                ->addColumn(
                    'profile',
                    function ($data) {
                        if ($data->mahasiswa != null) {
                            return "Sudah";
                        } else {
                            return "Belum";
                        }
                    }
                )
                ->toJson();
        }

        return view('akun.mahasiswa.index');
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
        $data = [
            'student' => Mahasiswa::find($id),
            'kegiatan' => AktivitasMahasiswa::where('mahasiswa_id', $id)->get(),
            'prestasi' => PrestasiMahasiswa::where('mahasiswa_id', $id)->get(),
        ];

        return view('akun.mahasiswa.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $data = [
            'student' => $user->mahasiswa,
            'account' => $user,
        ];
        return view('akun.mahasiswa.edit', $data);
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
        $mahasiswa = Mahasiswa::find($id);
        $account = User::find($mahasiswa->user_id);
        $mahasiswa->status = $request->status;
        $account->email = $request->email;
        if ($request->password != null) {
            $account->password = bcrypt($request->password);
        }
        $mahasiswa->save();
        $account->save();
        return redirect()->route('sudo.akun_mahasiswa.index')->with('success', 'Akun Mahasiswa Berhasil Diubah');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $user = User::with('mahasiswa')->find($id);
        $npm = BaseNPM::where('npm', $user->mahasiswa->npm)->first();
        $npm->status = 'nonaktif';
        $npm->save();
        $user->delete();
        DB::commit();

        return redirect()->route('sudo.akun_mahasiswa.index')->with('success', 'Akun Mahasiswa Berhasil Dihapus');
    }
}
