<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MahasiswaBimbinganKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'kerja_praktik' => ModelSeminarKP::select('encrypt_id', 'judul_kp', 'mitra', 'tahun_akademik', 'id_dospemkp', 'id_mahasiswa')
                ->where('id_dospemkp', auth()->user()->dosen->id)->get(),
            'mahasiswa' => Mahasiswa::select('angkatan')->distinct()->whereHas('seminar_kp', function ($query) {
                $query->where('id_dospemkp', auth()->user()->dosen->id);
            })->get()
        ];
        return view('dosen.mahasiswa.bimbingan.kp.index', $data);
    }

    public function export(Request $request)
    {
        $mahasiswa =  Mahasiswa::with(['seminar_kp.dosen', 'seminar_kp.jadwal', 'seminar_kp.berita_acara'])
            ->where('angkatan', $request->kp_unduh)->whereHas('seminar_kp', function ($query) {
                $query->where('id_dospemkp', auth()->user()->dosen->id);
            })->get();
        $spredsheet = new Spreadsheet();
        $sheet = $spredsheet->getActiveSheet();
        $sheet->setTitle('Seminar Kerja Praktik');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Semester');
        $sheet->setCellValue('E1', 'Tahun Akademik');
        $sheet->setCellValue('F1', 'Tema KP/PKL');
        $sheet->setCellValue('G1', 'Mitra');
        $sheet->setCellValue('H1', 'Region');
        $sheet->setCellValue('I1', 'Tanggal Seminar');
        $sheet->setCellValue('J1', 'Nilai');
        $sheet->setCellValue('K1', 'Nilai MUTU');
        $sheet->setCellValue('L1', 'NO BA');
        $sheet->setCellValue('M1', 'Berita Acara');
        $sheet->setCellValue('N1', 'Status Admin');
        $sheet->setCellValue('O1', 'Status Koordinator');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->seminar_kp->semester);
            $sheet->setCellValue('E' . ($key + 2), $value->seminar_kp->tahun_akademik);
            $sheet->setCellValue('F' . ($key + 2), $value->seminar_kp->judul_kp);
            $sheet->setCellValue('G' . ($key + 2), $value->seminar_kp->mitra);
            $sheet->setCellValue('H' . ($key + 2), $value->seminar_kp->region);
            if ($value->seminar_kp->jadwal) {
                $sheet->setCellValue('I' . ($key + 2), $value->seminar_kp->jadwal->tanggal_skp);
            } else {
                $sheet->setCellValue('I' . ($key + 2), '-');
            }
            if ($value->seminar_kp->berita_acara) {
                $sheet->setCellValue('J' . ($key + 2), $value->seminar_kp->berita_acara->nilai_akhir);
                $sheet->setCellValue('K' . ($key + 2), $value->seminar_kp->berita_acara->nilai_mutu);
                $sheet->setCellValue('L' . ($key + 2), $value->seminar_kp->berita_acara->no_ba_seminar_kp);
                $sheet->setCellValue('M' . ($key + 2), url('uploads/berita_acara_seminar_kp/' . $value->seminar_kp->berita_acara->berkas_ba_seminar_kp));
            } else {
                $sheet->setCellValue('J' . ($key + 2), '-');
                $sheet->setCellValue('K' . ($key + 2), '-');
                $sheet->setCellValue('L' . ($key + 2), '-');
                $sheet->setCellValue('M' . ($key + 2), '-');
            }
            $sheet->setCellValue('N' . ($key + 2), $value->seminar_kp->proses_admin);
            $sheet->setCellValue('O' . ($key + 2), $value->seminar_kp->status_seminar);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spredsheet);
        $writer->save("SeminarKerjaPraktikAngkatan{$request->kp_unduh}.xlsx");
        return response()->download(("SeminarKerjaPraktikAngkatan{$request->kp_unduh}.xlsx"))->deleteFileAfterSend(true);
    }
    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        $data = [
            'mahasiswa' => $mahasiswa,
            'kp' => $mahasiswa->seminar_kp,
        ];
        return view('dosen.mahasiswa.bimbingan.kp.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
