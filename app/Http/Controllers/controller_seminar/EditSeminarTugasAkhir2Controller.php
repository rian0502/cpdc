<?php

namespace App\Http\Controllers\controller_seminar;

use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDua;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class EditSeminarTugasAkhir2Controller extends Controller
{
    //
    public function index(){

    }
    public function edit($id){
        $seminar = ModelSeminarTaDua::with(['jadwal', 'ba_seminar'])->where('id', Crypt::decrypt($id))->first();
    }
}
