<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Laboratorium;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreActivityLab;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class LabTAController extends Controller
{
    //
    public function index()
    {

        return view('mahasiswa.lab_ta.index');
    }

    public function cekin(){

        return view('mahasiswa.lab_ta.cekin');
    }
}
