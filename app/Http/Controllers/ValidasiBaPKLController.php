<?php

namespace App\Http\Controllers;

use App\Models\ModelSeminarKP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ValidasiBaPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'berkas' => (new ModelSeminarKP())->getSeminarKumpulBa()
        ];

        return view('koor.pkl.validasi_ba.index', $data);
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
        return dd($request->all());
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
        $data = [
            'seminar' => ModelSeminarKP::find(Crypt::decrypt($id)),
        ];
        return view('koor.pkl.validasi_ba.edit', $data);
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

        if ($request->status_seminar != 'Selesai') {
            $validated = $request->validate([
                'keterangan' => 'required'
            ], [
                'keterangan.required' => 'Jika Masih ada kesalahan maka keterangan harus diisi'
            ]);
            $data = [
                'keterangan' => $request->keterangan,
                'status_seminar' => $request->status_seminar,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $semianr = ModelSeminarKP::find(Crypt::decrypt($id));
            $semianr->update($data);
            return redirect()->route('koor.validasiBaPKL.index')->with('success', 'Berhasil mengubah status seminar');
        } else {
            $data = [
                'status_seminar' => $request->status_seminar,
                'keterangan' => '',
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $semianr = ModelSeminarKP::find(Crypt::decrypt($id));
            $semianr->update($data);
            return redirect()->route('koor.validasiBaPKL.index')->with('success', 'Berhasil mengubah status seminar');
        }
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
