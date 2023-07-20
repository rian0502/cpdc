<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\PublikasiDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AnggotaPublikasiDosen;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StorePublikasiRequest;

class PublikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'dosens' => Dosen::whereNotIn('id', [Auth::user()->dosen->id])->get(),
        ];
        return view('dosen.publikasi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublikasiRequest $request)
    {
        // dd($request->all());
        $data = [
            'judul' => $request->judul,
            'nama_publikasi' => $request->nama_publikasi,
            'vol' => $request->vol,
            'halaman' => $request->halaman,
            'tahun' => $request->tahun,
            'url' => $request->url,
            'kategori_litabmas' => $request->kategori_litabmas,
            'scala' => $request->scala,
            'kategori' => $request->kategori,
            'anggota_external' => $request->anggota_external,
        ];
        $insert = PublikasiDosen::create($data);
        $id = $insert->id;
        $update = PublikasiDosen::find($id)->update(['encrypt_id' => Crypt::encrypt($id)]);
        $data = [
            'posisi' => 'Ketua',
            'id_publikasi' => $id,
            'id_dosen' => Auth::user()->dosen->id,
        ];
        AnggotaPublikasiDosen::create($data);
        if ($request->anggota) {
            foreach ($request->anggota as $key => $value) {
                $data = [
                    'id_publikasi' => $id,
                    'id_dosen' => Crypt::decrypt($value),
                    'posisi' => 'Anggota',
                ];
                AnggotaPublikasiDosen::create($data);
            }
        }
        if ($update) {
            return redirect()->route('dosen.profile.index')->with('success', 'Data berhasil ditambahkan');
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
            'publikasi' => PublikasiDosen::find(Crypt::decrypt($id)),
            'anggota' => AnggotaPublikasiDosen::where('id_publikasi', Crypt::decrypt($id))->get(),
        ];
        return view('dosen.publikasi.show', $data);
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
        $anggota = AnggotaPublikasiDosen::where('id_publikasi', Crypt::decrypt($id))->get();

        if ($anggota[0]->id_dosen == Auth::user()->dosen->id) {
            $anggota_id = [];
            foreach ($anggota as $key => $value) {
                $anggota_id[] = $value->id_dosen;
            }
            $data = [
                'publikasi' => PublikasiDosen::find(Crypt::decrypt($id)),
                'dosens' => Dosen::whereNotIn('id', [Auth::user()->dosen->id])->get(),
                'anggota' => $anggota_id,
            ];
        } else {
            return redirect()->route('dosen.profile.index')->with('error', 'Anda tidak memiliki akses');
        }


        return view('dosen.publikasi.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePublikasiRequest $request, $id)
    {
        $jumlah = AnggotaPublikasiDosen::where('id_publikasi', Crypt::decrypt($id))->get();

        if ($jumlah[0]->id_dosen == Auth::user()->dosen->id) {
            $publikasi = PublikasiDosen::find(Crypt::decrypt($id));
            $publikasi->nama_publikasi = $request->nama_publikasi;
            $publikasi->judul = $request->judul;
            $publikasi->vol = $request->vol;
            $publikasi->halaman = $request->halaman;
            $publikasi->tahun = $request->tahun;
            $publikasi->url = $request->url;
            $publikasi->kategori_litabmas = $request->kategori_litabmas;
            $publikasi->scala = $request->scala;
            $publikasi->kategori = $request->kategori;
            $publikasi->anggota_external = $request->anggota_external;
            $publikasi->save();

            if ($request->anggota) {
                $decrypt = array();
                foreach ($request->anggota as $key => $value) {
                    $decrypt[] = Crypt::decrypt($value);
                }
                $publikasi->dosen()->sync([Auth::user()->dosen->id], ['posisi' => 'Ketua',  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                $publikasi->dosen()->attach($decrypt, ['posisi' => 'Anggota',  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
        } else {
            return redirect()->route('dosen.profile.index')->with('error', 'Anda tidak memiliki akses');
        }

        return redirect()->route('dosen.profile.index')->with('success', 'Data Publikasi diubah');
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
        PublikasiDosen::find(Crypt::decrypt($id))->delete();
        AnggotaPublikasiDosen::where('id_publikasi', Crypt::decrypt($id))->delete();
        return redirect()->route('dosen.profile.index')->with('success', 'Data Publikasi dihapus');
    }
}
