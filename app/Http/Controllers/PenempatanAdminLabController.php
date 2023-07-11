<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;

class PenempatanAdminLabController extends Controller
{
    //
    public function index()
    {
        $adlab = User::role('admin lab')->with('administrasi')->get();

        return view('sudo.admin.index', compact('adlab'));
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
        $data = [
            'user' => User::find($id),
            'locations' => Lokasi::all()
        ];
        return view('sudo.admin.edit', $data);
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
        $user->lokasi_id = Crypt::decrypt($request->id_lokasi);
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();
        return redirect()->route('sudo.admin_jurusan.index')->with('success', 'Berhasil mengubah data admin lab');
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
