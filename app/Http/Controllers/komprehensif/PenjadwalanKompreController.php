<?php

namespace App\Http\Controllers\komprehensif;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKompre;
use App\Jobs\SendEmailKomprehensif;
use App\Models\TemplateBeritaAcara;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarKompre;

class PenjadwalanKompreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $ba;

    public function __construct()
    {
        $this->ba = TemplateBeritaAcara::find(4);
    }

    public function index()
    {
        $data = [
            'seminar' => ModelSeminarKompre::select('id', 'encrypt_id', 'judul_ta', 'periode_seminar', 'id_mahasiswa')
                ->where('status_admin', 'Valid')
                ->whereDoesntHave('beritaAcara')
                ->get(),
        ];
        return view('koor.kompre.jadwal.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $id = array_key_last($request->except('_token'));

            $seminar =  ModelSeminarKompre::find(Crypt::decrypt($id));
            $data = [
                'locations' => Lokasi::all(),
                'seminar' => $seminar,
                'mahasiswa' => $seminar->mahasiswa,
            ];
            return view('koor.kompre.jadwal.create', $data);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Crypt::decrypt(array_key_last($request->except('_token')));
        $seminar = ModelSeminarKompre::find($id);
        $hari =  $hari = Carbon::parse($request->tanggal_skp)
            ->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')
            ->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')
            ->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $data = [
            'tanggal_komprehensif' => $request->tanggal_skp,
            'jam_mulai_komprehensif' => $request->jam_mulai_skp,
            'jam_selesai_komprehensif' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'id_seminar' => $id
        ];
        $insertJadwal = ModelJadwalSeminarKompre::create($data);
        $ins_id = $insertJadwal->id;
        $update = ModelJadwalSeminarKompre::find($ins_id);
        $update->encrypt_id = Crypt::encrypt($ins_id);
        $update->save();
        $mahasiswa = $seminar->mahasiswa;
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('pb_1', $seminar->pembimbingSatu->nama_dosen);
        $template->setValue('nip_pb_1', $seminar->pembimbingSatu->nip);
        if ($seminar->pembimbingDua) {
            $template->setValue('pb_2', $seminar->pembimbingDua->nama_dosen);
            $template->setValue('nip_pb_2', $seminar->pembimbingDua->nip);
        } else {
            $template->setValue('pb_2', $seminar->pbl2_nama);
            $template->setValue('pb_2', $seminar->pbl2_nip);
        }
        $template->setValue('pbhs', $seminar->pembahas->nama_dosen);
        $template->setValue('nip_pbhs', $seminar->pembahas->nip);
        $template->setValue('dospa', $mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_dospa', $mahasiswa->dosen->nip);
        $template->setValue('koor_acc', Auth::user()->name);
        $template->setValue('nip_koor_acc', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)
            ->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_kompre.docx';
        $template->saveAs('uploads/print_ba_kompre/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Sidang Komprehensif Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)
                ->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        dispatch(new SendEmailKomprehensif($data, $to_name, $to_email, $namafile));
        return redirect()->route('koor.jadwalKompre.index')
            ->with('success', 'Berhasil Menjadwalkan Sidang Komprehensif');
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
        $seminar =  ModelSeminarKompre::find(Crypt::decrypt($id));
        $data = [
            'locations' => Lokasi::all(),
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
            'jadwal' => $seminar->jadwal,
        ];
        return view('koor.kompre.jadwal.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seminar = ModelSeminarKompre::find(Crypt::decrypt($id));
        $mahasiswa = $seminar->mahasiswa;
        $admin = Administrasi::select('nama_administrasi', 'nip')
            ->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $hari =  $hari = Carbon::parse($request->tanggal_skp)
            ->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')
            ->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $data = [
            'tanggal_komprehensif' => $request->tanggal_skp,
            'jam_mulai_komprehensif' => $request->jam_mulai_skp,
            'jam_selesai_komprehensif' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'id_seminar' => Crypt::decrypt($id)
        ];
        $update = ModelJadwalSeminarKompre::where(
            'id_seminar',
            Crypt::decrypt($id)
        )->first();
        $update->update($data);
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('pb_1', $seminar->pembimbingSatu->nama_dosen);
        $template->setValue('nip_pb_1', $seminar->pembimbingSatu->nip);
        if ($seminar->pembimbingDua) {
            $template->setValue('pb_2', $seminar->pembimbingDua->nama_dosen);
            $template->setValue('nip_pb_2', $seminar->pembimbingDua->nip);
        } else {
            $template->setValue('pb_2', $seminar->pbl2_nama);
            $template->setValue('pb_2', $seminar->pbl2_nip);
        }
        $template->setValue('pbhs', $seminar->pembahas->nama_dosen);
        $template->setValue('nip_pbhs', $seminar->pembahas->nip);
        $template->setValue('dospa', $mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_dospa', $mahasiswa->dosen->nip);
        $template->setValue('koor_acc', Auth::user()->name);
        $template->setValue('nip_koor_acc', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)
            ->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $output  = ('uploads/print_ba_kompre/');
        $namafile = $mahasiswa->npm . '_ba_kompre.docx';
        $template->saveAs($output . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Sidang Komprehensif Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)
                ->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        dispatch(new SendEmailKomprehensif($data, $to_name, $to_email, $namafile));
        return redirect()->route('koor.jadwalKompre.index')
            ->with('success', 'Berhasil Merubah Jadwal Sidang Komprehensif');
    }

    public function resend($id)
    {
        $seminar =  ModelSeminarKompre::find(Crypt::decrypt($id));
        $mahasiswa = $seminar->mahasiswa;
        $jadwal_semianr = $seminar->jadwal;
        $admin = Administrasi::select('nama_administrasi', 'nip')
            ->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $hari =  $hari = Carbon::parse($jadwal_semianr->tanggal_komprehensif)
            ->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')
            ->where('id', $jadwal_semianr->id_lokasi)->first();
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('pb_1', $seminar->pembimbingSatu->nama_dosen);
        $template->setValue('nip_pb_1', $seminar->pembimbingSatu->nip);
        if ($seminar->pembimbingDua) {
            $template->setValue('pb_2', $seminar->pembimbingDua->nama_dosen);
            $template->setValue('nip_pb_2', $seminar->pembimbingDua->nip);
        } else {
            $template->setValue('pb_2', $seminar->pbl2_nama);
            $template->setValue('pb_2', $seminar->pbl2_nip);
        }
        $template->setValue('pbhs', $seminar->pembahas->nama_dosen);
        $template->setValue('nip_pbhs', $seminar->pembahas->nip);
        $template->setValue('dospa', $mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_dospa', $mahasiswa->dosen->nip);
        $template->setValue('koor_acc', Auth::user()->name);
        $template->setValue('nip_koor_acc', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($jadwal_semianr->tanggal_komprehensif)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $jadwal_semianr->jam_mulai_komprehensif);
        $template->setValue('jam_selesai', $jadwal_semianr->jam_selesai_komprehensif);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $output  = ('uploads/print_ba_kompre/');
        $namafile = $mahasiswa->npm . '_ba_kompre.docx';
        $template->saveAs($output . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Sidang Komprehensif Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($jadwal_semianr->tanggal_komprehensif)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $jadwal_semianr->jam_mulai_komprehensif,
            'jam_selesai' => $jadwal_semianr->jam_selesai_komprehensif,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Sidang Komprehensif');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_kompre/' . $namafile);
        });
        unlink('uploads/print_ba_kompre/' . $namafile);
        return redirect()->route('koor.jadwalKompre.index')->with('success', 'Berhasil Mengirim Ulang Jadwal Sidang Komprehensif');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return redirect()->back();
    }

    public function downloadJadwal()
    {
        $seminar = ModelSeminarKompre::with(
            'mahasiswa',
            'pembimbingSatu',
            'pembimbingDua',
            'pembahas'
        )->whereDoesntHave('jadwal')->where('status_admin', 'Valid')
            ->orderBy('updated_at', 'ASC')
            ->get();

        $spredsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spredsheet->getActiveSheet();
        $sheet->setTitle('Daftar Seminar TA 1 S1');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Mahasiswa');
        $sheet->setCellValue('C1', 'NPM');
        $sheet->setCellValue('D1', 'Judul TA');
        $sheet->setCellValue('E1', 'Pembimbing 1');
        $sheet->setCellValue('F1', 'Pembimbing 2');
        $sheet->setCellValue('G1', 'Pembahas');
        if ($seminar->count() > -0) {
            foreach ($seminar as $key => $value) {
                $sheet->setCellValue('A' . ($key + 2), $key + 1);
                $sheet->setCellValue('B' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
                $sheet->setCellValue('C' . ($key + 2), $value->mahasiswa->npm);
                $sheet->setCellValue('D' . ($key + 2), $value->judul_ta);
                $sheet->setCellValue('E' . ($key + 2), $value->pembimbingSatu->nama_dosen);
                if ($value->id_pembimbing_dua) {
                    $sheet->setCellValue('F' . ($key + 2), $value->pembimbingDua->nama_dosen);
                } else {
                    $sheet->setCellValue('F' . ($key + 2), $value->pbl2_nama);
                }
                $sheet->setCellValue('G' . ($key + 2), $value->pembahas->nama_dosen);
            }
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spredsheet);
            $filename = 'Daftar Pra-Penjadwalan Sidang Komprehensif S1.xlsx';
            $writer->save($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->with('error', 'Belum ada Sidang Komprehensif yang dapat dijadwalkan');
        }
    }

    public function pascaDownloadJadwal()
    {
        $seminar = ModelSeminarKompre::with(
            'mahasiswa',
            'pembimbingSatu',
            'pembimbingDua',
            'pembahas'
        )
            ->whereHas('jadwal', function ($query) {
                $query->whereDate('tanggal_komprehensif', '>=', date('Y-m-d'));
            })->where('status_admin', 'Valid')->orderBy('updated_at', 'asc')->get();
        if ($seminar->count() > 0) {
            $spredsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spredsheet->getActiveSheet();
            $sheet->setTitle('Daftar Seminar TA 1 S1');
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Mahasiswa');
            $sheet->setCellValue('C1', 'NPM');
            $sheet->setCellValue('D1', 'Judul TA');
            $sheet->setCellValue('E1', 'Pembimbing 1');
            $sheet->setCellValue('F1', 'Pembimbing 2');
            $sheet->setCellValue('G1', 'Pembahas');
            $sheet->setCellValue('H1', 'Tanggal Seminar');
            $sheet->setCellValue('I1', 'Jam Mulai');
            $sheet->setCellValue('J1', 'Jam Selesai');
            $sheet->setCellValue('K1', 'Lokasi');
            foreach ($seminar as $key => $value) {
                $sheet->setCellValue('A' . ($key + 2), $key + 1);
                $sheet->setCellValue('B' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
                $sheet->setCellValue('C' . ($key + 2), $value->mahasiswa->npm);
                $sheet->setCellValue('D' . ($key + 2), $value->judul_ta);
                $sheet->setCellValue('E' . ($key + 2), $value->pembimbingSatu->nama_dosen);
                if ($value->id_pembimbing_dua) {
                    $sheet->setCellValue('F' . ($key + 2), $value->pembimbingDua->nama_dosen);
                } else {
                    $sheet->setCellValue('F' . ($key + 2), $value->pbl2_nama);
                }
                $sheet->setCellValue('G' . ($key + 2), $value->pembahas->nama_dosen);
                $sheet->setCellValue('H' . ($key + 2), $value->jadwal->tanggal_seminar_ta_satu);
                $sheet->setCellValue('I' . ($key + 2), $value->jadwal->jam_mulai_seminar_ta_satu);
                $sheet->setCellValue('J' . ($key + 2), $value->jadwal->jam_selesai_seminar_ta_satu);
                $sheet->setCellValue('K' . ($key + 2), $value->jadwal->lokasi->nama_lokasi);
            }
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spredsheet);
            $filename = 'Daftar Pasca-Penjadwalan Sidang S1.xlsx';
            $writer->save($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->with('error', 'Belum ada Sidang Komprehensif yang dijadwalkan');
        }
    }
}
