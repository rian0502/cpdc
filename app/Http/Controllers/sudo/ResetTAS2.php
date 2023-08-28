<?php

namespace App\Http\Controllers\sudo;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaSatuS2;

class ResetTAS2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ModelSeminarTaSatuS2::query()->with('mahasiswa');
            return DataTables::of($data)->toJson();
        }
        return view('sudo.reset_ta.s2.index');
    }

    public function destroy($id)
    {
        //
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        if ($mahasiswa->taSatuS2) {
            $ta_satu = $mahasiswa->taSatuS2;
            unlink('uploads/syarat_seminar_ta_satu_s2/' . $ta_satu->berkas_ta_satu);
            if ($ta_satu->beritaAcara) {
                unlink('uploads/ba_seminar_tesis_1/' . $ta_satu->beritaAcara->file_ba);
                unlink('uploads/nilai_seminar_tesis_1/' . $ta_satu->beritaAcara->file_nilai);
            }
            $ta_satu->delete();
        }
        if ($mahasiswa->taDuaS2) {
            $ta_dua = $mahasiswa->taDuaS2;
            unlink('uploads/syarat_seminar_ta_dua_s2/' . $ta_dua->berkas_ta_dua);
            if ($ta_dua->beritaAcara) {
                unlink('uploads/ba_seminar_tesis_2/' . $ta_dua->beritaAcara->file_ba);
                unlink('uploads/nilai_seminar_tesis_2/' . $ta_dua->beritaAcara->file_nilai);
            }
            $ta_dua->delete();
        }
        if ($mahasiswa->komprehensifS2) {
            $seminar_kompre = $mahasiswa->komprehensifS2;
            unlink('uploads/syarat_seminar_sidang_s2/' . $seminar_kompre->berkas_kompre);
            if ($seminar_kompre->beritaAcara) {
                unlink('uploads/ba_sidang_tesis/' . $seminar_kompre->beritaAcara->file_ba);
                unlink('uploads/nilai_sidang_tesis/' . $seminar_kompre->beritaAcara->file_nilai);
            }
            $seminar_kompre->delete();
        }
        return redirect()->route('sudo.reset.seminarS2.index')->with('success', 'Data berhasil dihapus');
    }
}
