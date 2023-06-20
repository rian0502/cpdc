<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\OrganisasiDosen;
use Illuminate\Routing\Controller;
use App\Models\HistoryJabatanDosen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ProfileDosenRequest;
use App\Http\Requests\UpdateProfileDosenRequest;
use App\Models\HistoryPangkatDosen;
use Carbon\Carbon;

class ProfileDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->dosen->count() > 0) {

            $tgl_lahir = Carbon::createFromFormat('Y-m-d', Auth::user()->dosen->tanggal_lahir);
            $now = Carbon::now();
            $umur = $tgl_lahir->diffInYears($now);
            $data = [
                'organisasi' => OrganisasiDosen::select('encrypt_id','nama_organisasi','tahun_menjabat','tahun_berakhir', 'jabatan')->where('dosen_id', Auth::user()->dosen->id)->get(),
                'kepangkatan' => HistoryPangkatDosen::where('dosen_id', Auth::user()->dosen->id)->orderBy('id', 'desc')->get(),
                'jabatan' => HistoryJabatanDosen::where('dosen_id', Auth::user()->dosen->id)->get(),
                'umur' => $umur,
            ];
            return view('dosen.profile.index', $data);
        } else {
            return redirect()->route('dosen.profile.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(Auth::user()->dosen != null){
            return redirect()->back();
        }
        return view('dosen.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(ProfileDosenRequest $request)
    {
        $foto = $request->file('foto_profile');
        $nama_foto_profile = Str::random() . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('uploads/foto_profile'), $nama_foto_profile);
        $profileDosen = [
            'nip' => $request->nip,
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => 'Aktif',
            'user_id' => Auth::user()->id,
            'foto_profile' => $nama_foto_profile,

        ];

        $insertProfile = Dosen::create($profileDosen);
        $idProfileDosen = $insertProfile->id;
        $insertEncypToProfile = Dosen::find($idProfileDosen)->update([
            'encrypt_id' => Crypt::encrypt($idProfileDosen)
        ]);

        //insert data ketable jabatan dosen
        $file_sk_jabatan = $request->file('file_sk_jabatan');
        $nama_file_sk_jabatan = Str::random() . '.' . $file_sk_jabatan->getClientOriginalExtension();
        $file_sk_jabatan->move(public_path('uploads/sk_jabatan_dosen'), $nama_file_sk_jabatan);
        $dataJabatan = [
            'jabatan' => $request->jabatan,
            'tgl_sk' => $request->tanggal_sk_jabatan,
            'file_sk' => $nama_file_sk_jabatan,
            'dosen_id' => $idProfileDosen,
        ];
        $insertJabatan = HistoryJabatanDosen::create($dataJabatan);
        $idJabatan = $insertJabatan->id;
        $insertEncypToJabatan = HistoryJabatanDosen::find($idJabatan)->update([
            'encrypted_id' => Crypt::encrypt($idJabatan)
        ]);
        //end insert data ketable jabatan dosen


        //insert data ketable pangkat dosen
        $file_sk_pangkat = $request->file('file_sk_pangkat');
        $nama_file_sk_pangkat = Str::random() . '.' . $file_sk_pangkat->getClientOriginalExtension();
        $file_sk_pangkat->move(public_path('uploads/sk_pangkat_dosen'), $nama_file_sk_pangkat);
        $dataPangkat = [
            'kepangkatan' => $request->kepangkatan,
            'tgl_sk' => $request->tanggal_sk_pangkat,
            'file_sk' => $nama_file_sk_pangkat,
            'dosen_id' => $idProfileDosen,
        ];
        $insertPangkat = HistoryPangkatDosen::create($dataPangkat);
        $idPangkat = $insertPangkat->id;
        $insertEncypToPangkat = HistoryPangkatDosen::find($idPangkat)->update([
            'encrypted_id' => Crypt::encrypt($idPangkat)
        ]);
        //end insert data ketable pangkat dosen
        $updateNamaProfile = User::find(Auth::user()->id)->update([
            'name' => $request->nama_dosen
        ]);
        return redirect()->route('dosen.profile.index')->with('success', 'Profile Berhasil Disimpan');
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
        if(Auth::user()->dosen->nip != $id){
            return redirect()->back();
        }
        $dosen = Dosen::where('nip', $id)->first();
        return view('dosen.profile.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileDosenRequest $request, $id)
    {
        if(Auth::user()->dosen->nip != $id){
            return redirect()->back();
        }
        $dosen = Dosen::where('nip', $id)->first();
        if ($request->file('foto_profile') != null) {
            $foto = $request->file('foto_profile');
            $nama_foto = $foto->hashName();
            $foto->move(public_path('uploads/profile'), $nama_foto);
            $user = User::find(Auth::user()->id);
            $user->profile_picture = $nama_foto;
            $user->save();
        }
        $dosen->nip = $request->nip;
        $dosen->nidn = $request->nidn;
        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->no_hp = $request->no_hp;
        $dosen->tanggal_lahir = $request->tanggal_lahir;
        $dosen->tempat_lahir = $request->tempat_lahir;
        $dosen->alamat = $request->alamat;
        $dosen->jenis_kelamin = $request->gender;
        $dosen->updated_at = date('Y-m-d H:i:s');
        $dosen->save();
        return redirect()->route('dosen.profile.index')->with('success', 'Profile Berhasil Diperbarui');
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
