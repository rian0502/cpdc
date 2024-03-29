<?php

namespace App\Http\Controllers\tugas_akhir_satu;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Mahasiswa;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use App\Jobs\SendEmailTugasAkhir1;
use App\Models\ModelSeminarTaSatu;
use App\Models\TemplateBeritaAcara;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaSatu;

class PenjadwalanTaSatu extends Controller
{
    //koor
    private $ba;

    public function __construct()
    {
        $this->ba = TemplateBeritaAcara::find(2);
    }

    public function index()
    {
        $now = date('Y-m-d');
        $data = [
            'seminar' => ModelSeminarTaSatu::select('id', 'encrypt_id', 'judul_ta', 'periode_seminar', 'id_mahasiswa')
                ->with('mahasiswa', 'jadwal')
                ->whereDoesntHave('ba_seminar')
                ->where('status_admin', 'Valid')
                ->where(function ($query) use ($now) {
                    $query->whereDoesntHave('jadwal')
                        ->orWhereHas('jadwal', function ($query) use ($now) {
                            $query->whereDate('tanggal_seminar_ta_satu', '>=', $now);
                        });
                })
                ->orderBy('updated_at', 'desc')
                ->get(),
        ];
        return view('koor.ta1.jadwal.index', $data);
    }

    public function create(Request $request)
    {
        try {
            $id = array_key_last($request->except('_token'));

            $seminar =  ModelSeminarTaSatu::find(Crypt::decrypt($id));
            $data = [
                'locations' => Lokasi::all(),
                'seminar' => $seminar,
                'mahasiswa' => $seminar->mahasiswa,
            ];
            return view('koor.ta1.jadwal.create', $data);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {

        $id = Crypt::decrypt(array_key_last($request->except('_token')));
        $hari =  $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $data = [
            'tanggal_seminar_ta_satu' => $request->tanggal_skp,
            'jam_mulai_seminar_ta_satu' => $request->jam_mulai_skp,
            'jam_selesai_seminar_ta_satu' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'id_seminar' => $id
        ];
        $insertJadwal = ModelJadwalSeminarTaSatu::create($data);
        $ins_id = $insertJadwal->id;
        $update = ModelJadwalSeminarTaSatu::find($ins_id);
        $update->encrypt_id = Crypt::encrypt($ins_id);
        $update->save();
        $seminar = ModelSeminarTaSatu::find($id);
        $mahasiswa = $seminar->mahasiswa;
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('pb_1', $seminar->pembimbing_satu->nama_dosen);
        $template->setValue('nip_pb_1', $seminar->pembimbing_satu->nip);

        if ($seminar->pembimbing_dua) {
            $template->setValue('pb_2', $seminar->pembimbing_dua->nama_dosen);
            $template->setValue('nip_pb_2', $seminar->pembimbing_dua->nip);
        } else {
            $template->setValue('pb_2', $seminar->pbl2_nama);
            $template->setValue('nip_pb_2', $seminar->pbl2_nip);
        }
        $template->setValue('pbhs', $seminar->pembahas->nama_dosen);
        $template->setValue('nip_pbhs', $seminar->pembahas->nip);
        $template->setValue('dospa', $mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_dospa', $mahasiswa->dosen->nip);
        $template->setValue('koor_acc', Auth::user()->name);
        $template->setValue('nip_koor_acc', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_ta1.docx';
        $template->saveAs('uploads/print_ba_ta1/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tugas Akhir 1 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];

        dispatch(new SendEmailTugasAkhir1($data, $to_name, $to_email, $namafile));
        
        return redirect()->route('koor.jadwalTA1.index')->with(
            'success',
            'Berhasil Menjadwalkan Seminar Tugas Akhir 1'
        );
    }
    public function edit($id)
    {
        $seminar = ModelSeminarTaSatu::find(Crypt::decrypt($id));
        $mahasiswa = Mahasiswa::find($seminar->id_mahasiswa);
        $data = [
            'seminar' => $seminar,
            'jadwal' => $seminar->jadwal,
            'mahasiswa' => $mahasiswa,
            'locations' => Lokasi::all(),
        ];

        return view('koor.ta1.jadwal.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $seminar = ModelSeminarTaSatu::find(Crypt::decrypt($id));
        $mahasiswa = $seminar->mahasiswa;
        $hari =  $hari = Carbon::parse($request->tanggal_skp)
            ->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')
            ->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')
            ->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $data = [
            'tanggal_seminar_ta_satu' => $request->tanggal_skp,
            'jam_mulai_seminar_ta_satu' => $request->jam_mulai_skp,
            'jam_selesai_seminar_ta_satu' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
        ];
        ModelJadwalSeminarTaSatu::where('id_seminar', $seminar->id)->update($data);
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('pb_1', $seminar->pembimbing_satu->nama_dosen);
        $template->setValue('nip_pb_1', $seminar->pembimbing_satu->nip);
        if ($seminar->pembimbing_dua) {
            $template->setValue('pb_2', $seminar->pembimbing_dua->nama_dosen);
            $template->setValue('nip_pb_2', $seminar->pembimbing_dua->nip);
        } else {
            $template->setValue('pb_2', $seminar->pbl2_nama);
            $template->setValue('nip_pb_2', $seminar->pbl2_nip);
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
        $namafile = $mahasiswa->npm . '_ba_ta1.docx';
        $template->saveAs('uploads/print_ba_ta1/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tugas Akhir 1 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)
                ->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Tugas Akhir 1');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_ta1/' . $namafile);
        });
        unlink('uploads/print_ba_ta1/' . $namafile);
        return redirect()->route('koor.jadwalTA1.index')
            ->with('success', 'Berhasil Menjadwalkan Ulang Seminar Tugas Akhir 1');
    }

    public function resend($id)
    {
        $seminar = ModelSeminarTaSatu::find(Crypt::decrypt($id));
        $mahasiswa = $seminar->mahasiswa;
        $jadwal = $seminar->jadwal;
        $hari =  $hari = Carbon::parse($jadwal->tanggal_seminar_ta_satu)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', $jadwal->id_lokasi)->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('pb_1', $seminar->pembimbing_satu->nama_dosen);
        $template->setValue('nip_pb_1', $seminar->pembimbing_satu->nip);

        if ($seminar->pembimbing_dua) {
            $template->setValue('pb_2', $seminar->pembimbing_dua->nama_dosen);
            $template->setValue('nip_pb_2', $seminar->pembimbing_dua->nip);
        } else {
            $template->setValue('pb_2', $seminar->pbl2_nama);
            $template->setValue('nip_pb_2', $seminar->pbl2_nip);
        }
        $template->setValue('pbhs', $seminar->pembahas->nama_dosen);
        $template->setValue('nip_pbhs', $seminar->pembahas->nip);
        $template->setValue('dospa', $mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_dospa', $mahasiswa->dosen->nip);
        $template->setValue('koor_acc', Auth::user()->name);
        $template->setValue('nip_koor_acc', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($jadwal->tanggal_seminar_ta_satu)
            ->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $jadwal->jam_mulai_seminar_ta_satu);
        $template->setValue('jam_selesai', $jadwal->jam_selesai_seminar_ta_satu);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_ta1.docx';
        $template->saveAs('uploads/print_ba_ta1/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tugas Akhir 1 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($jadwal->tanggal_seminar_ta_satu)
                ->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $jadwal->jam_mulai_seminar_ta_satu,
            'jam_selesai' => $jadwal->jam_selesai_seminar_ta_satu,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Tugas Akhir 1');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_ta1/' . $namafile);
        });
        unlink(('uploads/print_ba_ta1/' . $namafile));
        return redirect()->route('koor.jadwalTA1.index')
            ->with('success', 'Berhasil Mengirim Ulang Jadwal Seminar Tugas Akhir 1');
    }

    public function downloadJadwal()
    {
        $seminar = ModelSeminarTaSatu::with('mahasiswa', 'pembimbing_satu', 'pembimbing_dua', 'pembahas')
            ->whereDoesntHave('jadwal')->where('status_admin', 'Valid')->orderBy('updated_at', 'asc')->get();
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
        $sheet->setCellValue('H1', 'Tanggal Validasi');
        if ($seminar->count() > 0) {
            foreach ($seminar as $key => $value) {
                $sheet->setCellValue('A' . ($key + 2), $key + 1);
                $sheet->setCellValue('B' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
                $sheet->setCellValue('C' . ($key + 2), $value->mahasiswa->npm);
                $sheet->setCellValue('D' . ($key + 2), $value->judul_ta);
                $sheet->setCellValue('E' . ($key + 2), $value->pembimbing_satu->nama_dosen);
                if ($value->id_pembimbing_dua) {
                    $sheet->setCellValue('F' . ($key + 2), $value->pembimbing_dua->nama_dosen);
                } else {
                    $sheet->setCellValue('F' . ($key + 2), $value->pbl2_nama);
                }
                $sheet->setCellValue('G' . ($key + 2), $value->pembahas->nama_dosen);
                $sheet->setCellValue('H' . ($key + 2), $value->updated_at->isoFormat('D MMMM Y'));
            }
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spredsheet);
            $filename = 'Daftar Pra-Penjadwalan Seminar TA 1 S1.xlsx';
            $writer->save($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()
                ->with('error', 'Belum ada Seminar TA 1 yang dapat dijadwalkan');
        }
    }
    public function pascaDownloadJadwal()
    {
        $seminar = ModelSeminarTaSatu::with('mahasiswa', 'pembimbing_satu', 'pembimbing_dua', 'pembahas')
            ->whereHas('jadwal', function ($query) {
                $query->whereDate('tanggal_seminar_ta_satu', '>=', date('Y-m-d'));
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
                $sheet->setCellValue('E' . ($key + 2), $value->pembimbing_satu->nama_dosen);
                if ($value->id_pembimbing_dua) {
                    $sheet->setCellValue('F' . ($key + 2), $value->pembimbing_dua->nama_dosen);
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
            $filename = 'Daftar Pasca-Penjadwalan Seminar TA 1 S1.xlsx';
            $writer->save($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()
                ->with('error', 'Belum ada Seminar TA 1 yang dapat dijadwalkan');
        }
    }
}
