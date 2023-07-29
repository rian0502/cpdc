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
        return view('dosen.publikasi.index');
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
            'dosens' => Dosen::whereNotIn('id', [Auth::user()->dosen->id])
                ->where('status', 'Aktif')
                ->get(),
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
            return redirect()->route('dosen.publikasi.index')->with('success', 'Data berhasil ditambahkan');
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
                'dosens' => Dosen::whereNotIn('id', [Auth::user()->dosen->id])
                    ->where('status', 'Aktif')->get(),
                'anggota' => $anggota_id,
            ];
        } else {
            return redirect()->route('dosen.publikasi.index')->with('error', 'Anda tidak memiliki akses');
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
            return redirect()->route('dosen.publikasi.index')->with('error', 'Anda tidak memiliki akses');
        }

        return redirect()->route('dosen.publikasi.index')->with('success', 'Data Publikasi diubah');
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
        return redirect()->route('dosen.publikasi.index')->with('success', 'Data Publikasi dihapus');
    }


    public function import(Request $request)
    {
        if (!$request->validate(
            [
                'publikasi' => 'required|mimes:xls,xlsx|max:2048'
            ],
            [
                'publikasi.required' => 'File tidak boleh kosong',
                'publikasi.mimes' => 'File harus berupa excel',
                'publikasi.max' => 'File maksimal 2MB'
            ]
        )) {
            return dd($request->validate());
            return redirect()->back()->with('error', $request->validate());
        }
        $file = $request->file('publikasi');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $key => $value) {
            if ($key == 0) {
                continue;
            }
            $data = [
                'nama_publikasi' => $value[0],
                'judul' => $value[1],
                'tahun' => $value[2],
                'vol' => $value[3],
                'halaman' => $value[4],
                'scala' => $value[5],
                'kategori' => $value[6],
                'kategori_litabmas' => $value[7],
                'url' => $value[8],
                'anggota_external' => $value[9],
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
        }
        return redirect()->route('dosen.publikasi.index')->with('success', 'Data Berhasil Diupload');
    }
}
