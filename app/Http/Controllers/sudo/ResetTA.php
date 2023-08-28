<?php

namespace App\Http\Controllers\sudo;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ResetTA extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ModelSeminarTaSatu::query()->with('mahasiswa');
            return DataTables::of($data)->toJson();
        }
        return view('sudo.reset_ta.index');
    }

    public function destroy($id)
    {
        //
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        if ($mahasiswa->ta_satu) {
            $ta_satu = $mahasiswa->ta_satu;
            unlink('uploads/syarat_seminar_ta1/' . $ta_satu->berkas_ta_satu);
            if ($ta_satu->ba_seminar) {
                unlink('uploads/ba_seminar_ta_satu' . $ta_satu->ba_seminar->berkas_ba_seminar_ta_satu);
                unlink('uploads/nilai_seminar_ta_satu' . $ta_satu->ba_seminar->berkas_nilai_seminar_ta_satu);
            }
            $ta_satu->delete();
        }
        if ($mahasiswa->ta_dua) {
            $ta_dua = $mahasiswa->ta_dua;
            unlink('uploads/syarat_seminar_ta2/' . $ta_dua->berkas_ta_dua);
            if ($ta_dua->ba_seminar) {
                unlink('uploads/ba_seminar_ta_dua/' . $ta_dua->ba_seminar->berkas_ba_seminar_ta_dua);
                unlink('uploads/nilai_seminar_ta_dua/' . $ta_dua->ba_seminar->berkas_nilai_seminar_ta_dua);
            }
            $ta_dua->delete();
        }
        if ($mahasiswa->komprehensif) {
            $seminar_kompre = $mahasiswa->komprehensif;
            unlink('uploads/syarat_sidang_kompre/' . $seminar_kompre->berkas_kompre);
            if ($seminar_kompre->beritaAcara) {
                unlink('uploads/ba_sidang_kompre/' . $seminar_kompre->beritaAcara->ba_seminar_komprehensif);
                unlink('uploads/nilai_sidang_kompre/' . $seminar_kompre->beritaAcara->berkas_nilai_kompre);
            }
            $seminar_kompre->delete();
        }
        return redirect()->route('sudo.reset.seminar.index')->with('success', 'Data berhasil dihapus');
    }
}
