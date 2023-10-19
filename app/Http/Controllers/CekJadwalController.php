<?php

namespace App\Http\Controllers;

use App\Models\JadwalSKP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaDua;
use App\Models\ModelJadwalSeminarKompre;
use App\Models\ModelJadwalSeminarKompreS2;
use App\Models\ModelJadwalSeminarTaDuaS2;
use App\Models\ModelJadwalSeminarTaSatu;
use App\Models\ModelJadwalSeminarTaSatuS2;

class CekJadwalController extends Controller
{
    //
    public function checkJadwal(Request $request)
    {
        $validation = $request->validate([
            'tanggal_skp' => 'required|date|after_or_equal:tomorrow',
            'jam_mulai_skp' => 'required',
            'jam_selesai_skp' => 'required|after:jam_mulai_skp',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
        ], [
            'tanggal_skp.required' => 'Tanggal Harus Diisi',
            'tanggal_skp.date' => 'Tanggal harus berupa tanggal',
            'tanggal_skp.after_or_equal' => 'Tanggal Minimal Besok',
            'jam_mulai_skp.required' => 'Jam mulai tidak boleh kosong',
            'jam_selesai_skp.required' => 'Jam selesai tidak boleh kosong',
            'id_lokasi.required' => 'Lokasi tidak boleh kosong',
            'id_lokasi.exists' => 'Lokasi tidak ditemukan',
            'jam_selesai_skp.after' => 'Jam selesai harus lebih besar dari jam mulai',
        ]);
        $cekJadwalPkl = $this->kp($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalTa1 = $this->ta1($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalTa2 = $this->ta2($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalKompre = $this->kompre($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalTesis1 = $this->tesis1($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalTesis2 = $this->tesis2($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalSidangTesis = $this->sidangTesis($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);

        if ($cekJadwalPkl || $cekJadwalTa1 || $cekJadwalTa2 || $cekJadwalKompre || $cekJadwalTesis1 || $cekJadwalTesis2 || $cekJadwalSidangTesis) {
            return response()->json(['message' => 'Failed']);
        } else {
            return response()->json(['message' => 'Valid']);
        }
        return $request->all();
    }
    public function checkUpdate(Request $request)
    {
        $validation = $request->validate([
            'tanggal_skp' => 'required|date|after_or_equal:tomorrow',
            'jam_mulai_skp' => 'required',
            'jam_selesai_skp' => 'required|after:jam_mulai_skp',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
        ], [
            'tanggal_skp.required' => 'Tanggal Harus Diisi',
            'tanggal_skp.date' => 'Tanggal harus berupa tanggal',
            'tanggal_skp.after_or_equal' => 'Tanggal Minimal Besok',
            'jam_mulai_skp.required' => 'Jam mulai tidak boleh kosong',
            'jam_selesai_skp.required' => 'Jam selesai tidak boleh kosong',
            'id_lokasi.required' => 'Lokasi tidak boleh kosong',
            'id_lokasi.exists' => 'Lokasi tidak ditemukan',
            'jam_selesai_skp.after' => 'Jam selesai harus lebih besar dari jam mulai',
        ]);

        $cekJadwalPkl = $this->kp($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalTa1 = $this->ta1($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalTa2 = $this->ta2($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalKompre = $this->kompre($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalTesis1 = $this->tesis1($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalTesis2 = $this->tesis2($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);
        $cekJadwalSidangTesis = $this->sidangTesis($request->jam_mulai_skp, $request->jam_selesai_skp, $request->tanggal_skp, $request->id_lokasi);

        if ($cekJadwalPkl || $cekJadwalTa1 || $cekJadwalTa2 || $cekJadwalKompre || $cekJadwalTesis1 || $cekJadwalTesis2 || $cekJadwalSidangTesis) {
            return response()->json(['message' => 'Failed']);
        } else {
            return response()->json(['message' => 'Valid']);
        }
        return $request->all();
    }

    public function kp($jam_mulai_skp, $jam_selesai_skp, $tanggal_skp, $id_lokasi)
    {
        return JadwalSKP::where('tanggal_skp', $tanggal_skp)
            ->where('id_lokasi', Crypt::decrypt($id_lokasi))
            ->where(function ($query) use ($jam_mulai_skp, $jam_selesai_skp) {
                $query->where(function ($query) use ($jam_mulai_skp, $jam_selesai_skp) {
                    $query->whereBetween('jam_mulai_skp', [$jam_mulai_skp, $jam_selesai_skp])
                        ->orWhereBetween('jam_selesai_skp', [$jam_mulai_skp, $jam_selesai_skp]);
                });
            })
            ->exists();
    }
    public function ta1($jam_mulai_seminar_ta_satu, $jam_selesai_seminar_ta_satu, $tanggal_seminar_ta_satu, $id_lokasi)
    {
        return ModelJadwalSeminarTaSatu::where('tanggal_seminar_ta_satu', $tanggal_seminar_ta_satu)
            ->where('id_lokasi', Crypt::decrypt($id_lokasi))
            ->where(function ($query) use ($jam_mulai_seminar_ta_satu, $jam_selesai_seminar_ta_satu) {
                $query->where(function ($query) use ($jam_mulai_seminar_ta_satu, $jam_selesai_seminar_ta_satu) {
                    $query->whereBetween('jam_mulai_seminar_ta_satu', [$jam_mulai_seminar_ta_satu, $jam_selesai_seminar_ta_satu])
                        ->orWhereBetween('jam_selesai_seminar_ta_satu', [$jam_mulai_seminar_ta_satu, $jam_selesai_seminar_ta_satu]);
                });
            })->exists();
    }
    public function ta2($jam_mulai_seminar_ta_dua, $jam_selesai_seminar_ta_dua, $tanggal_seminar_ta_dua, $id_lokasi)
    {
        return ModelJadwalSeminarTaDua::where('tanggal_seminar_ta_dua', $tanggal_seminar_ta_dua)
            ->where('id_lokasi', Crypt::decrypt($id_lokasi))
            ->where(function ($query) use ($jam_mulai_seminar_ta_dua, $jam_selesai_seminar_ta_dua) {
                $query->where(function ($query) use ($jam_mulai_seminar_ta_dua, $jam_selesai_seminar_ta_dua) {
                    $query->whereBetween('jam_mulai_seminar_ta_dua', [$jam_mulai_seminar_ta_dua, $jam_selesai_seminar_ta_dua])
                        ->orWhereBetween('jam_selesai_seminar_ta_dua', [$jam_mulai_seminar_ta_dua, $jam_selesai_seminar_ta_dua]);
                });
            })->exists();
    }

    public function kompre($jam_mulai_komprehensif, $jam_selesai_komprehensif, $tanggal_komprehensif, $id_lokasi)
    {
        return ModelJadwalSeminarKompre::where('tanggal_komprehensif', $tanggal_komprehensif)
            ->where('id_lokasi', Crypt::decrypt($id_lokasi))
            ->where(function ($query) use ($jam_mulai_komprehensif, $jam_selesai_komprehensif) {
                $query->where(function ($query) use ($jam_mulai_komprehensif, $jam_selesai_komprehensif) {
                    $query->whereBetween('jam_mulai_komprehensif', [$jam_mulai_komprehensif, $jam_selesai_komprehensif])
                        ->orWhereBetween('jam_selesai_komprehensif', [$jam_mulai_komprehensif, $jam_selesai_komprehensif]);
                });
            })->exists();
    }
    public function tesis1($jam_mulai, $jam_selesai, $tanggal, $id_lokasi)
    {
        return ModelJadwalSeminarTaSatuS2::where('tanggal', $tanggal)
            ->where('id_lokasi', Crypt::decrypt($id_lokasi))
            ->where(function ($query) use ($jam_mulai, $jam_selesai) {
                $query->where(function ($query) use ($jam_mulai, $jam_selesai) {
                    $query->whereBetween('jam_mulai', [$jam_mulai, $jam_selesai])
                        ->orWhereBetween('jam_selesai', [$jam_mulai, $jam_selesai]);
                });
            })->exists();
    }

    public function tesis2($jam_mulai, $jam_selesai, $tanggal, $id_lokasi)
    {
        return ModelJadwalSeminarTaDuaS2::where('tanggal', $tanggal)
            ->where('id_lokasi', Crypt::decrypt($id_lokasi))
            ->where(function ($query) use ($jam_mulai, $jam_selesai) {
                $query->where(function ($query) use ($jam_mulai, $jam_selesai) {
                    $query->whereBetween('jam_mulai', [$jam_mulai, $jam_selesai])
                        ->orWhereBetween('jam_selesai', [$jam_mulai, $jam_selesai]);
                });
            })->exists();
    }

    public function sidangTesis($jam_mulai, $jam_selesai, $tanggal, $id_lokasi)
    {
        return ModelJadwalSeminarKompreS2::where('tanggal', $tanggal)
            ->where('id_lokasi', Crypt::decrypt($id_lokasi))
            ->where(function ($query) use ($jam_mulai, $jam_selesai) {
                $query->where(function ($query) use ($jam_mulai, $jam_selesai) {
                    $query->whereBetween('jam_mulai', [$jam_mulai, $jam_selesai])
                        ->orWhereBetween('jam_selesai', [$jam_mulai, $jam_selesai]);
                });
            })->exists();
    }
}
