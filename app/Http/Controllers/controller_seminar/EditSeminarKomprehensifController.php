<?php

namespace App\Http\Controllers\controller_seminar;

use Illuminate\Http\Request;
use App\Models\ModelSeminarKompre;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class EditSeminarKomprehensifController extends Controller
{
    //
    public function index(){

    }
    public function edit($id){
        $seminar = ModelSeminarKompre::with(['jadwal', 'beritaAcara'])->where('id', Crypt::decrypt($id))->first();
    }
    public function update(Request $request){

    }
}
