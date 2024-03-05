<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplateBeritaAcara;
use App\Http\Controllers\Controller;


class TemplateSeminarController extends Controller
{
    //
    public function index()
    {
        $files = TemplateBeritaAcara::all();
        return view('admin.admin_berkas.template_ba.index', compact('files'));
    }
    public function edit($id)
    {
        $file = TemplateBeritaAcara::find($id);
        return view('admin.admin_berkas.template_ba.edit', compact('file'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'file_template' => 'required|max:2048|mimes:doc,docx',
        ]);
        $template = TemplateBeritaAcara::find($id);
        if($request->nama == 'Berita Acara PKL'){
            $path = 'uploads/template_ba_kp/';
        }else if($request->nama == 'Berita Acara TA 1'){
            $path = 'uploads/template_ba_ta1/';
        }else if($request->nama == 'Berita Acara TA 2'){
            $path = 'uploads/template_ba_ta2/';
        }else if($request->nama == 'Berita Acara Komprehensif'){
            $path = 'uploads/template_ba_kompre/';
        }else if($request->nama == 'Berita Acara Tesis 1'){
            $path = 'uploads/template_s2_ba_ta1/';
        }else if($request->nama == 'Berita Acara Tesis 2'){
            $path = 'uploads/template_s2_ba_ta2/';
        }else{
            $path = 'uploads/template_s2_ba_kompre/';
        }
        if(file_exists($template->path)){
            unlink($template->path);
        }
        $file = $request->file('file_template');
        $fileName = $request->hashName();
        $fullPath = $path.$fileName;
        $file->move($fullPath);
        $template->path = $fullPath;
        $template->save();
        return redirect()->route('berkas.template_seminar.index')->with('success', 'Template Berita Acara berhasil diubah');
    }
}
