<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\LitabmasDosen;
use App\Models\AnggotaLitabmas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreLitabmasDosenRequest;

class LitabmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'dosens' => Dosen::whereNotIn('id', [Auth::user()->dosen->id])->get(),
        ];
        return view('dosen.litabmas.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLitabmasDosenRequest $request)
    {
        $litabmas = [
            'nama_litabmas' => $request->nama_litabmas,
            'kategori' => $request->kategori,
            'sumber_dana' => $request->sumber_dana,
            'jumlah_dana' => $request->jumlah_dana,
            'tahun_penelitian' => $request->tahun_pelaksanaan,
            'anggota_external' => $request->anggota_external,
        ];
        $inLitabmas = LitabmasDosen::create($litabmas);
        $id_litabmas = $inLitabmas->id;
        $update_litabmas = LitabmasDosen::where('id', $id_litabmas)->update(['encrypt_id' => Crypt::encrypt($id_litabmas)]);
        if ($request->anggota) {
            $anggota = [
                'litabmas_id' => $id_litabmas,
                'dosen_id' => Auth::user()->dosen->id,
                'Posisi' => 'Ketua',
            ];
            $inKetua = AnggotaLitabmas::create($anggota);
            foreach ($request->anggota as $key => $value) {
                $anggota = [
                    'litabmas_id' => $id_litabmas,
                    'dosen_id' => Crypt::decrypt($value),
                    'Posisi' => 'Anggota',
                ];
                $inAnggota = AnggotaLitabmas::create($anggota);
            }
            if ($inKetua && $update_litabmas && $inLitabmas) {
                return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil ditambahkan');
            } else {
                return redirect()->route('dosen.litabmas.create')->with('error', 'Data gagal ditambahkan');
            }
        } else {
            $anggota = [
                'litabmas_id' => $id_litabmas,
                'dosen_id' => Auth::user()->dosen->id,
                'Posisi' => 'Ketua',
            ];
            $inAnggota = AnggotaLitabmas::create($anggota);
            if ($inAnggota && $update_litabmas && $inLitabmas) {
                return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil ditambahkan');
            } else {
                return redirect()->route('dosen.litabmas.create')->with('error', 'Data gagal ditambahkan');
            }
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
        //
        $data = [
            'litabmas' => LitabmasDosen::find(Crypt::decrypt($id)),
            'dosen' => AnggotaLitabmas::where('litabmas_id', Crypt::decrypt($id))->get(),
        ];
        return view('dosen.litabmas.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $anggota =  AnggotaLitabmas::where('litabmas_id', Crypt::decrypt($id))->get();
        if ($anggota[0]->dosen_id == Auth::user()->dosen->id) {
            $anggotaLitabmas = array();
            foreach ($anggota as $key => $value) {
                $anggotaLitabmas[] = $value->dosen_id;
            }
            $data = [
                'litabmas' => LitabmasDosen::find(Crypt::decrypt($id)),
                'dosen' => Dosen::whereNotIn('id', [Auth::user()->dosen->id])->get(),
                'anggota' => $anggotaLitabmas,
            ];
        } else {
            return redirect()->route('dosen.profile.index')->with('error', 'Anda tidak memiliki akses');
        }



        //dd($data['dosen'][0]->dosen->id);
        return view('dosen.litabmas.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLitabmasDosenRequest $request, $id)
    {
        $jumlahAnggota = AnggotaLitabmas::where('litabmas_id', Crypt::decrypt($id))->get();
        if ($jumlahAnggota[0]->dosen_id == Auth::user()->dosen->id) {
            $litabmas = LitabmasDosen::find(Crypt::decrypt($id));
            $litabmas->nama_litabmas = $request->nama_litabmas;
            $litabmas->kategori = $request->kategori;
            $litabmas->sumber_dana = $request->sumber_dana;
            $litabmas->jumlah_dana = $request->jumlah_dana;
            $litabmas->tahun_penelitian = $request->tahun_penelitian;
            $litabmas->anggota_external = $request->anggota_external;
            $litabmas->save();
            if ($request->anggota) {
                $decrypt = array();
                foreach ($request->anggota as $key => $value) {
                    $decrypt[] = Crypt::decrypt($value);
                }
                array_shift($decrypt);
                if (count($jumlahAnggota) < count($request->anggota)) {
                    //aksi penambahan anggota
                    $litabmas->dosen()->sync([Auth::user()->dosen->id], ['Posisi' => 'Anggota', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                    $litabmas->dosen()->attach($decrypt, ['Posisi' => 'Anggota', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                } else {

                    $litabmas->dosen()->detach($decrypt);
                }
            }
        }else{
            return redirect()->route('dosen.profile.index')->with('error', 'Anda tidak memiliki akses');
        }
        return redirect()->route('dosen.profile.index')->with('success', 'Data Litabmas diubah');
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
        $litabmas = LitabmasDosen::find(Crypt::decrypt($id))->delete();
        $anggota = AnggotaLitabmas::where('litabmas_id', Crypt::decrypt($id))->delete();
        return redirect()->route('dosen.profile.index')->with('success', 'Data Litabmas dihapus');
    }
}
