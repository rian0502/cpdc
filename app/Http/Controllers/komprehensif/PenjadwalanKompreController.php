<?php

namespace App\Http\Controllers\komprehensif;

use Carbon\Carbon;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKompre;
use App\Models\ModelSeminarTaSatu;
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
    public function index()
    {
        $data = [
            'seminar' => ModelSeminarKompre::select('id', 'encrypt_id', 'judul_ta', 'periode_seminar', 'id_mahasiswa')
            ->where('status_admin', 'Valid')->get(),
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
        //
        $id = Crypt::decrypt(array_key_last($request->except('_token')));
        $seminar = ModelSeminarKompre::find($id);

        $hari =  $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', Crypt::decrypt($request->id_lokasi))->first();

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
        $path = public_path('uploads\template_ba_kompre\\');
        $template = new \PhpOffice\PhpWord\TemplateProcessor($path . 'template_ba_kompre.docx');
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
        $template->setValue('tanggal', Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'));
        $template->setValue('jam_mulai', $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $output  = public_path('uploads\print_ba_kompre\\');
        $namafile = $mahasiswa->npm . '_ba_kompre.docx';
        $template->saveAs($output . $namafile);
        $to_name = $mahasiswa->nama_mahasiswa;
        $to_email = $mahasiswa->user->email;
        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal Sidang Komprehensif Anda',
            'seminar' => $seminar->judul_ta,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
        ];
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Sidang Komprehensif');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach(public_path('uploads\print_ba_kompre\\') . $namafile);
        });
        unlink(public_path('uploads\print_ba_kompre\\' . $namafile));
        return redirect()->route('koor.jadwalKompre.index')->with('success', 'Berhasil Menjadwalkan Sidang Komprehensif');
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


        $seminar =  ModelSeminarKompre::find(Crypt::decrypt($id));
        $data = [
            'locations' => Lokasi::all(),
            'seminar' => $seminar,
            'mahasiswa' => $seminar->mahasiswa,
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
