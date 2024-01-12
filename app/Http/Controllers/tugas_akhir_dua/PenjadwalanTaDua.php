<?php

namespace App\Http\Controllers\tugas_akhir_dua;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\Mahasiswa;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use App\Models\ModelSeminarTaDua;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailTugasAkhir2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaDua;
use App\Models\TemplateBeritaAcara;

class PenjadwalanTaDua extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ba;

    public function __construct()
    {
        $this->ba = TemplateBeritaAcara::find(3);
    }
    public function index()
    {
        $now = date('Y-m-d');
        $seminar = ModelSeminarTaDua::select('id', 'encrypt_id', 'judul_ta', 'periode_seminar', 'id_mahasiswa')
            ->whereDoesntHave('ba_seminar')
            ->where('status_admin', 'Valid')
            ->where(function ($query) use ($now) {
                $query->whereDoesntHave('jadwal')
                    ->orWhereHas('jadwal', function ($query) use ($now) {
                        $query->whereDate('tanggal_seminar_ta_dua', '>=', $now);
                    });
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('koor.ta2.jadwal.index', compact('seminar'));
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

            $seminar =  ModelSeminarTaDua::find(Crypt::decrypt($id));
            $data = [
                'locations' => Lokasi::all(),
                'seminar' => $seminar,
                'mahasiswa' => $seminar->mahasiswa,
            ];
            return view('koor.ta2.jadwal.create', $data);
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
        $seminar = ModelSeminarTaDua::find($id);
        $admin = Administrasi::select('nama_administrasi', 'nip')
            ->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $hari =  $hari = Carbon::parse($request->tanggal_skp)
            ->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where(
            'id',
            Crypt::decrypt($request->id_lokasi)
        )->first();
        $data = [
            'tanggal_seminar_ta_dua' => $request->tanggal_skp,
            'jam_mulai_seminar_ta_dua' => $request->jam_mulai_skp,
            'jam_selesai_seminar_ta_dua' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'id_seminar' => $id
        ];
        $insertJadwal = ModelJadwalSeminarTaDua::create($data);
        $ins_id = $insertJadwal->id;
        $update = ModelJadwalSeminarTaDua::find($ins_id);
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
        $namafile = $mahasiswa->npm . '_ba_ta2.docx';
        $template->saveAs('uploads/print_ba_ta2/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tugas Akhir 2 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)
                ->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        dispatch(new SendEmailTugasAkhir2($data, $to_name, $to_email, $namafile));
        return redirect()->route('koor.jadwalTA2.index')->with(
            'success',
            'Berhasil Menjadwalkan Seminar Tugas Akhir 2'
        );
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
        //
        $seminar = ModelSeminarTaDua::find(Crypt::decrypt($id));
        $mahasiswa = Mahasiswa::find($seminar->id_mahasiswa);
        $data = [
            'seminar' => $seminar,
            'jadwal' => $seminar->jadwal,
            'mahasiswa' => $mahasiswa,
            'locations' => Lokasi::all(),
        ];

        return view('koor.ta2.jadwal.edit', $data);
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

        $seminar = ModelSeminarTaDua::find(Crypt::decrypt($id));
        $mahasiswa = $seminar->mahasiswa;
        $hari =  $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $data = [
            'tanggal_seminar_ta_dua' => $request->tanggal_skp,
            'jam_mulai_seminar_ta_dua' => $request->jam_mulai_skp,
            'jam_selesai_seminar_ta_dua' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'id_seminar' => $seminar->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $update = ModelJadwalSeminarTaDua::where('id_seminar', $seminar->id)->update($data);
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
        $namafile = $mahasiswa->npm . '_ba_ta2.docx';
        $template->saveAs('uploads/print_ba_ta2/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tugas Akhir 2 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        dispatch(new SendEmailTugasAkhir2($data, $to_name, $to_email, $namafile));
        return redirect()->route('koor.jadwalTA2.index')->with('success', 'Berhasil Memperbarui Jadwal Seminar Tugas Akhir 2');
    }


    public function resend($id)
    {
        $seminar = ModelSeminarTaDua::find(Crypt::decrypt($id));
        $mahasiswa = $seminar->mahasiswa;
        $jadwal_seminar = $seminar->jadwal;
        $hari =  $hari = Carbon::parse($jadwal_seminar->tanggal_seminar_ta_dua)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', $jadwal_seminar->id_lokasi)->first();
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
        $template->setValue('tanggal', Carbon::parse($jadwal_seminar->tanggal_seminar_ta_dua)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $jadwal_seminar->jam_mulai_seminar_ta_dua);
        $template->setValue('jam_selesai', $jadwal_seminar->jam_selesai_seminar_ta_dua);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $namafile = $mahasiswa->npm . '_ba_ta1.docx';
        $template->saveAs('uploads/template_ba_ta2/' . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Seminar Tugas Akhir 2 Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($jadwal_seminar->tanggal_seminar_ta_dua)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $jadwal_seminar->jam_mulai_seminar_ta_dua,
            'jam_selesai' => $jadwal_seminar->jam_selesai_seminar_ta_dua,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        dispatch(new SendEmailTugasAkhir2($data, $to_name, $to_email, $namafile));
        return redirect()->route('koor.jadwalTA2.index')->with('success', 'Berhasil Mengirim Ulang Jadwal Seminar TA 2');
    }
}
