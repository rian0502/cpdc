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
        return dd($request->all());
        $request->validate([
            'file' => 'required|max:2048|mimes:doc,docx',
        ]);
        $file = $request->file('file_template');
        $file_name = $file->hashName();
        $file->move('uploads/template_ba/' . $file_name);
        $file = TemplateBeritaAcara::find($id);
        unlink('uploads/template_ba/' . $file->file_template);
        $file->path = $file_name;
        $file->save();
        return redirect()->route('berkas.template_seminar.index')->with('success', 'File berhasil diupdate');
    }
}
