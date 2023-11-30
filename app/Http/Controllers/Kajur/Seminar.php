<?php

namespace App\Http\Controllers\Kajur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Seminar extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jurusan.seminar.index');
    }
}
