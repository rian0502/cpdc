<?php

namespace App\Http\Controllers\mahasiswa_s2\ta1;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use App\Models\TemplateBeritaAcara;
use App\Http\Controllers\Controller;
use App\Models\ModelSeminarTaSatuS2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaSatuS2;

class ControllerKoorS2PenjadwalanTaSatu extends Controller
{
    private $ba;

    public function __construct()
    {
        $this->ba = TemplateBeritaAcara::find(5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = date('Y-m-d');
        $seminar = ModelSeminarTaSatuS2::with('jadwal')
            ->whereDoesntHave('beritaAcara')
            ->where('status_admin', 'Valid')
            ->where(function ($query) use ($now) {
                $query->whereDoesntHave('jadwal')
                    ->orWhereHas('jadwal', function ($query) use ($now) {
                        $query->whereDate('tanggal', '>=', $now);
                    });
            })->get();
        return View('koorS2.tesis1.jadwal.index', compact('seminar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $id = array_key_last($request->except('_token'));

        $seminar = ModelSeminarTaSatuS2::find(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
            'locations' => Lokasi::where('jenis_ruangan', 'Kelas')->get(),
        ];
        return View('koorS2.tesis1.jadwal.create', $data);
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
        $insertJadwal = ModelJadwalSeminarTaSatuS2::create($data);
        $ins_id = $insertJadwal->id;
        $update = ModelJadwalSeminarTaSatuS2::find($ins_id);
        $update->encrypt_id = Crypt::encrypt($ins_id);
        $update->save();
        $seminar = ModelSeminarTaSatuS2::find($id);
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
        $template->setValue('nama_koor_ta1', Auth::user()->name);
        $template->setValue('nip_koor_ta1', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('nama_lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_tesis_1.docx';
        $template->saveAs('uploads/print_ba_tesis_1/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tesis 1 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Tesis 1');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_tesis_1/' . $namafile);
        });
        unlink('uploads/print_ba_tesis_1/' . $namafile);
        return redirect()->route('koor.jadwalTA1S2.index')->with('success', 'Berhasil Menjadwalkan Seminar Tesis 1');
    }

    public function resend($id)
    {

        $seminar = ModelSeminarTaSatuS2::with(['jadwal', 'mahasiswa'])->where('id', Crypt::decrypt($id))->first();
        $jadwal = $seminar->jadwal;
        $mahasiswa = $seminar->mahasiswa;
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', $jadwal->id_lokasi)->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $hari = Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('dddd');
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $kajur = User::role('kaprodiS2')->with('dosen')->first();
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
        $template->setValue('nama_koor_ta1', Auth::user()->name);
        $template->setValue('nip_koor_ta1', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $jadwal->jam_mulai);
        $template->setValue('jam_selesai', $jadwal->jam_selesai);
        $template->setValue('nama_lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_tesis_1.docx';
        $template->saveAs('uploads/print_ba_tesis_1/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tesis 1 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($jadwal->tanggal)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $jadwal->jam_mulai,
            'jam_selesai' => $jadwal->jam_selesai,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Tesis 1');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_tesis_1/' . $namafile);
        });
        unlink('uploads/print_ba_tesis_1/' . $namafile);
        return redirect()->route('koor.jadwalTA1S2.index')->with('success', 'Berhasil Mengirim Kembali Berita Acara Seminar Tesis 1');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seminar = ModelSeminarTaSatuS2::findOrFail(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
            'locations' => Lokasi::where('jenis_ruangan', 'Kelas')->get(),
            'jadwal' => $seminar->jadwal,
        ];
        return View('koorS2.tesis1.jadwal.edit', $data);
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
        $id = Crypt::decrypt($id);
        $hari =  $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('kaprodiS2')->with('dosen')->first();
        $seminar = ModelSeminarTaSatuS2::find($id);
        $jadwal = ModelJadwalSeminarTaSatuS2::where('id_seminar', $id)->first();
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
        $template->setValue('nama_koor_ta1', Auth::user()->name);
        $template->setValue('nip_koor_ta1', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('nama_lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_tesis_1.docx';
        $template->saveAs('uploads/print_ba_tesis_1/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tesis 1 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Tesis 1');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_tesis_1/' . $namafile);
        });
        unlink('uploads/print_ba_tesis_1/' . $namafile);
        return redirect()->route('koor.jadwalTA1S2.index')->with('success', 'Berhasil Menjadwalkan Ulang Seminar Tesis 1');
    }
}
