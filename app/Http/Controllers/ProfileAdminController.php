<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Administrasi;
use App\Models\HistoryPangkatAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreProfileAdminRequest;
use App\Http\Requests\UpdateProfileAdminRequest;

class ProfileAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Auth::user()->administrasi;
        $tgl_lahir = Carbon::createFromFormat('Y-m-d', $profile->tanggal_lahir);
        $now = Carbon::now();
        $umur = $tgl_lahir->diffInYears($now);
        $data = [
            "pangkat" => HistoryPangkatAdmin::where(["administrasi_id" => $profile->id])->orderBy("tgl_sk", "DESC")->get(),
            "profile" => $profile,
            "umur" => $umur,
        ];

        return view('admin.profile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->administrasi != null) {
            return redirect()->back();
        }
        return view('admin.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileAdminRequest $request)
    {
        $data_admin = [
            "nip" => $request->nip,
            "nama_administrasi" => $request->nama_administrasi,
            "no_hp" => $request->no_hp,
            "tanggal_lahir" => $request->tanggal_lahir,
            "tempat_lahir" => $request->tempat_lahir,
            "alamat" => $request->alamat,
            "jenis_kelamin" => $request->gender,
            "status" => "Aktif",
            "user_id" => Auth::user()->id,
        ];
        $insertProfile = Administrasi::create($data_admin);
        $id_insert = $insertProfile->id;
        $update = Administrasi::where('id', $id_insert)->update(['encrypt_id' => Crypt::encrypt($id_insert)]);
        $file_sk = $request->file('file_sk');
        $nama_file = Str::random() . $file_sk->getClientOriginalName();
        $file_sk->move('uploads/sk_pangkat_admin', $nama_file);
        $pangkat = [
            "pangkat" => $request->kepangkatan,
            "tgl_sk" => $request->tanggal_sk,
            "file_sk" => $nama_file,
            "administrasi_id" => $id_insert,
        ];
        $insertPangkat = HistoryPangkatAdmin::create($pangkat);
        $id_inser = $insertPangkat->id;
        $update = HistoryPangkatAdmin::where('id', $id_inser)->update(['encrypt_id' => Crypt::encrypt($id_inser)]);
        return redirect()->route('admin.profile.index')->with('success', 'Data berhasil ditambahkan');
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
    public function edit($id)
    {
        $admin = Administrasi::find(Crypt::decrypt($id));
        return view("admin.profile.edit", compact("admin"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileAdminRequest $request, $id)
    {
        if (Auth::user()->administrasi->id != Crypt::decrypt($id)) {
            return redirect()->route('admin.profile.index')->with('error', 'Anda tidak memiliki akses');
        }
        $administrasi = Administrasi::find(Crypt::decrypt($id));
        if ($request->file('foto_profile') != null) {
            $profile = $request->file('foto_profile');
            $nama_file = $profile->hashName();
            $administrasi->nama_administrasi = $request->nama_admin;
            $administrasi->nip = $request->nip;
            $administrasi->no_hp = $request->no_hp;
            $administrasi->tanggal_lahir = $request->tanggal_lahir;
            $administrasi->tempat_lahir = $request->tempat_lahir;
            $administrasi->alamat = $request->alamat;
            $administrasi->jenis_kelamin = $request->gender;
            $administrasi->updated_at = date("Y-m-d H:i:s");
            $administrasi->save();
            $user = User::find(Auth::user()->id);
            $user->profile_picture = $nama_file;
            $user->save();
            $profile->move('uploads/profile', $nama_file);
        } else {
            $administrasi->nama_administrasi = $request->nama_admin;
            $administrasi->nip = $request->nip;
            $administrasi->no_hp = $request->no_hp;
            $administrasi->tanggal_lahir = $request->tanggal_lahir;
            $administrasi->tempat_lahir = $request->tempat_lahir;
            $administrasi->alamat = $request->alamat;
            $administrasi->jenis_kelamin = $request->gender;
            $administrasi->updated_at = date("Y-m-d H:i:s");
            $administrasi->save();
        }
        return redirect()->route('admin.profile.index')->with('success', 'Data berhasil diubah');
    }
}
