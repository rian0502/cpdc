<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\AnggotaLitabmas;
use App\Models\OrganisasiDosen;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryJabatanDosen;
use App\Models\HistoryPangkatDosen;
use App\Http\Controllers\Controller;
use App\Models\AnggotaPublikasiDosen;
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
        if ($validation) {
            $user = new User();
            $user->email = $request->email;
            $user->email_verified_at = now();
            $user->name = $request->nama;
            $user->password = bcrypt($request->password);
            $user->save();
            $user->assignRole($request->role);
            return redirect()->route('sudo.akun_dosen.index')->with('success', 'Akun Dosen Berhasil Ditambahkan');
        } else {
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

    public function chartUsiaDosen()
    {
        $query = DB::table('dosen')
            ->select(DB::raw('FLOOR((TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) + 10) / 10) * 10 as usia_group, COUNT(*) as total'))
            ->groupBy('usia_group')
            ->orderBy('usia_group')
            ->get();

        $data = $query->map(function ($result) {
            return [
                'usia_group' => $result->usia_group . '++',
                'total' => $result->total,
            ];
        });

        return response()->json($data);
    }


    public function chartJabatanDosen(Request $request)
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
