<?php

namespace App\Http\Controllers\mahasiswa_s2\ta2;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDuaS2;
use App\Models\TemplateBeritaAcara;
use App\Http\Controllers\Controller;
use App\Models\ModelJadwalSeminarTaDuaS2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class ControllerKoorS2PenjadwalanTaDua extends Controller
{


    private $ba;

    public function __construct()
    {
        $this->ba = TemplateBeritaAcara::find(6);
    }

    public function index()
    {
        $now = date('Y-m-d');
        $seminar = ModelSeminarTaDuaS2::with('jadwal')
            ->whereDoesntHave('beritaAcara')
            ->where('status_admin', 'Valid')
            ->where(function ($query) use ($now) {
                $query->whereDoesntHave('jadwal')
                    ->orWhereHas('jadwal', function ($query) use ($now) {
                        $query->whereDate('tanggal', '>=', $now);
                    });
            })->get();
        return View('koorS2.tesis2.jadwal.index', compact('seminar'));
    }

    public function create(Request $request)
    {
        $id = array_key_last($request->except('_token'));
        $seminar = ModelSeminarTaDuaS2::find(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
            'locations' => Lokasi::where('jenis_ruangan', 'Kelas')->get(),
        ];
        return View('koorS2.tesis2.jadwal.create', $data);
    }

    public function store(Request $request)
    {
        $id = Crypt::decrypt(array_key_last($request->except('_token')));
        $hari =  $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('kaprodiS2')->with('dosen')->first();
        $data = [
            'tanggal' => $request->tanggal_skp,
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'id_seminar' => $id
        ];
        $insertJadwal = ModelJadwalSeminarTaDuaS2::create($data);
        $ins_id = $insertJadwal->id;
        $update = ModelJadwalSeminarTaDuaS2::find($ins_id);
        $update->encrypt_id = Crypt::encrypt($ins_id);
        $update->save();
        $seminar = ModelSeminarTaDuaS2::find($id);
        $mahasiswa = $seminar->mahasiswa;
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kaprodi_s2', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kaprodi_s2', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('nama_pembimbing_1', $seminar->pembimbingSatu->nama_dosen);
        $template->setValue('nip_pembimbing_1', $seminar->pembimbingSatu->nip);
        if ($seminar->id_pembimbing_2) {
            $template->setValue('nama_pembimbing_2', $seminar->pembimbingDua->nama_dosen);
            $template->setValue('nip_pembimbing_2', $seminar->pembimbingDua->nip);
        } else {
            $template->setValue('nama_pembimbing_2', $seminar->pbl2_nama);
            $template->setValue('nip_pembimbing_2', $seminar->pbl2_nip);
        }
        if ($seminar->id_pembahas_1) {
            $template->setValue('nama_pembahas_1', $seminar->pembahasSatu->nama_dosen);
            $template->setValue('nip_pembahas_1', $seminar->pembahasSatu->nip);
        } else {
            $template->setValue('nama_pembahas_1', $seminar->pembahas_external_1);
            $template->setValue('nip_pembahas_1', $seminar->nip_pembahas_external_1);
        }
        if ($seminar->id_pembahas_2) {
            $template->setValue('nama_pembahas_2', $seminar->pembahasDua->nama_dosen);
            $template->setValue('nip_pembahas_2', $seminar->pembahasDua->nip);
        } else {
            $template->setValue('nama_pembahas_2', $seminar->pembahas_external_2);
            $template->setValue('nip_pembahas_2', $seminar->nip_pembahas_external_2);
        }
        if ($seminar->id_pembahas_3) {
            $template->setValue('nama_pembahas_3', $seminar->pembahasTiga->nama_dosen);
            $template->setValue('nip_pembahas_3', $seminar->pembahasTiga->nip);
        } else {
            $template->setValue('nama_pembahas_3', $seminar->pembahas_external_3);
            $template->setValue('nip_pembahas_3', $seminar->nip_pembahas_external_3);
        }
        $template->setValue('nama_koor_ta2', Auth::user()->name);
        $template->setValue('nip_koor_ta2', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('nama_lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_tesis_2.docx';
        $template->saveAs('uploads/print_ba_tesis_2/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tesis 2 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Tesis 2');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_tesis_2/' . $namafile);
        });
        unlink('uploads/print_ba_tesis_2/' . $namafile);
        return redirect()->route('koor.jadwalTA2S2.index')->with('success', 'Berhasil Menjadwalkan Seminar Tesis 2');
    }


    public function resend($id)
    {
        $seminar = ModelSeminarTaDuaS2::with(['jadwal', 'mahasiswa'])->where('id', Crypt::decrypt($id))->first();
        $jadwal = $seminar->jadwal;
        $mahasiswa = $seminar->mahasiswa;
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', $jadwal->id_lokasi)->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $hari = Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('dddd');
        $kajur = User::role('kaprodiS2')->with('dosen')->first();
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kaprodi_s2', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kaprodi_s2', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('nama_pembimbing_1', $seminar->pembimbingSatu->nama_dosen);
        $template->setValue('nip_pembimbing_1', $seminar->pembimbingSatu->nip);
        if ($seminar->id_pembimbing_2) {
            $template->setValue('nama_pembimbing_2', $seminar->pembimbingDua->nama_dosen);
            $template->setValue('nip_pembimbing_2', $seminar->pembimbingDua->nip);
        } else {
            $template->setValue('nama_pembimbing_2', $seminar->pbl2_nama);
            $template->setValue('nip_pembimbing_2', $seminar->pbl2_nip);
        }
        if ($seminar->id_pembahas_1) {
            $template->setValue('nama_pembahas_1', $seminar->pembahasSatu->nama_dosen);
            $template->setValue('nip_pembahas_1', $seminar->pembahasSatu->nip);
        } else {
            $template->setValue('nama_pembahas_1', $seminar->pembahas_external_1);
            $template->setValue('nip_pembahas_1', $seminar->nip_pembahas_external_1);
        }
        if ($seminar->id_pembahas_2) {
            $template->setValue('nama_pembahas_2', $seminar->pembahasDua->nama_dosen);
            $template->setValue('nip_pembahas_2', $seminar->pembahasDua->nip);
        } else {
            $template->setValue('nama_pembahas_2', $seminar->pembahas_external_2);
            $template->setValue('nip_pembahas_2', $seminar->nip_pembahas_external_2);
        }
        if ($seminar->id_pembahas_3) {
            $template->setValue('nama_pembahas_3', $seminar->pembahasTiga->nama_dosen);
            $template->setValue('nip_pembahas_3', $seminar->pembahasTiga->nip);
        } else {
            $template->setValue('nama_pembahas_3', $seminar->pembahas_external_3);
            $template->setValue('nip_pembahas_3', $seminar->nip_pembahas_external_3);
        }
        $template->setValue('nama_koor_ta2', Auth::user()->name);
        $template->setValue('nip_koor_ta2', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $jadwal->jam_mulai);
        $template->setValue('jam_selesai', $jadwal->jam_selesai);
        $template->setValue('nama_lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_tesis_2.docx';
        $template->saveAs('uploads/print_ba_tesis_2/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tesis 2 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $jadwal->jam_mulai,
            'jam_selesai' => $jadwal->jam_selesai,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Tesis 2');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_tesis_2/' . $namafile);
        });
        unlink('uploads/print_ba_tesis_2/' . $namafile);
        return redirect()->route('koor.jadwalTA2S2.index')->with('success', 'Berhasil Mengirim Ulang Jadwal Seminar Tesis 2');
    }


    public function edit($id)
    {
        $seminar = ModelSeminarTaDuaS2::findOrFail(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
            'locations' => Lokasi::where('jenis_ruangan', 'Kelas')->get(),
            'jadwal' => $seminar->jadwal,
        ];
        return View('koorS2.tesis2.jadwal.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $hari =  $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('kaprodiS2')->with('dosen')->first();
        $seminar = ModelSeminarTaDuaS2::find($id);
        $jadwal = ModelJadwalSeminarTaDuaS2::where('id_seminar', $id)->first();
        $jadwal->tanggal = $request->tanggal_skp;
        $jadwal->jam_mulai = $request->jam_mulai_skp;
        $jadwal->jam_selesai = $request->jam_selesai_skp;
        $jadwal->id_lokasi = Crypt::decrypt($request->id_lokasi);
        $jadwal->updated_at = date('Y-m-d H:i:s');
        $jadwal->save();
        $mahasiswa = $seminar->mahasiswa;
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kaprodi_s2', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kaprodi_s2', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_ta', $seminar->judul_ta);
        $template->setValue('nama_pembimbing_1', $seminar->pembimbingSatu->nama_dosen);
        $template->setValue('nip_pembimbing_1', $seminar->pembimbingSatu->nip);
        if ($seminar->id_pembimbing_2) {
            $template->setValue('nama_pembimbing_2', $seminar->pembimbingDua->nama_dosen);
            $template->setValue('nip_pembimbing_2', $seminar->pembimbingDua->nip);
        } else {
            $template->setValue('nama_pembimbing_2', $seminar->pbl2_nama);
            $template->setValue('nip_pembimbing_2', $seminar->pbl2_nip);
        }
        if ($seminar->id_pembahas_1) {
            $template->setValue('nama_pembahas_1', $seminar->pembahasSatu->nama_dosen);
            $template->setValue('nip_pembahas_1', $seminar->pembahasSatu->nip);
        } else {
            $template->setValue('nama_pembahas_1', $seminar->pembahas_external_1);
            $template->setValue('nip_pembahas_1', $seminar->nip_pembahas_external_1);
        }
        if ($seminar->id_pembahas_2) {
            $template->setValue('nama_pembahas_2', $seminar->pembahasDua->nama_dosen);
            $template->setValue('nip_pembahas_2', $seminar->pembahasDua->nip);
        } else {
            $template->setValue('nama_pembahas_2', $seminar->pembahas_external_2);
            $template->setValue('nip_pembahas_2', $seminar->nip_pembahas_external_2);
        }
        if ($seminar->id_pembahas_3) {
            $template->setValue('nama_pembahas_3', $seminar->pembahasTiga->nama_dosen);
            $template->setValue('nip_pembahas_3', $seminar->pembahasTiga->nip);
        } else {
            $template->setValue('nama_pembahas_3', $seminar->pembahas_external_3);
            $template->setValue('nip_pembahas_3', $seminar->nip_pembahas_external_3);
        }
        $template->setValue('nama_koor_ta2', Auth::user()->name);
        $template->setValue('nip_koor_ta2', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('nama_lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_tesis_2.docx';
        $template->saveAs('uploads/print_ba_tesis_2/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tesis 2 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Tesis 2');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_tesis_2/' . $namafile);
        });
        unlink('uploads/print_ba_tesis_2/' . $namafile);
        return redirect()->route('koor.jadwalTA2S2.index')->with('success', 'Berhasil Menjadwalkan Ulang Seminar Tesis 2');
    }
    public function downloadJadwal()
    {
        $seminar = ModelSeminarTaDuaS2::with(
            'mahasiswa',
            'pembimbingSatu',
            'pembimbingDua',
            'pembahasSatu',
            'pembahasDua',
            'pembahasTiga'
        )->whereDoesntHave('jadwal')
            ->where('status_admin', 'Valid')
            ->orderBy('updated_at', 'asc')->get();

        $spredsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spredsheet->getActiveSheet();
        $sheet->setTitle('Daftar Seminar Tesis 2');
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Mahasiswa');
        $sheet->setCellValue('C1', 'NPM');
        $sheet->setCellValue('D1', 'Judul TA');
        $sheet->setCellValue('E1', 'Pembimbing 1');
        $sheet->setCellValue('F1', 'Pembimbing 2');
        $sheet->setCellValue('G1', 'Pembahas 1');
        $sheet->setCellValue('H1', 'Pembahas 2');
        $sheet->setCellValue('I1', 'Pembahas 3');
        if ($seminar->count() > 0) {
            foreach ($seminar as $key => $value) {
                $sheet->setCellValue('A' . ($key + 2), $key + 1);
                $sheet->setCellValue('B' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
                $sheet->setCellValue('C' . ($key + 2), $value->mahasiswa->npm);
                $sheet->setCellValue('D' . ($key + 2), $value->judul_ta);
                $sheet->setCellValue('E' . ($key + 2), $value->pembimbingSatu->nama_dosen);
                if ($value->id_pembimbing_2) {
                    $sheet->setCellValue('F' . ($key + 2), $value->pembimbingDua->nama_dosen);
                } else {
                    $sheet->setCellValue('F' . ($key + 2), $value->pbl2_nama);
                }
                if ($value->id_pembahas_1) {
                    $sheet->setCellValue('G' . ($key + 2), $value->pembahasSatu->nama_dosen);
                } else {
                    $sheet->setCellValue('G' . ($key + 2), $value->pembahas_external_1);
                }
                if ($value->id_pembahas_2) {
                    $sheet->setCellValue('H' . ($key + 2), $value->pembahasDua->nama_dosen);
                } else {
                    $sheet->setCellValue('H' . ($key + 2), $value->pembahas_external_2);
                }
                if ($value->id_pembahas_3) {
                    $sheet->setCellValue('I' . ($key + 2), $value->pembahasTiga->nama_dosen);
                } else {
                    $sheet->setCellValue('I' . ($key + 2), $value->pembahas_external_3);
                }
            }
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spredsheet);
            $filename = 'Daftar Pra-Penjadwalan Seminar Tesis 2.xlsx';
            $writer->save($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()
                ->with('error', 'Belum ada Seminar Tesis 2 yang dapat dijadwalkan');
        }
    }
    public function pascaDownloadJadwal()
    {
        $seminar = ModelSeminarTaDuaS2::with(
            'mahasiswa',
            'pembimbingSatu',
            'pembimbingDua',
            'pembahasSatu',
            'pembahasDua',
            'pembahasTiga'
        )
            ->whereHas('jadwal', function ($query) {
                $query->whereDate('tanggal', '>=', date('Y-m-d'));
            })->where('status_admin', 'Valid')->orderBy('updated_at', 'asc')->get();
        if ($seminar->count() > 0) {
            $spredsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spredsheet->getActiveSheet();
            $sheet->setTitle('Daftar Seminar Tesis 2');
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Mahasiswa');
            $sheet->setCellValue('C1', 'NPM');
            $sheet->setCellValue('D1', 'Judul TA');
            $sheet->setCellValue('E1', 'Pembimbing 1');
            $sheet->setCellValue('F1', 'Pembimbing 2');
            $sheet->setCellValue('G1', 'Pembahas 1');
            $sheet->setCellValue('H1', 'Pembahas 2');
            $sheet->setCellValue('I1', 'Pembahas 3');
            $sheet->setCellValue('J1', 'Tanggal');
            $sheet->setCellValue('K1', 'Jam Mulai');
            $sheet->setCellValue('L1', 'Jam Selesai');
            $sheet->setCellValue('M1', 'Lokasi');
            foreach ($seminar as $key => $value) {
                $sheet->setCellValue('A' . ($key + 2), $key + 1);
                $sheet->setCellValue('B' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
                $sheet->setCellValue('C' . ($key + 2), $value->mahasiswa->npm);
                $sheet->setCellValue('D' . ($key + 2), $value->judul_ta);
                $sheet->setCellValue('E' . ($key + 2), $value->pembimbingSatu->nama_dosen);
                if ($value->id_pembimbing_2) {
                    $sheet->setCellValue('F' . ($key + 2), $value->pembimbingDua->nama_dosen);
                } else {
                    $sheet->setCellValue('F' . ($key + 2), $value->pbl2_nama);
                }
                if ($value->id_pembahas_1) {
                    $sheet->setCellValue('G' . ($key + 2), $value->pembahasSatu->nama_dosen);
                } else {
                    $sheet->setCellValue('G' . ($key + 2), $value->pembahas_external_1);
                }
                if ($value->id_pembahas_2) {
                    $sheet->setCellValue('H' . ($key + 2), $value->pembahasDua->nama_dosen);
                } else {
                    $sheet->setCellValue('H' . ($key + 2), $value->pembahas_external_2);
                }
                if ($value->id_pembahas_3) {
                    $sheet->setCellValue('I' . ($key + 2), $value->pembahasTiga->nama_dosen);
                } else {
                    $sheet->setCellValue('I' . ($key + 2), $value->pembahas_external_3);
                }
                $sheet->setCellValue('J' . ($key + 2), $value->jadwal->tanggal);
                $sheet->setCellValue('K' . ($key + 2), $value->jadwal->jam_mulai);
                $sheet->setCellValue('L' . ($key + 2), $value->jadwal->jam_selesai);
                $sheet->setCellValue('M' . ($key + 2), $value->jadwal->lokasi->nama_lokasi);
            }
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spredsheet);
            $filename = 'Daftar Pasca-Penjadwalan Seminar Tesis 2.xlsx';
            $writer->save($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()
                ->with('error', 'Belum ada Seminar Tesis 2 yang dijadwalkan');
        }
    }
}
