<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LitabmasDosen;
use App\Http\Controllers\Controller;
use App\Models\AktivitasMahasiswa;
use App\Models\Mahasiswa;
use App\Models\PrestasiMahasiswa;
use App\Models\PublikasiDosen;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportData extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pengabdian' => LitabmasDosen::select('tahun_penelitian')->distinct()->orderBy('tahun_penelitian', 'desc')
                ->where('kategori', 'Pengabdian')
                ->get(),
            'penelitian' => LitabmasDosen::select('tahun_penelitian')->distinct()->orderBy('tahun_penelitian', 'desc')
                ->where('kategori', 'Penelitian')
                ->get(),
            'publikasi' => PublikasiDosen::select('tahun')->distinct()->orderBy('tahun', 'desc')
                ->get(),
            'prestasi' => PrestasiMahasiswa::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')
                ->get(),
            'aktivitas' => AktivitasMahasiswa::selectRaw('YEAR(tanggal) as year')->distinct()->orderBy('year', 'desc')
                ->get(),
            'mahasiswa' => Mahasiswa::select('angkatan')->distinct()->where('status', 'Aktif')->orderBy('angkatan', 'desc')
                ->get(),
            'alumni' => Mahasiswa::select('angkatan')->distinct()->where('status', 'Alumni')->orderBy('angkatan', 'desc')
                ->get(),
            'kp' => Mahasiswa::select('angkatan')->distinct()->whereHas('seminar_kp')->orderBy('angkatan', 'desc')
                ->get(),
            'ta1' => Mahasiswa::select('angkatan')->distinct()->whereHas('ta_satu')->orderBy('angkatan', 'desc')
                ->get(),
            'ta2' => Mahasiswa::select('angkatan')->distinct()->whereHas('ta_dua')->orderBy('angkatan', 'desc')
                ->get(),
            'kompre' => Mahasiswa::select('angkatan')->distinct()->whereHas('komprehensif')->orderBy('angkatan', 'desc')
                ->get(),
        ];
        return view('jurusan.export.index', $data);
    }

    public function kompre(Request $request)
    {
        $mahasiswa = Mahasiswa::whereHas('komprehensif')->where('angkatan', $request->akt_kompre)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar Komprehensif');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul Komprehensif');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas');
        $sheet->setCellValue('I1', 'Status Admin');
        $sheet->setCellValue('J1', 'Status Koordinator');
        $sheet->setCellValue('K1', 'Huruf Mutu');
        $sheet->setCellValue('L1', 'Nilai');
        $sheet->setCellValue('M1', 'No BA');
        $sheet->setCellValue('N1', 'URL');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->komprehensif->first()->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->komprehensif->first()->pembimbing_satu->nama_dosen);
            if ($value->komprehensif->first()->id_pembimbing_satu != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->komprehensif->first()->pembimbing_dua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->komprehensif->first()->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->komprehensif->first()->pembahas->nama_dosen);
            $sheet->setCellValue('I' . ($key + 2), $value->komprehensif->first()->status_admin);
            $sheet->setCellValue('J' . ($key + 2), $value->komprehensif->first()->status_koor);
            if ($value->komprehensif->beritaAcara) {
                $sheet->setCellValue('K' . ($key + 2), $value->komprehensif->first()->beritaAcara->huruf_mutu);
                $sheet->setCellValue('L' . ($key + 2), $value->komprehensif->first()->beritaAcara->nilai);
                $sheet->setCellValue('M' . ($key + 2), $value->komprehensif->first()->beritaAcara->no_ba_berkas);
                $sheet->setCellValue('N' . ($key + 2), url('/uploads/ba_sidang_kompre/' . $value->komprehensif->first()->beritaAcara->ba_seminar_komprehensif));
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_komprehensif' . $request->akt_kompre . '.xlsx');
        return response()->download('seminar_komprehensif' . $request->akt_kompre . '.xlsx')->deleteFileAfterSend(true);
    }

    public function ta2(Request $request)
    {
        $mahasiswa = Mahasiswa::whereHas('ta_dua')->where('angkatan', $request->akt_ta2)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar TA 2');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul TA 2');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas');
        $sheet->setCellValue('I1', 'Status Admin');
        $sheet->setCellValue('J1', 'Status Koordinator');
        $sheet->setCellValue('K1', 'Huruf Mutu');
        $sheet->setCellValue('L1', 'Nilai');
        $sheet->setCellValue('M1', 'No BA');
        $sheet->setCellValue('N1', 'URL');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->ta_dua->first()->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->ta_dua->first()->pembimbing_satu->nama_dosen);
            if ($value->ta_dua->first()->id_pembimbing_satu != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->ta_dua->first()->pembimbing_dua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->ta_dua->first()->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->ta_dua->first()->pembahas->nama_dosen);
            $sheet->setCellValue('I' . ($key + 2), $value->ta_dua->first()->status_admin);
            $sheet->setCellValue('J' . ($key + 2), $value->ta_dua->first()->status_koor);
            if ($value->ta_dua->first()->ba_seminar) {
                $sheet->setCellValue('K' . ($key + 2), $value->ta_dua->first()->ba_seminar->huruf_mutu);
                $sheet->setCellValue('L' . ($key + 2), $value->ta_dua->first()->ba_seminar->nilai);
                $sheet->setCellValue('M' . ($key + 2), $value->ta_dua->first()->ba_seminar->no_berkas_ba_seminar_ta_dua);
                $sheet->setCellValue('N' . ($key + 2), url('/uploads/ba_seminar_ta_dua/' . $value->ta_dua->first()->ba_seminar->berkas_ba_seminar_ta_dua));
            } else {
                $sheet->setCellValue('K' . ($key + 2), '-');
                $sheet->setCellValue('L' . ($key + 2), '-');
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_ta_2' . $request->akt_ta2 . '.xlsx');
        return response()->download('seminar_ta_2' . $request->akt_ta2 . '.xlsx')->deleteFileAfterSend(true);
    }



    public function ta1(Request $request)
    {
        $mahasiswa = Mahasiswa::whereHas('ta_satu')->where('angkatan', $request->akt_ta1)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Seminar TA 1');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Judul TA 1');
        $sheet->setCellValue('F1', 'Dosen Pembimbing 1');
        $sheet->setCellValue('G1', 'Dosen Pembimbing 2');
        $sheet->setCellValue('H1', 'Pembahas');
        $sheet->setCellValue('I1', 'Status Admin');
        $sheet->setCellValue('J1', 'Status Koordinator');
        $sheet->setCellValue('K1', 'Huruf Mutu');
        $sheet->setCellValue('L1', 'Nilai');
        $sheet->setCellValue('M1', 'No BA');
        $sheet->setCellValue('N1', 'URL');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->ta_satu->first()->judul_ta);
            $sheet->setCellValue('F' . ($key + 2), $value->ta_satu->first()->pembimbing_satu->nama_dosen);
            if ($value->ta_satu->first()->id_pembimbing_satu != null) {
                $sheet->setCellValue('G' . ($key + 2), $value->ta_satu->first()->pembimbing_dua->nama_dosen);
            } else {
                $sheet->setCellValue('G' . ($key + 2), $value->ta_satu->first()->pbl2_nama);
            }
            $sheet->setCellValue('H' . ($key + 2), $value->ta_satu->first()->pembahas->nama_dosen);
            $sheet->setCellValue('I' . ($key + 2), $value->ta_satu->first()->status_admin);
            $sheet->setCellValue('J' . ($key + 2), $value->ta_satu->first()->status_koor);
            if ($value->ta_satu->ba_seminar) {
                $sheet->setCellValue('K' . ($key + 2), $value->ta_satu->first()->ba_seminar->huruf_mutu);
                $sheet->setCellValue('L' . ($key + 2), $value->ta_satu->first()->ba_seminar->nilai);
                $sheet->setCellValue('M' . ($key + 2), $value->ta_satu->first()->ba_seminar->no_berkas_ba_seminar_ta_satu);
                $sheet->setCellValue('N' . ($key + 2), url('/uploads/ba_seminar_ta_satu/' . $value->ta_satu->first()->ba_seminar->berkas_ba_seminar_ta_satu));
            } else {
                $sheet->setCellValue('K' . ($key + 2), '-');
                $sheet->setCellValue('L' . ($key + 2), '-');
                $sheet->setCellValue('M' . ($key + 2), '-');
                $sheet->setCellValue('N' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('seminar_ta_1' . $request->akt_kp . '.xlsx');
        return response()->download('seminar_ta_1' . $request->akt_kp . '.xlsx')->deleteFileAfterSend(true);
    }

    public function kp(Request $request)
    {
        $mahasiswa = Mahasiswa::whereHas('seminar_kp')->where('angkatan', $request->akt_kp)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Kerja Praktik');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Tahun Akademik');
        $sheet->setCellValue('F1', 'Semester');
        $sheet->setCellValue('G1', 'Tema KP/PKL');
        $sheet->setCellValue('H1', 'Mitra');
        $sheet->setCellValue('I1', 'Region');
        $sheet->setCellValue('J1', 'Dosen Pembimbing');
        $sheet->setCellValue('K1', 'NP/NI/NIP Pembimbing Lapangan');
        $sheet->setCellValue('L1', 'Pembimbing Lapangan');
        $sheet->setCellValue('M1', 'Status Admin');
        $sheet->setCellValue('N1', 'Status Koordinator');
        $sheet->setCellValue('O1', 'Huruf Mutu');
        $sheet->setCellValue('P1', 'Nilai Angka');
        $sheet->setCellValue('Q1', 'No BA');
        $sheet->setCellValue('R1', 'URL');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->status);
            $sheet->setCellValue('E' . ($key + 2), $value->seminar_kp->tahun_akademik);
            $sheet->setCellValue('F' . ($key + 2), $value->seminar_kp->semester);
            $sheet->setCellValue('G' . ($key + 2), $value->seminar_kp->judul_kp);
            $sheet->setCellValue('H' . ($key + 2), $value->seminar_kp->mitra);
            $sheet->setCellValue('I' . ($key + 2), $value->seminar_kp->region);
            $sheet->setCellValue('J' . ($key + 2), $value->seminar_kp->dosen->nama_dosen);
            $sheet->setCellValue('K' . ($key + 2), $value->seminar_kp->ni_pemlap);
            $sheet->setCellValue('L' . ($key + 2), $value->seminar_kp->pembimbing_lapangan);
            $sheet->setCellValue('M' . ($key + 2), $value->seminar_kp->proses_admin);
            $sheet->setCellValue('N' . ($key + 2), $value->seminar_kp->status_seminar);
            if ($value->seminar_kp->berita_acara) {
                $sheet->setCellValue('O' . ($key + 2), $value->seminar_kp->berita_acara->nilai_mutu);
                $sheet->setCellValue('P' . ($key + 2), $value->seminar_kp->berita_acara->nilai_akhir);
                $sheet->setCellValue('Q' . ($key + 2), $value->seminar_kp->berita_acara->no_ba_seminar_kp);
                $sheet->setCellValue('R' . ($key + 2), url('/uploads/berita_acara_seminar_kp/' . $value->seminar_kp->berita_acara->berkas_ba_seminar_kp));
            } else {
                $sheet->setCellValue('O' . ($key + 2), '-');
                $sheet->setCellValue('P' . ($key + 2), '-');
                $sheet->setCellValue('Q' . ($key + 2), '-');
                $sheet->setCellValue('R' . ($key + 2), '-');
            }
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('kerja_praktik' . $request->akt_kp . '.xlsx');
        return response()->download('kerja_praktik' . $request->akt_kp . '.xlsx')->deleteFileAfterSend(true);
    }

    public function alumni(Request $request)
    {
        $mahasiswa = Mahasiswa::with(['seminar_kp', 'ta_satu', 'ta_dua', 'komprehensif'])->where('angkatan', $request->tahun_alumni)
            ->where('status', 'Alumni')
            ->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Alumni');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'Tempat Lahir');
        $sheet->setCellValue('F1', 'No HP');
        $sheet->setCellValue('G1', 'Alamat');
        $sheet->setCellValue('H1', 'Jenis Kelamin');
        $sheet->setCellValue('I1', 'Tanggal Masuk');
        $sheet->setCellValue('J1', 'Angkatan');
    }
    public function mahasiswa(Request $request)
    {
        $mahasiswa = Mahasiswa::with(['seminar_kp', 'ta_satu', 'ta_dua', 'komprehensif'])->where('angkatan', $request->tahun_mahasiswa)
            ->where('status', 'Aktif')
            ->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Mahasiswa');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPM');
        $sheet->setCellValue('C1', 'Nama Mahasiswa');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'Tempat Lahir');
        $sheet->setCellValue('F1', 'No HP');
        $sheet->setCellValue('G1', 'Alamat');
        $sheet->setCellValue('H1', 'Jenis Kelamin');
        $sheet->setCellValue('I1', 'Tanggal Masuk');
        $sheet->setCellValue('J1', 'Angkatan');
        $sheet->setCellValue('K1', 'Semester');
        $sheet->setCellValue('L1', 'Status');
        $sheet->setCellValue('M1', 'Dosen Pembimbing');
        $sheet->setCellValue('N1', 'Seminar KP/PKL');
        $sheet->setCellValue('O1', 'Seminar TA 1');
        $sheet->setCellValue('P1', 'Seminar TA 2');
        $sheet->setCellValue('Q1', 'Seminar Komprehensif');
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->npm);
            $sheet->setCellValue('C' . ($key + 2), $value->nama_mahasiswa);
            $sheet->setCellValue('D' . ($key + 2), $value->tanggal_lahir);
            $sheet->setCellValue('E' . ($key + 2), $value->tempat_lahir);
            $sheet->setCellValue('F' . ($key + 2), $value->no_hp);
            $sheet->setCellValue('G' . ($key + 2), $value->alamat);
            $sheet->setCellValue('H' . ($key + 2), $value->jenis_kelamin);
            $sheet->setCellValue('I' . ($key + 2), $value->tanggal_masuk);
            $sheet->setCellValue('J' . ($key + 2), $value->angkatan);
            $sheet->setCellValue('K' . ($key + 2), $value->semester);
            $sheet->setCellValue('L' . ($key + 2), $value->status);
            $sheet->setCellValue('M' . ($key + 2), $value->dosen->nama_dosen);
            $sheet->setCellValue('N' . ($key + 2), $value->seminar_kp ? $value->seminar_kp->status_seminar : '0');
            $sheet->setCellValue('O' . ($key + 2), $value->ta_satu->count() > 0 ? $value->ta_satu->status_koor : '0');
            $sheet->setCellValue('P' . ($key + 2), $value->ta_dua->count() > 0 ? $value->ta_dua->status_koor : '0');
            $sheet->setCellValue('Q' . ($key + 2), $value->komprehensif->count() > 0 ? $value->komprehensif->status_koor : '0');
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('mahasiswa' . $request->tahun_mahasiswa . '.xlsx');
        return response()->download('mahasiswa' . $request->tahun_mahasiswa . '.xlsx')->deleteFileAfterSend(true);
    }

    public function aktivitas(Request $request)
    {
        $aktivitas = AktivitasMahasiswa::with('mahasiswa')->whereYear('tanggal', $request->tahun_aktivitas)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Aktivitas Mahasiswa');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Aktivitas');
        $sheet->setCellValue('C1', 'Peran');
        $sheet->setCellValue('D1', 'SKS');
        $sheet->setCellValue('E1', 'Tanggal');
        $sheet->setCellValue('F1', 'URL');
        $sheet->setCellValue('G1', 'Mahasiswa');
        foreach ($aktivitas as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_aktivitas);
            $sheet->setCellValue('C' . ($key + 2), $value->peran);
            $sheet->setCellValue('D' . ($key + 2), $value->sks_konversi);
            $sheet->setCellValue('E' . ($key + 2), $value->tanggal);
            $sheet->setCellValue('F' . ($key + 2), url('/uploads/file_act_mhs/' . $value->file_aktivitas));
            $sheet->setCellValue('G' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('aktivitas' . $request->tahun_aktivitas . '.xlsx');
        return response()->download('aktivitas' . $request->tahun_aktivitas . '.xlsx')->deleteFileAfterSend(true);
    }
    public function prestasi(Request $request)
    {
        $prestasi = PrestasiMahasiswa::with('mahasiswa')->whereYear('tanggal', $request->tahun_prestasi)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Prestasi Mahasiswa');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Prestasi');
        $sheet->setCellValue('C1', 'Scala');
        $sheet->setCellValue('D1', 'Capaian');
        $sheet->setCellValue('E1', 'Tanggal');
        $sheet->setCellValue('F1', 'URL');
        $sheet->setCellValue('G1', 'Mahasiswa');
        foreach ($prestasi as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_prestasi);
            $sheet->setCellValue('C' . ($key + 2), $value->scala);
            $sheet->setCellValue('D' . ($key + 2), $value->capaian);
            $sheet->setCellValue('E' . ($key + 2), $value->tanggal);
            $sheet->setCellValue('F' . ($key + 2), url('/uploads/file_prestasi/' . $value->file_prestasi));
            $sheet->setCellValue('G' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('prestasi' . $request->tahun_prestasi . '.xlsx');
        return response()->download('prestasi' . $request->tahun_prestasi . '.xlsx')->deleteFileAfterSend(true);
    }

    public function penelitian(Request $request)
    {
        $penelitian = LitabmasDosen::with('anggota_litabmas')->where('tahun_penelitian', $request->tahun_penelitian)->where('kategori', 'Penelitian')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Penelitian Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Penelitian');
        $sheet->setCellValue('C1', 'Sumber Dana');
        $sheet->setCellValue('D1', 'Jumlah Dana');
        $sheet->setCellValue('E1', 'Tahun Penelitian');
        $sheet->setCellValue('F1', 'Anggota');
        $sheet->setCellValue('G1', 'Anggota External');
        foreach ($penelitian as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_litabmas);
            $sheet->setCellValue('C' . ($key + 2), $value->sumber_dana);
            $sheet->setCellValue('D' . ($key + 2), $value->jumlah_dana);
            $sheet->setCellValue('E' . ($key + 2), $value->tahun_penelitian);
            $sheet->setCellValue('F' . ($key + 2), $value->dosen->pluck('nama_dosen')->implode(', '));
            $sheet->setCellValue('G' . ($key + 2), $value->anggota_external);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('penelitian.xlsx');
        return response()->download('penelitian.xlsx')->deleteFileAfterSend(true);
    }
    public function pengabdian(Request $request)
    {
        $penelitian = LitabmasDosen::with('anggota_litabmas')->where('tahun_penelitian', $request->tahun_pengabdian)->where('kategori', 'Pengabdian')->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Pengabdian Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Penelitian');
        $sheet->setCellValue('C1', 'Sumber Dana');
        $sheet->setCellValue('D1', 'Jumlah Dana');
        $sheet->setCellValue('E1', 'Tahun Penelitian');
        $sheet->setCellValue('F1', 'Anggota');
        $sheet->setCellValue('G1', 'Anggota External');
        foreach ($penelitian as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_litabmas);
            $sheet->setCellValue('C' . ($key + 2), $value->sumber_dana);
            $sheet->setCellValue('D' . ($key + 2), $value->jumlah_dana);
            $sheet->setCellValue('E' . ($key + 2), $value->tahun_penelitian);
            $sheet->setCellValue('F' . ($key + 2), $value->dosen->pluck('nama_dosen')->implode(', '));
            $sheet->setCellValue('G' . ($key + 2), $value->anggota_external);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('pengabdian.xlsx');
        return response()->download('pengabdian.xlsx')->deleteFileAfterSend(true);
    }
    public function publikasi(Request $request)
    {
        $publikasi = PublikasiDosen::with('anggotaPublikasi')->where('tahun', $request->tahun_publikasi)->get();
        $spdsheet = new Spreadsheet();
        $sheet = $spdsheet->getActiveSheet();
        $sheet->setTitle('Publikasi Dosen');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Publikasi');
        $sheet->setCellValue('C1', 'Volume');
        $sheet->setCellValue('D1', 'Halaman');
        $sheet->setCellValue('E1', 'Judul');
        $sheet->setCellValue('F1', 'Tahun');
        $sheet->setCellValue('G1', 'Scala');
        $sheet->setCellValue('H1', 'Kategori');
        $sheet->setCellValue('I1', 'Kategori Litabmas');
        $sheet->setCellValue('J1', 'URL');
        $sheet->setCellValue('K1', 'Anggota');
        $sheet->setCellValue('L1', 'Anggota External');
        foreach ($publikasi as $key => $value) {
            $sheet->setCellValue('A' . ($key + 2), $key + 1);
            $sheet->setCellValue('B' . ($key + 2), $value->nama_publikasi);
            $sheet->setCellValue('C' . ($key + 2), $value->vol);
            $sheet->setCellValue('D' . ($key + 2), $value->halaman);
            $sheet->setCellValue('E' . ($key + 2), $value->judul);
            $sheet->setCellValue('F' . ($key + 2), $value->tahun);
            $sheet->setCellValue('G' . ($key + 2), $value->scala);
            $sheet->setCellValue('H' . ($key + 2), $value->kategori);
            $sheet->setCellValue('I' . ($key + 2), $value->kategori_litabmas);
            $sheet->setCellValue('J' . ($key + 2), $value->url);
            $sheet->setCellValue('K' . ($key + 2), $value->dosen->pluck('nama_dosen')->implode(', '));
            $sheet->setCellValue('L' . ($key + 2), $value->anggota_external);
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spdsheet);
        $writer->save('publikasi.xlsx');
        return response()->download('publikasi.xlsx')->deleteFileAfterSend(true);
    }
}
