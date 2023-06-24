<?php

namespace App\Http\Controllers;

use App\Models\AktivitasMahasiswa;
use App\Models\Mahasiswa;
use App\Models\PrestasiMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AkunMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Mahasiswa::query();
            return DataTables::of($data)
                ->addColumn('email', function ($row) {
                    return $row->user->email;
                })
                ->toJson();

            // dd($data);
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
        $mahasiswa = Mahasiswa::find($id);
        $data = [
            'student' => $mahasiswa,
            'account' => User::where('id', $mahasiswa->user_id)->first(),
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
        return redirect()->route('sudo.akun_mahasiswa.index');
    }

}
