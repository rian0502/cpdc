<?php

namespace App\Http\Controllers;

use App\Models\AnggotaLitabmas;
use App\Models\AnggotaPublikasiDosen;
use App\Models\Dosen;
use App\Models\HistoryJabatanDosen;
use App\Models\HistoryPangkatDosen;
use App\Models\OrganisasiDosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AkunDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'lecturers' => Dosen::orderBy('tanggal_lahir', 'desc')->get(),
        ];
        return view('akun.dosen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('akun.dosen.create');

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
        $validation = [
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ];
        if ($validation){
            $user = new User();
            $user->email = $request->email;
            $user->email_verified_at = now();
            $user->name = $request->nama;
            $user->password = bcrypt($request->password);
            $user->save();
            $user->assignRole($request->role);
            return redirect()->route('sudo.akun_dosen.index')->with('success', 'Akun Dosen Berhasil Ditambahkan');
        }else{
            return redirect()->route('sudo.akun_dosen.index')->with('error', 'Akun Dosen Gagal Ditambahkan');
        }
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
            'lecturer' => Dosen::find(Crypt::decrypt($id)),
            'organisasi' => OrganisasiDosen::where('dosen_id', Crypt::decrypt($id))->orderBy('created_at', 'desc')->get(),
            'jabatan' => HistoryJabatanDosen::where('dosen_id', Crypt::decrypt($id))->orderBy('tgl_sk', 'desc')->get(),
            'pangkat' => HistoryPangkatDosen::where('dosen_id', Crypt::decrypt($id))->orderBy('tgl_sk', 'desc')->get(),
            'litabmas' => AnggotaLitabmas::where('dosen_id', Crypt::decrypt($id))->get(),
            'publikasi' => AnggotaPublikasiDosen::where('id_dosen', Crypt::decrypt($id))->get(),
        ];
        return view('akun.dosen.show', $data);
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
        $lecturer = Dosen::find($id);
        $account = User::find($lecturer->user_id);
        $data = [
            'lecturer' => $lecturer,
            'account' => $account,
        ];

        return view('akun.dosen.edit', $data);
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

        $dosen = Dosen::find($id);
        $user = User::find($dosen->user_id);
        $user->email = $request->email;
        $dosen->status = $request->status;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->syncRoles($request->role);
        $user->save();
        $dosen->save();
        return redirect()->route('sudo.akun_dosen.index')->with('success', 'Akun Dosen Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
