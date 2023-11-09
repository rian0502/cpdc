<?php

namespace App\Http\Controllers\sudo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportMahasiswaController extends Controller
{
    //
    public function index(){
        return view('sudo.import.mahasiswa');
    }
    public function store(Request $request){
        return dd($request->all());
    }
}
