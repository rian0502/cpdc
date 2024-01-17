<?php

namespace App\Http\Controllers\sudo;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAkunDosenRequest;
use App\Models\AnggotaLitabmas;
use App\Models\AnggotaPublikasiDosen;
use App\Models\Dosen;
use App\Models\HistoryJabatanDosen;
use App\Models\HistoryPangkatDosen;
use App\Models\ModelGelar;
use App\Models\ModelSPDosen;
use App\Models\OrganisasiDosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


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
            'lecturers' => Dosen::all(),
            'account' => User::role('dosen')->get(),
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
    public function store(StoreAkunDosenRequest $request)
    {
        //
        $user = new User();
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->name = $request->nama;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->assignRole($request->role);
        return redirect()->route('sudo.akun_dosen.index')->with('success', 'Akun Dosen Berhasil Ditambahkan');
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
            'gelar' => ModelGelar::where('dosen_id', Crypt::decrypt($id))->get(),
            'seminar' => ModelSPDosen::where('dosen_id', Crypt::decrypt($id))->where('jenis', 'Seminar')->get(),
            'penghargaan' => ModelSPDosen::where('dosen_id', Crypt::decrypt($id))->where('jenis', 'Penghargaan')->get(),
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
        $account = User::find($id);
        $data = [
            'account' => $account,
            'lecturer' => $account->dosen,
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

        $user = User::find($id);
        $dosen = Dosen::where('user_id', $id)->first();
        $user->email = $request->email;

        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->syncRoles($request->role);
        $user->save();

        if ($user->dosen) {
            $dosen->status = $request->status;
            $dosen->save();
        }
        return redirect()->route('sudo.akun_dosen.index')->with('success', 'Akun Dosen Berhasil Diubah');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if($user->dosen){
            $dosen = Dosen::find($user->dosen->id);
            if($dosen->foto_profile){
                unlink('uploads/profile/' . $dosen->foto_profile);
            }
            if($dosen->jabatan->count() > 0){
                foreach($dosen->jabatan as $jabatan){
                   unlink('uploads/sk_jabatan_dosen/'.$jabatan->file_sk);
                }
            }
            if($dosen->pangkat->count() > 0){
                foreach($dosen->pangkat as $pangkat){
                   unlink('uploads/sk_pangkat_dosen/'.$pangkat->file_sk);
                }
            }
        }
        $user->delete();
        return redirect()->route('sudo.akun_dosen.index')->with('success', 'Akun Dosen Berhasil Dihapus');
    }

    public function chartUsiaDosen()
    {
        $query = DB::table('dosen')
            ->select(DB::raw('FLOOR((TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) + 10) / 10) * 10 as usia_group, COUNT(*) as total'))
            ->groupBy('usia_group')
            ->orderBy('usia_group')
            ->get();

        $data = $query->map(function ($result) {
            $usia_group = $result->usia_group;
            if ($usia_group >= 20 && $usia_group < 35) {
                $usia_group = '20++';
            } elseif ($usia_group >= 35 && $usia_group < 45) {
                $usia_group = '35++';
            } elseif ($usia_group >= 45 && $usia_group < 55) {
                $usia_group = '45++';
            } elseif ($usia_group >= 55 && $usia_group < 65) {
                $usia_group = '55++';
            } elseif ($usia_group >= 65) {
                $usia_group = '65++';
            }

            return [
                'usia_group' => $usia_group,
                'total' => $result->total,
            ];
        });

        return response()->json($data);
    }


    public function chartJabatanDosen()
    {
        $results = DB::table('dosen')
            ->select('jabatan', DB::raw('COUNT(*) as jumlah_dosen'))
            ->join('history_jabatan_dosen', function ($join) {
                $join->on('dosen.id', '=', 'history_jabatan_dosen.dosen_id')
                    ->whereRaw('history_jabatan_dosen.tgl_sk = (SELECT MAX(tgl_sk) FROM history_jabatan_dosen WHERE dosen_id = dosen.id)');
            })
            ->groupBy('jabatan')
            ->get();

        return response()->json($results);
    }
}
