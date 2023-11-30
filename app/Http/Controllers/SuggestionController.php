<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->suggestion){
            return redirect()->route('dashboard')->with('success', 'Anda sudah mengisi survey!');
        }
        return view('mahasiswa.survey.create');
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
        $request->validate( [
            'fungsionalitas' => 'required|min:1|max:10',
            'kemudahan' => 'required|min:1|max:10',
            'tampilan' => 'required|min:1|max:10',
            'saran' => 'required|min:1|max:255|string',
            'kritik' => 'required|min:1|max:255|string',
        ],[
            'fungsionalitas.required' => 'Fungsionalitas harus diisi!',
            'fungsionalitas.min' => 'Fungsionalitas minimal 1!',
            'fungsionalitas.max' => 'Fungsionalitas maksimal 10!',
            'kemudahan.required' => 'Kemudahan harus diisi!',
            'kemudahan.min' => 'Kemudahan minimal 1!',
            'kemudahan.max' => 'Kemudahan maksimal 10!',
            'tampilan.required' => 'Tampilan harus diisi!',
            'tampilan.min' => 'Tampilan minimal 1!',
            'tampilan.max' => 'Tampilan maksimal 10!',
            'saran.required' => 'Saran harus diisi!',
            'saran.min' => 'Saran minimal 1!',
            'saran.max' => 'Saran maksimal 255!',
            'kritik.required' => 'Kritik harus diisi!',
            'kritik.min' => 'Kritik minimal 1!',
            'kritik.max' => 'Kritik maksimal 255!',
        ]);
        $data = [
            'fungsionalitas' => $request->fungsionalitas,
            'kemudahan' => $request->kemudahan,
            'tampilan' => $request->tampilan,
            'saran' => $request->saran,
            'kritik' => $request->kritik,
            'user_id' => Auth::user()->id,
        ];
        Suggestion::create($data);
        return redirect()->route('dashboard')->with('success', 'Terima kasih atas saran dan kritiknya! Kami akan terus berusaha untuk memperbaiki aplikasi ini.');


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
        //
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
