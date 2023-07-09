<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PrestasiMahasiswa;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileMahasiswa;
use App\Http\Requests\UpdateProfileMahasiswaRequest;
use App\Models\AktivitasMahasiswa;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProfileMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'prestasi' => PrestasiMahasiswa::where('mahasiswa_id', Auth::user()->mahasiswa->id)->get(),
            'aktivitas' => AktivitasMahasiswa::where('mahasiswa_id', Auth::user()->mahasiswa->id)->get(),
        ];
        return view('mahasiswa.profile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->mahasiswa->tanggal_masuk != null){
            return redirect()->back();
        }
        $data = [
            'dosen' => Dosen::select('encrypt_id', "nama_dosen")->get(),
        ];
        return view('mahasiswa.profile.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileMahasiswa $request)
    {
        $foto_profile = $request->file('foto_profile');
        $nama_foto = $foto_profile->hashName();
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->no_hp = $request->hp;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->tanggal_masuk = $request->tanggal_masuk;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->semester = $request->semester;
        $mahasiswa->save();
        $user = User::find(Auth::user()->id);
        $user->profile_picture = $nama_foto;
        $user->save();
        $foto_profile->move('uploads/profile', $nama_foto);
        return redirect()->route('dashboard')->with('success', 'Profile Berhasil Diperbarui');

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
    public function edit($npm)
    {

        if(Auth::user()->mahasiswa->npm != $npm){
            return redirect()->back();
        }
        $data = [
            'dosens' => Dosen::select('encrypt_id', "nama_dosen")->get(),
            'mahasiswa' => Mahasiswa::where('npm', $npm)->first(),
        ];

        return view('mahasiswa.profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileMahasiswaRequest $request, $id)
    {
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        if(Auth::user()->id != $mahasiswa->user_id){
            return redirect()->back();
        }
        if($request->file('foto_profile') != null){
            $foto_profile = $request->file('foto_profile');
            $nama_foto = $foto_profile->hashName();
            $foto_profile->move('uploads/profile', $nama_foto);
            $user = User::find($mahasiswa->user_id);
            $user->profile_picture = $nama_foto;
            $user->save();
        }
        $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->jenis_kelamin = $request->gender;
        $mahasiswa->tanggal_masuk = $request->tanggal_masuk;
        $mahasiswa->angkatan = $request->angkatan;
        $mahasiswa->semester = $request->semester;
        $mahasiswa->id_dosen = Crypt::decrypt($request->id_dosen);
        $mahasiswa->updated_at = date('Y-m-d H:i:s');
        $mahasiswa->save();
        return redirect()->route('mahasiswa.profile.index')->with('success', 'Profile Berhasil Diperbarui');
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
        return redirect()->back();
    }
}
