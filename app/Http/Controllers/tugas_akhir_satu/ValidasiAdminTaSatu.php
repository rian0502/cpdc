<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ValidasiAdminTaSatu extends Controller
{

    public function index()
    {
        $data = [
            'ta1' => ModelSeminarTaSatu::select('encrypt_id', 'id_mahasiswa', 'status_admin', 'judul_ta')
                ->where('status_admin', '!=', 'Valid')->get()
        ];

        return view('admin.admin_berkas.validasi.seminar.ta1.index', $data);
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
        //
        $seminar = ModelSeminarTaSatu::find(Crypt::decrypt($id));
        $mahasiswa = $seminar->mahasiswa;
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $mahasiswa,
        ];
        return view('admin.admin_berkas.validasi.seminar.ta1.edit', $data);
    }


    public function update(Request $request, $id)
    {
        if ($request->status_admin == 'Process') {
            return redirect()->back()->with('error', 'Status Admin Harus Valid atau Invalid');
        } else if ($request->status_admin == 'Invalid') {
            $status = ['Valid', 'Invalid', 'Process'];
            $validate = $request->validate(
                [
                    'status_admin' => ['required', 'string', 'in:' . implode(',', $status)],
                    'komentar' => ['required', 'string'],
                ],
                [
                    'status_admin.required' => 'Status Admin Harus Diisi',
                    'komentar.required' => 'Komentar Harus Diisi',
                    'status_admin.in' => 'Status Admin Harus Valid, Invalid, atau Process',
                    'komentar.string' => 'Komentar Harus Berupa Kata'
                ]
            );
            $seminar = ModelSeminarTaSatu::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = $request->komentar;
            $seminar->updated_at = now();
            $seminar->save();
        } else {
            $status = ['Valid', 'Invalid', 'Process'];
            $validate = $request->validate(
                [
                    'status_admin' => ['required', 'string', 'in:' . implode(',', $status)],
                ],
                [
                    'status_admin.required' => 'Status Admin Harus Diisi',
                    'status_admin.in' => 'Status Admin Harus Valid, Invalid, atau Process',
                ]
            );
            $seminar = ModelSeminarTaSatu::find(Crypt::decrypt($id));
            $seminar->status_admin = $request->status_admin;
            $seminar->komentar = null;
            $seminar->updated_at = now();
            $seminar->save();
        }
        return redirect()->route('berkas.validasi.seminar.ta1.index')
            ->with('success', 'Berhasil Mengubah Data Seminar');
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
