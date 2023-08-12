<?php

namespace App\Http\Controllers\mahasiswa_s2\kompre;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use App\Models\ModelKompreS2;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarKompreS2;
use App\Models\TemplateBeritaAcara;

class ControllerKoorS2JadwalKompre extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ba;
    public function __construct()
    {
        $this->ba = TemplateBeritaAcara::find(7);
    }
    public function index()
    {
        $now = date('Y-m-d');
        $seminar = ModelKompreS2::with('jadwal')
            ->whereDoesntHave('beritaAcara')
            ->where('status_admin', 'Valid')
            ->where(function ($query) use ($now) {
                $query->whereDoesntHave('jadwal')
                    ->orWhereHas('jadwal', function ($query) use ($now) {
                        $query->whereDate('tanggal', '>=', $now);
                    });
            })->get();
        return View('koorS2.sidang.jadwal.index', compact('seminar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = array_key_last($request->except('_token'));
        $seminar = ModelKompreS2::find(Crypt::decrypt($id));
        $data = [
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
            'locations' => Lokasi::where('jenis_ruangan', 'Kelas')->get(),
        ];
        return View('koorS2.sidang.jadwal.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id = Crypt::decrypt(array_key_last($request->except('_token')));
        $hari =  $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kaprodi = User::role('kaprodiS2')->with('dosen')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $data = [
            'tanggal' => $request->tanggal_skp,
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'id_seminar' => $id
        ];
        $insertJadwal = ModelJadwalSeminarKompreS2::create($data);
        $ins_id = $insertJadwal->id;
        $update = ModelJadwalSeminarKompreS2::find($ins_id);
        $update->encrypt_id = Crypt::encrypt($ins_id);
        $update->save();
        $seminar = ModelKompreS2::find($id);
        $mahasiswa = $seminar->mahasiswa;
        $template = new \PhpOffice\PhpWord\TemplateProcessor($this->ba->path);
        $template->setValue('nama_pa', $mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_pa', $mahasiswa->dosen->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);  
        $template->setValue('nama_kaprodi_s2', $kaprodi->dosen->nama_dosen);
        $template->setValue('nip_kaprodi_s2', $kaprodi->dosen->nip);
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
            $template->setValue('nip_pembimbing_2', $seminar->pembahasDua->nip);
        } else {
            $template->setValue('nama_pembahas_2', $seminar->pembahas_external_2);
            $template->setValue('nip_pembimbing_2', $seminar->nip_pembahas_external_2);
        }
        if ($seminar->id_pembahas_3) {
            $template->setValue('nama_pembahas_3', $seminar->pembahasTiga->nama_dosen);
            $template->setValue('nip_pembahas_3', $seminar->pembahasTiga->nip);
        } else {
            $template->setValue('nama_pembahas_3', $seminar->pembahas_external_3);
            $template->setValue('nip_pembahas_3', $seminar->nip_pembahas_external_3);
        }
        $template->setValue('nama_koor_sidang', Auth::user()->name);
        $template->setValue('nip_koor_sidang', Auth::user()->dosen->nip);
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_sidang_tesis.docx';
        $template->saveAs('uploads/print_ba_sidang_tesis/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Sidang Tesis Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Sidang Tesis');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('uploads/print_ba_sidang_tesis/' . $namafile);
        });
        unlink('uploads/print_ba_sidang_tesis/' . $namafile);
        return redirect()->route('koor.jadwalKompreS2.index')->with('success', 'Berhasil Menjadwalkan Sidang Tesis');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return View('koorS2.sidang.jadwal.edit');
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
        //
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
    }
}
