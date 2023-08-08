<?php

namespace App\Http\Controllers\bimbingan;

use App\Models\Mahasiswa;
use App\Models\ModelSeminarKompre;
use App\Models\ModelSeminarTaDua;
use App\Models\ModelSeminarTaSatu;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MahasiswaBimbinganTugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seminar = ModelSeminarTaSatu::where('id_pembimbing_satu', Auth::user()->dosen->id)->orWhere('id_pembimbing_dua', Auth::user()->dosen->id)->get();
        $mahasiswa = Mahasiswa::select('angkatan')->distinct()->whereHas('ta_satu', function ($query) {
            $query->where('id_pembimbing_satu', Auth::user()->dosen->id)
                ->orWhere('id_pembimbing_dua', Auth::user()->dosen->id)
                ->orWhere('id_pembahas', Auth::user()->dosen->id);
        })->orWhereHas('ta_dua', function ($query) {
            $query->where('id_pembimbing_satu', Auth::user()->dosen->id)
                ->orWhere('id_pembimbing_dua', Auth::user()->dosen->id)
                ->orWhere('id_pembahas', Auth::user()->dosen->id);
        })->orWhereHas('komprehensif', function ($query) {
            $query->where('id_pembimbing_satu', Auth::user()->dosen->id)
                ->orWhere('id_pembimbing_dua', Auth::user()->dosen->id)
                ->orWhere('id_pembahas', Auth::user()->dosen->id);
        })->get();
        return view('dosen.mahasiswa.bimbingan.kompre.index', compact('seminar', 'mahasiswa'));
    }
    public function export(Request $request)
    {
        $ta1 = Mahasiswa::with(['ta_satu.pembimbing_satu', 'ta_satu.pembimbing_dua', 'ta_satu.pembahas', 'ta_satu.jadwal', 'ta_satu.ba_seminar'])
            ->where('angkatan', $request->ta_unduh)->whereHas('ta_satu', function ($query) {
                $query->where('id_pembimbing_satu', Auth::user()->dosen->id)
                    ->orWhere('id_pembimbing_dua', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas', Auth::user()->dosen->id);
            })->get();
        $ta2 = Mahasiswa::with(['ta_dua.pembimbing_satu', 'ta_dua.pembimbing_dua', 'ta_dua.pembahas', 'ta_dua.jadwal', 'ta_dua.ba_seminar'])
            ->where('angkatan', $request->ta_unduh)->whereHas('ta_dua', function ($query) {
                $query->where('id_pembimbing_satu', Auth::user()->dosen->id)
                    ->orWhere('id_pembimbing_dua', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas', Auth::user()->dosen->id);
            })->get();
        $kompre = Mahasiswa::with(['komprehensif.pembimbingSatu', 'komprehensif.pembimbingDua', 'komprehensif.pembahas', 'komprehensif.jadwal', 'komprehensif.beritaAcara'])
            ->where('angkatan', $request->ta_unduh)->whereHas('komprehensif', function ($query) {
                $query->where('id_pembimbing_satu', Auth::user()->dosen->id)
                    ->orWhere('id_pembimbing_dua', Auth::user()->dosen->id)
                    ->orWhere('id_pembahas', Auth::user()->dosen->id);
            })->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Bimbingan TA 1');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Semester');
        $sheet->setCellValue('E1', 'Tahun Akademik');
        $sheet->setCellValue('F1', 'Judul Tugas Akhir');
        $sheet->setCellValue('G1', 'Pembimbing 1');
        $sheet->setCellValue('H1', 'Pembimbing 2');
        $sheet->setCellValue('I1', 'Pembahas');
        $sheet->setCellValue('J1', 'Tanggal Seminar');
        $sheet->setCellValue('K1', 'Nilai');
        $sheet->setCellValue('L1', 'Nilai Mutu');
        $sheet->setCellValue('M1', 'NO BA');
        $sheet->setCellValue('N1', 'Berita Acara');
        $sheet->setCellValue('O1', 'Status Admin');
        $sheet->setCellValue('P1', 'Status Koordinator');
        foreach ($ta1 as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->ta_satu->semester);
            $sheet->setCellValue('E' . ($key + 2), $value->ta_satu->tahun_akademik);
            $sheet->setCellValue('F' . ($key + 2), $value->ta_satu->judul_ta);
            $sheet->setCellValue('G' . ($key + 2), $value->ta_satu->pembimbing_satu->nama_dosen);
            if ($value->ta_satu->id_pembimbing_dua != null) {
                $sheet->setCellValue('H' . ($key + 2), $value->ta_satu->pembimbing_dua->nama_dosen);
            } else {
                $sheet->setCellValue('H' . ($key + 2), $value->ta_satu->pbl2_nama);
            }
            $sheet->setCellValue('I' . ($key + 2), $value->ta_satu->pembahas->nama_dosen);
            $sheet->setCellValue('J' . ($key + 2), ($value->ta_satu->jadwal != null) ? $value->ta_satu->jadwal->tanggal_seminar_ta_satu : '-');
            if ($value->ta_satu->ba_seminar) {
                $sheet->setCellValue('K' . ($key + 2), $value->ta_satu->ba_seminar->nilai);
                $sheet->setCellValue('L' . ($key + 2), $value->ta_satu->ba_seminar->huruf_mutu);
                $sheet->setCellValue('M' . ($key + 2), $value->ta_satu->ba_seminar->no_berkas_ba_seminar_ta_satu);
                $sheet->setCellValue('N' . ($key + 2), url('uploads/ba_seminar_ta_satu/' . $value->ta_satu->ba_seminar->berkas_ba_seminar_ta_satu));
            } else {
                $sheet->setCellValue('K' . ($key + 2), '-');
                $sheet->setCellValue('L' . ($key + 2), '-');
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
            }
            $sheet->setCellValue('O' . ($key + 2), $value->ta_satu->status_admin);
            $sheet->setCellValue('P' . ($key + 2), $value->ta_satu->status_koor);
        }
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Bimbingan TA 2');
        $sheet2->setCellValue('A1', 'No');
        $sheet2->setCellValue('B1', 'NPM');
        $sheet2->setCellValue('C1', 'Nama');
        $sheet2->setCellValue('D1', 'Semester');
        $sheet2->setCellValue('E1', 'Tahun Akademik');
        $sheet2->setCellValue('F1', 'Judul Tugas Akhir');
        $sheet2->setCellValue('G1', 'Pembimbing 1');
        $sheet2->setCellValue('H1', 'Pembimbing 2');
        $sheet2->setCellValue('I1', 'Pembahas');
        $sheet2->setCellValue('J1', 'Tanggal Seminar');
        $sheet2->setCellValue('K1', 'Nilai');
        $sheet2->setCellValue('L1', 'Nilai Mutu');
        $sheet2->setCellValue('M1', 'NO BA');
        $sheet2->setCellValue('N1', 'Berita Acara');
        $sheet2->setCellValue('O1', 'Status Admin');
        $sheet2->setCellValue('P1', 'Status Koordinator');
        foreach ($ta2 as $key => $value) {
            $sheet2->setCellValue('A' . ($key + 2), $key + 1);
            $sheet2->setCellValue('B' . ($key + 2), $value->npm);
            $sheet2->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet2->setCellValue('D' . ($key + 2), $value->ta_dua->semester);
            $sheet2->setCellValue('E' . ($key + 2), $value->ta_dua->tahun_akademik);
            $sheet2->setCellValue('F' . ($key + 2), $value->ta_dua->judul_ta);
            $sheet2->setCellValue('G' . ($key + 2), $value->ta_dua->pembimbing_satu->nama_dosen);
            if ($value->ta_dua->id_pembimbing_dua != null) {
                $sheet2->setCellValue('H' . ($key + 2), $value->ta_dua->pembimbing_dua->nama_dosen);
            } else {
                $sheet2->setCellValue('H' . ($key + 2), $value->ta_dua->pbl2_nama);
            }
            $sheet2->setCellValue('I' . ($key + 2), $value->ta_dua->pembahas->nama_dosen);
            $sheet2->setCellValue('J' . ($key + 2), ($value->ta_dua->jadwal != null) ? $value->ta_dua->jadwal->tanggal_seminar_ta_dua : '-');
            if ($value->ta_dua->ba_seminar) {
                $sheet2->setCellValue('K' . ($key + 2), $value->ta_dua->ba_seminar->nilai);
                $sheet2->setCellValue('L' . ($key + 2), $value->ta_dua->ba_seminar->huruf_mutu);
                $sheet2->setCellValue('M' . ($key + 2), $value->ta_dua->ba_seminar->no_berkas_ba_seminar_ta_dua);
                $sheet2->setCellValue('N' . ($key + 2), url('uploads/ba_seminar_ta_dua/' . $value->ta_dua->ba_seminar->berkas_ba_seminar_ta_dua));
            } else {
                $sheet2->setCellValue('K' . ($key + 2), '-');
                $sheet2->setCellValue('L' . ($key + 2), '-');
                $sheet2->setCellValue('M' . ($key + 2), '-');
                $sheet2->setCellValue('N' . ($key + 2), '-');
            }
            $sheet2->setCellValue('O' . ($key + 2), $value->ta_dua->status_admin);
            $sheet2->setCellValue('P' . ($key + 2), $value->ta_dua->status_koor);
        }
        $sheet3 = $spreadsheet->createSheet();
        $sheet3->setTitle('Bimbingan Komprehensif');
        $sheet3->setCellValue('A1', 'No');
        $sheet3->setCellValue('B1', 'NPM');
        $sheet3->setCellValue('C1', 'Nama');
        $sheet3->setCellValue('D1', 'Semester');
        $sheet3->setCellValue('E1', 'Tahun Akademik');
        $sheet3->setCellValue('F1', 'Judul Tugas Akhir');
        $sheet3->setCellValue('G1', 'Pembimbing 1');
        $sheet3->setCellValue('H1', 'Pembimbing 2');
        $sheet3->setCellValue('I1', 'Pembahas');
        $sheet3->setCellValue('J1', 'Tanggal Seminar');
        $sheet3->setCellValue('K1', 'Nilai');
        $sheet3->setCellValue('L1', 'Nilai Mutu');
        $sheet3->setCellValue('M1', 'NO BA');
        $sheet3->setCellValue('N1', 'Berita Acara');
        $sheet3->setCellValue('O1', 'Status Admin');
        $sheet3->setCellValue('P1', 'Status Koordinator');
        foreach ($kompre as $key => $value) {

            $sheet3->setCellValue('A' . ($key + 2), $key + 1);
            $sheet3->setCellValue('B' . ($key + 2), $value->npm);
            $sheet3->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet3->setCellValue('D' . ($key + 2), $value->komprehensif->semester);
            $sheet3->setCellValue('E' . ($key + 2), $value->komprehensif->tahun_akademik);
            $sheet3->setCellValue('F' . ($key + 2), $value->komprehensif->judul_ta);
            $sheet3->setCellValue('G' . ($key + 2), $value->komprehensif->pembimbingSatu->nama_dosen);
            if ($value->komprehensif->id_pembimbing_dua != null) {
                $sheet3->setCellValue('H' . ($key + 2), $value->komprehensif->pembimbingDua->nama_dosen);
            } else {
                $sheet3->setCellValue('H' . ($key + 2), $value->komprehensif->pbl2_nama);
            }
            $sheet3->setCellValue('I' . ($key + 2), $value->komprehensif->pembahas->nama_dosen);
            $sheet3->setCellValue('J' . ($key + 2), ($value->komprehensif->jadwal != null) ? $value->komprehensif->jadwal->tanggal_komprehensif : '-');
            if ($value->komprehensif->beritaAcara) {
                $sheet3->setCellValue('K' . ($key + 2), $value->komprehensif->beritaAcara->nilai);
                $sheet3->setCellValue('L' . ($key + 2), $value->komprehensif->beritaAcara->huruf_mutu);
                $sheet3->setCellValue('M' . ($key + 2), $value->komprehensif->beritaAcara->no_ba_berkas);
                $sheet3->setCellValue('N' . ($key + 2), url('uploads/ba_sidang_kompre/' . $value->komprehensif->beritaAcara->ba_seminar_komprehensif));
            } else {
                $sheet3->setCellValue('K' . ($key + 2), '-');
                $sheet3->setCellValue('L' . ($key + 2), '-');
                $sheet3->setCellValue('M' . ($key + 2), '-');
                $sheet3->setCellValue('N' . ($key + 2), '-');
            }
            $sheet3->setCellValue('O' . ($key + 2), $value->komprehensif->status_admin);
            $sheet3->setCellValue('P' . ($key + 2), $value->komprehensif->status_koor);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save("Bimbingan Tugas Akhir Angkatan{$request->ta_unduh}.xlsx");
        return response()->download(("Bimbingan Tugas Akhir Angkatan{$request->ta_unduh}.xlsx"))->deleteFileAfterSend(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('npm', $id)->first();
        $seminarTa1 = ModelSeminarTaSatu::where('id_mahasiswa', $mahasiswa->id)->first();
        $seminarTa2 = ModelSeminarTaDua::where('id_mahasiswa', $mahasiswa->id)->first();
        $sidangKompre = ModelSeminarKompre::where('id_mahasiswa', $mahasiswa->id)->first();
        $data = [
            'mahasiswa' => $mahasiswa,
            'seminarTa1' => $seminarTa1,
            'seminarTa2' => $seminarTa2,
            'sidangKompre' => $sidangKompre,
            'ba_ta1' => $seminarTa1 ? $seminarTa1->ba_seminar : null,
            'ba_ta2' => $seminarTa2 ? $seminarTa2->ba_seminar : null,
            'ba_kompre' => $sidangKompre ? $sidangKompre->beritaAcara : null,
            'prestasi' => $mahasiswa->prestasi,
            'aktivitas' => $mahasiswa->aktivitas,
        ];
        // return dd($data);
        return view('dosen.mahasiswa.bimbingan.kompre.show', $data);
    }
}
