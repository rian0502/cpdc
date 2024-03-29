<?php

namespace App\Http\Controllers\kerja_praktik;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMahasiswaBaKpRequest;
use App\Http\Requests\UpdateMahasiswaBaKpRequest;
use App\Models\BaSKP;
use App\Models\Mahasiswa;
use App\Models\ModelSeminarKP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BeritaAcaraSeminarKerjaPraktik extends Controller
{
    public function create()
    {
        //
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $seminar = ModelSeminarKP::where('id_mahasiswa', $mahasiswa->id)->first();
        //cek apakah sudah upload ba
        if ($seminar->berita_acara) {
            return redirect()->back();
        }

        return view('mahasiswa.kp.ba.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMahasiswaBaKpRequest $request)
    {

        $replace_lapangan = str_replace(',', '.', $request->nilai_lapangan);
        $replace_akd = str_replace(',', '.', $request->nilai_akd);
        $replace_akhir = str_replace(',', '.', $request->nilai_akhir);
        $skp = ModelSeminarKP::where('id_mahasiswa', Auth::user()->mahasiswa->id)->first();
        $file_ba = $request->file('berkas_ba_seminar_kp');
        $file_laporan = $request->file('laporan_kp');
        $nama_file_ba = $file_ba->hashName();
        $nama_file_laporan = $file_laporan->hashName();
        $file_ba->move('uploads/berita_acara_seminar_kp', $nama_file_ba);
        $file_laporan->move('uploads/laporan_kp', $nama_file_laporan);
        $baskp = BaSKP::create([
            'no_ba_seminar_kp' => $request->no_ba_seminar_kp,
            'nilai_lapangan' => $replace_lapangan,
            'nilai_akd' => $replace_akd,
            'nilai_akhir' => $replace_akhir,
            'nilai_mutu' => $request->nilai_mutu,
            'berkas_ba_seminar_kp' => $nama_file_ba,
            'laporan_kp' => $nama_file_laporan,
            'id_seminar' => $skp->id,
        ]);
        $inser_id = $baskp->id;
        $update = BaSKP::find($inser_id);
        $update->encrypt_id = Crypt::encrypt($inser_id);
        $update->save();
        return redirect()->route('mahasiswa.seminar.kp.index')
            ->with('success', 'Berhasil Upload Berita Acara Seminar Kerja Praktik');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $seminar = BaSKP::where('id_seminar', Crypt::decrypt($id))->first();
        return view('mahasiswa.kp.ba.edit', compact('seminar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswaBaKpRequest $request, $id)
    {
        $update = BaSKP::find(Crypt::decrypt($id));
        $file_ba = $request->file('berkas_ba_seminar_kp');
        $file_laporan = $request->file('laporan_kp');
        $replace_lapangan = str_replace(',', '.', $request->nilai_lapangan);
        $replace_akd = str_replace(',', '.', $request->nilai_akd);
        $replace_akhir = str_replace(',', '.', $request->nilai_akhir);

        if ($file_ba && $file_laporan) {
            $nama_file_ba = $file_ba->hashName();
            $nama_file_laporan = $file_laporan->hashName();
            $file_ba->move('uploads/berita_acara_seminar_kp', $nama_file_ba);
            $file_laporan->move('uploads/laporan_kp', $nama_file_laporan);
            unlink('uploads/berita_acara_seminar_kp/' . $update->berkas_ba_seminar_kp);
            unlink('uploads/laporan_kp/' . $update->laporan_kp);
            $berita_acara = [
                'no_ba_seminar_kp' => $request->no_ba_seminar_kp,
                'nilai_lapangan' => $replace_lapangan,
                'nilai_akd' => $replace_akd,
                'nilai_akhir' => $replace_akhir,
                'nilai_mutu' => $request->nilai_mutu,
                'berkas_ba_seminar_kp' => $nama_file_ba,
                'laporan_kp' => $nama_file_laporan,
                'update_at' => date('Y-m-d H:i:s')
            ];
        } else if ($file_ba) {
            $nama_file_ba = $file_ba->hashName();
            $file_ba->move('uploads/berita_acara_seminar_kp', $nama_file_ba);
            unlink('uploads/berita_acara_seminar_kp/' . $update->berkas_ba_seminar_kp);
            $berita_acara = [
                'no_ba_seminar_kp' => $request->no_ba_seminar_kp,
                'nilai_lapangan' => $replace_lapangan,
                'nilai_akd' => $replace_akd,
                'nilai_akhir' => $replace_akhir,
                'nilai_mutu' => $request->nilai_mutu,
                'berkas_ba_seminar_kp' => $nama_file_ba,
                'update_at' => date('Y-m-d H:i:s')
            ];
        } else if ($file_laporan) {
            $nama_file_laporan = $file_laporan->hashName();
            $file_laporan->move('uploads/laporan_kp', $nama_file_laporan);
            unlink('uploads/laporan_kp/' . $update->laporan_kp);
            $berita_acara = [
                'no_ba_seminar_kp' => $request->no_ba_seminar_kp,
                'nilai_lapangan' => $replace_lapangan,
                'nilai_akd' => $replace_akd,
                'nilai_akhir' => $replace_akhir,
                'nilai_mutu' => $request->nilai_mutu,
                'laporan_kp' => $nama_file_laporan,
                'update_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $berita_acara = [
                'no_ba_seminar_kp' => $request->no_ba_seminar_kp,
                'nilai_lapangan' => $replace_lapangan,
                'nilai_akd' => $replace_akd,
                'nilai_akhir' => $replace_akhir,
                'nilai_mutu' => $request->nilai_mutu,
                'update_at' => date('Y-m-d H:i:s')
            ];
        }
        $update->update($berita_acara);
        $seminar = ModelSeminarKP::where('id', $update->id_seminar)->first();
        $seminar->keterangan = '';
        $seminar->save();
        return redirect()->route('mahasiswa.seminar.kp.index')->with('success', 'Data Berhasil Diupdate');
    }
}
