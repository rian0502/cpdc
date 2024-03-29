<?php

namespace App\Http\Controllers\kerja_praktik;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\JadwalSKP;
use App\Models\Administrasi;
use Illuminate\Http\Request;
use App\Models\ModelSeminarKP;
use Illuminate\Routing\Controller;
use App\Jobs\SendEmailKerjaPraktik;
use App\Models\TemplateBeritaAcara;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\ModelJadwalSeminarTaDua;
use App\Models\ModelJadwalSeminarKompre;
use App\Models\ModelJadwalSeminarTaSatu;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class JadwalPKLController extends Controller
{
    private $ba;
    private $koor;

    public function __construct()
    {
        $this->ba = TemplateBeritaAcara::find(1);
        $this->koor = User::role('pkl')->with('dosen')->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $now = date('Y-m-d');
        $data = [
            'seminar' => ModelSeminarKP::select(
                'id',
                'encrypt_id',
                'judul_kp',
                'mitra',
                'rencana_seminar',
                'id_mahasiswa'
            )
                ->whereDoesntHave('berita_acara')
                ->where('proses_admin', '=', 'Valid')
                ->where(function ($query) use ($now) {
                    $query->whereDoesntHave('jadwal')
                        ->orWhereHas('jadwal', function ($query) use ($now) {
                            $query->whereDate('tanggal_skp', '>', $now);
                        });
                })
                ->orderBy('updated_at', 'desc')
                ->get()

        ];
        return view('koor.pkl.jadwal.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $id)
    {
        $id_seminar = array_key_first($id->all());
        $data = [
            'locations' => Lokasi::select('encrypt_id', 'nama_lokasi')->get(),
            'seminar' => ModelSeminarKP::find(Crypt::decrypt($id_seminar)),
        ];
        return view('koor.pkl.jadwal.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_seminar = array_key_last($request->all());
        $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $lokasi = Lokasi::select('id', 'nama_lokasi')->where('id', Crypt::decrypt($request->id_lokasi))->first();
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $insert = JadwalSKP::create([
            'tanggal_skp' => $request->tanggal_skp,
            'jam_mulai_skp' => $request->jam_mulai_skp,
            'jam_selesai_skp' => $request->jam_selesai_skp,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'id_skp' => Crypt::decrypt($id_seminar),
        ]);
        $ins_id = $insert->id;
        $jadwal_skp = JadwalSKP::find($ins_id);
        $jadwal_skp->encrypt_id = Crypt::encrypt($ins_id);
        $jadwal_skp->save();
        //export word
        $seminar = ModelSeminarKP::find(Crypt::decrypt($id_seminar));
        //lokasi template
        $template = new TemplateProcessor($this->ba->path);
        $template->setValue('nama_koor_pkl', $this->koor->dosen->nama_dosen);
        $template->setValue('nip_koor_pkl', $this->koor->dosen->nip);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_kp', $seminar->judul_kp);
        $template->setValue('dosen_pembimbing_pkl', $seminar->dosen->nama_dosen);
        $template->setValue('nip_dosen_pembimbing_pkl', $seminar->dosen->nip);
        $template->setValue('dosen_pembimbing_akademik', $seminar->mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_dosen_pembimbing_akademik', $seminar->mahasiswa->dosen->nip);
        $template->setValue('jam_mulai',  $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('hari', $hari);
        $template->setValue(
            'tgl_seminar_kp',
            Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY')
        );
        $template->setValue('mitra', $seminar->mitra);
        $template->setValue('lokasi', $lokasi->nama_lokasi);
        $template->setValue('pembimbing_lapangan', $seminar->pembimbing_lapangan);
        $template->setValue('nip_pembimbing_lapangan', $seminar->ni_pemlap);
        $namafile = $seminar->mahasiswa->npm . '_ba_kp_' . time() . '.docx';
        $template->saveAs('uploads/print_ba_kp/' . $namafile);
        //send email
        $to_name = $seminar->mahasiswa->nama_mahasiswa;
        $to_email = $seminar->mahasiswa->user->email;


        $data = array(
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal seminar kerja praktik anda',
            'seminar' => $seminar->judul_kp,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $lokasi->nama_lokasi,
            'pembimbing_lapangan' => $request->pembimbing_lapangan,
            'ni_pemlap' => $request->ni_pemlap,

        );

        dispatch(new SendEmailKerjaPraktik($data, $to_name, $to_email, $namafile));
        return redirect()->route('koor.jadwalPKL.index')
            ->with('success', 'Jadwal Seminar KP Berhasil Ditambahkan');
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
        $seminar = ModelSeminarKP::find(Crypt::decrypt($id));
        $data = [
            'locations' => Lokasi::select('id', 'encrypt_id', 'nama_lokasi', 'lantai_tingkat')->get(),
            'seminar' => $seminar,
            'jadwal' => JadwalSKP::where('id_skp', '=', $seminar->id)->first(),
        ];
        return view('koor.pkl.jadwal.edit', $data);
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
        $request->validate([
            'tanggal_skp' => 'required|date|after_or_equal:tomorrow',
            'jam_mulai_skp' => 'required',
            'jam_selesai_skp' => 'required',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
        ], [
            'tanggal_skp.required' => 'Tanggal tidak boleh kosong',
            'tanggal_skp.date' => 'Tanggal harus berupa tanggal',
            'tanggal_skp.after_or_equal' => 'Tanggal Minimal Besok',
            'jam_mulai_skp.required' => 'Jam mulai tidak boleh kosong',
            'jam_selesai_skp.required' => 'Jam selesai tidak boleh kosong',
            'id_lokasi.required' => 'Lokasi tidak boleh kosong',
            'id_lokasi.exists' => 'Lokasi tidak ditemukan',
        ]);

        $cekJadwal = JadwalSKP::where('tanggal_skp', '=', $request->tanggal_skp)
            ->where('jam_mulai_skp', '=', $request->jam_mulai_skp)
            ->where('jam_selesai_skp', '=', $request->jam_selesai_skp)
            ->where('id_lokasi', '=', Crypt::decrypt($request->id_lokasi))
            ->first();
        if ($cekJadwal) {
            return redirect()->back()->with('error', 'Jadwal Sudah Terdaftar');
        }
        $hari = Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $jadwal_skp = JadwalSKP::find(Crypt::decrypt($id));
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        $seminar = ModelSeminarKP::find($jadwal_skp->id_skp);
        $jadwal_skp->tanggal_skp = $request->tanggal_skp;
        $jadwal_skp->jam_mulai_skp = $request->jam_mulai_skp;
        $jadwal_skp->jam_selesai_skp = $request->jam_selesai_skp;
        $jadwal_skp->id_lokasi = Crypt::decrypt($request->id_lokasi);
        $jadwal_skp->save();
        //lokasi template
        $template = new TemplateProcessor($this->ba->path);
        $template->setValue('nama_koor_pkl', $this->koor->dosen->nama_dosen);
        $template->setValue('nip_koor_pkl', $this->koor->dosen->nip);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_kp', $seminar->judul_kp);
        $template->setValue('dosen_pembimbing_pkl', $seminar->dosen->nama_dosen);
        $template->setValue('nip_dosen_pembimbing_pkl', $seminar->dosen->nip);
        $template->setValue('dosen_pembimbing_akademik', $seminar->mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_dosen_pembimbing_akademik', $seminar->mahasiswa->dosen->nip);
        $template->setValue('jam_mulai',  $request->jam_mulai_skp);
        $template->setValue('jam_selesai', $request->jam_selesai_skp);
        $template->setValue('hari', $hari);
        $template->setValue(
            'tgl_seminar_kp',
            Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY')
        );
        $template->setValue('mitra', $request->mitra);
        $template->setValue('lokasi', $jadwal_skp->lokasi->nama_lokasi);
        $template->setValue('pembimbing_lapangan', $request->pembimbing_lapangan);
        $template->setValue('nip_pembimbing_lapangan', $request->ni_pemlap);
        $output = ('uploads/print_ba_kp/');
        $namafile = $seminar->mahasiswa->npm . '_ba_kp_' . time() . '.docx';
        $template->saveAs($output . $namafile);
        //send email
        $to_name = $seminar->mahasiswa->nama_mahasiswa;
        $to_email = $seminar->mahasiswa->user->email;

        $data = array(
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal seminar kerja praktik anda',
            'seminar' => $seminar->judul_kp,
            'tanggal' => $hari . ', ' . Carbon::parse($request->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $request->jam_mulai_skp,
            'jam_selesai' => $request->jam_selesai_skp,
            'lokasi' => $jadwal_skp->lokasi->nama_lokasi,
            'pembimbing_lapangan' => $request->pembimbing_lapangan,
            'ni_pemlap' => $request->ni_pemlap,

        );
        //send email to mahasiswa
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Kerja Praktik');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach(('uploads/print_ba_kp/') . $namafile);
        });
        unlink(('uploads/print_ba_kp/' . $namafile));
        return redirect()->route('koor.jadwalPKL.index')->with('success', 'Jadwal Seminar KP Berhasil Diubah');
    }

    public function resend($id)
    {

        $seminar = ModelSeminarKP::find(Crypt::decrypt($id));
        $jadwal_skp = JadwalSKP::where('id_skp', '=', $seminar->id)->first();
        $hari = Carbon::parse($jadwal_skp->tanggal_skp)->locale('id_ID')->isoFormat('dddd');
        $admin = Administrasi::select('nama_administrasi', 'nip')->where('status', 'Aktif')->first();
        $kajur = User::role('jurusan')->with('dosen')->first();
        //lokasi template
        $template = new TemplateProcessor($this->ba->path);
        $template->setValue('nama_koor_pkl', $this->koor->dosen->nama_dosen);
        $template->setValue('nip_koor_pkl', $this->koor->dosen->nip);
        $template->setValue('nama_admin', $admin->nama_administrasi);
        $template->setValue('nip_admin', $admin->nip);
        $template->setValue('nama_kajur', $kajur->dosen->nama_dosen);
        $template->setValue('nip_kajur', $kajur->dosen->nip);
        $template->setValue('nama_mahasiswa', $seminar->mahasiswa->nama_mahasiswa);
        $template->setValue('npm', $seminar->mahasiswa->npm);
        $template->setValue('judul_kp', $seminar->judul_kp);
        $template->setValue('dosen_pembimbing_pkl', $seminar->dosen->nama_dosen);
        $template->setValue('nip_dosen_pembimbing_pkl', $seminar->dosen->nip);
        $template->setValue('dosen_pembimbing_akademik', $seminar->mahasiswa->dosen->nama_dosen);
        $template->setValue('nip_dosen_pembimbing_akademik', $seminar->mahasiswa->dosen->nip);
        $template->setValue('jam_mulai',  $jadwal_skp->jam_mulai_skp);
        $template->setValue('jam_selesai', $jadwal_skp->jam_selesai_skp);
        $template->setValue('hari', $hari);
        $template->setValue(
            'tgl_seminar_kp',
            Carbon::parse($jadwal_skp->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY')
        );
        $template->setValue('mitra', $seminar->mitra);
        $template->setValue('lokasi', $jadwal_skp->lokasi->nama_lokasi);
        $template->setValue('pembimbing_lapangan', $jadwal_skp->pembimbing_lapangan);
        $template->setValue('nip_pembimbing_lapangan', $jadwal_skp->ni_pemlap);
        $output = ('uploads/print_ba_kp/');
        $namafile = $seminar->mahasiswa->npm . '_ba_kp_' . time() . '.docx';
        $template->saveAs($output . $namafile);
        //send email
        $to_name = $seminar->mahasiswa->nama_mahasiswa;
        $to_email = $seminar->mahasiswa->user->email;

        $data = [
            'name' => $seminar->mahasiswa->nama_mahasiswa,
            'body' => 'Berikut adalah jadwal seminar kerja praktik anda',
            'seminar' => $seminar->judul_kp,
            'seminar' => $seminar->judul_kp,
            'tanggal' => $hari . ', ' .
                Carbon::parse($jadwal_skp->tanggal_skp)->locale('id_ID')->isoFormat('D MMMM YYYY'),
            'jam_mulai' => $jadwal_skp->jam_mulai_skp,
            'jam_selesai' => $jadwal_skp->jam_selesai_skp,
            'lokasi' => $jadwal_skp->lokasi->nama_lokasi,
            'pembimbing_lapangan' => $jadwal_skp->pembimbing_lapangan,
            'ni_pemlap' => $jadwal_skp->ni_pemlap,
        ];
        //send email to mahasiswa
        Mail::send('email.jadwal_seminar', $data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Kerja Praktik');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach(('uploads/print_ba_kp/') . $namafile);
        });
        unlink(('uploads/print_ba_kp/' . $namafile));
        return redirect()->route('koor.jadwalPKL.index')->with('success', 'Jadwal Seminar KP Berhasil Dikirim Ulang');
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
        $seminar = ModelSeminarKP::with(['jadwal', 'mahasiswa', 'dosen'])
            ->whereDoesntHave('jadwal')
            ->where('proses_admin', '=', 'Valid')
            ->orderBy('updated_at', 'asc')
            ->get();
        if ($seminar->count() == 0) {
            return redirect()->back()->with('error', 'Tidak Ada Jadwal Seminar KP');
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'NPM');
            $sheet->setCellValue('C1', 'Nama Mahasiswa');
            $sheet->setCellValue('D1', 'Judul KP');
            $sheet->setCellValue('E1', 'Dosen Pembimbing');
            $sheet->setCellValue('F1', 'Pembimbing Lapangan');
            $sheet->setCellValue('G1', 'Mitra');
            foreach ($seminar as $key => $value) {
                $sheet->setCellValue('A' . ($key + 2), $key + 1);
                $sheet->setCellValue('B' . ($key + 2), $value->mahasiswa->npm);
                $sheet->setCellValue('C' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
                $sheet->setCellValue('D' . ($key + 2), $value->judul_kp);
                $sheet->setCellValue('E' . ($key + 2), $value->dosen->nama_dosen);
                $sheet->setCellValue('F' . ($key + 2), $value->pembimbing_lapangan);
                $sheet->setCellValue('G' . ($key + 2), $value->mitra);
            }
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filename = 'pra_penjadwalan_seminar_kp_' . '.xlsx';
            $writer->save($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        }
    }

    public function pascaDownloadJadwal()
    {
        $seminar = ModelSeminarKP::with('jadwal', 'mahasiswa', 'dosen')
            ->whereHas('jadwal', function ($query) {
                $query->whereDate('tanggal_skp', '>=', date('Y-m-d'));
            })->where('proses_admin', 'Valid')->orderBy('updated_at', 'asc')->get();
        if ($seminar->count() == 0) {
            return redirect()->back()->with('error', 'Tidak Ada Jadwal Seminar KP');
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'NPM');
            $sheet->setCellValue('C1', 'Nama Mahasiswa');
            $sheet->setCellValue('D1', 'Judul KP');
            $sheet->setCellValue('E1', 'Dosen Pembimbing');
            $sheet->setCellValue('F1', 'Pembimbing Lapangan');
            $sheet->setCellValue('G1', 'Mitra');
            $sheet->setCellValue('H1', 'Tanggal Seminar');
            $sheet->setCellValue('I1', 'Jam Mulai');
            $sheet->setCellValue('J1', 'Jam Selesai');
            $sheet->setCellValue('K1', 'Lokasi');
            foreach ($seminar as $key => $value) {
                $sheet->setCellValue('A' . ($key + 2), $key + 1);
                $sheet->setCellValue('B' . ($key + 2), $value->mahasiswa->npm);
                $sheet->setCellValue('C' . ($key + 2), $value->mahasiswa->nama_mahasiswa);
                $sheet->setCellValue('D' . ($key + 2), $value->judul_kp);
                $sheet->setCellValue('E' . ($key + 2), $value->dosen->nama_dosen);
                $sheet->setCellValue('F' . ($key + 2), $value->pembimbing_lapangan);
                $sheet->setCellValue('G' . ($key + 2), $value->mitra);
                $sheet->setCellValue('H' . ($key + 2), $value->jadwal->tanggal_skp);
                $sheet->setCellValue('I' . ($key + 2), $value->jadwal->jam_mulai_skp);
                $sheet->setCellValue('J' . ($key + 2), $value->jadwal->jam_selesai_skp);
                $sheet->setCellValue('K' . ($key + 2), $value->jadwal->lokasi->nama_lokasi);
            }
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filename = 'pasca_penjadwalan_seminar_kp_' . '.xlsx';
            $writer->save($filename);
            return response()->download($filename)->deleteFileAfterSend(true);
        }
    }

    public function checkJadwal(Request $request)
    {
        $request->validate([
            'tanggal_skp' => 'required|date|after_or_equal:tomorrow',
            'jam_mulai_skp' => 'required',
            'jam_selesai_skp' => 'required|after:jam_mulai_skp',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
        ], [
            'tanggal_skp.required' => 'Tanggal Harus Diisi',
            'tanggal_skp.date' => 'Tanggal harus berupa tanggal',
            'tanggal_skp.after_or_equal' => 'Tanggal Minimal Besok',
            'jam_mulai_skp.required' => 'Jam mulai tidak boleh kosong',
            'jam_selesai_skp.required' => 'Jam selesai tidak boleh kosong',
            'id_lokasi.required' => 'Lokasi tidak boleh kosong',
            'id_lokasi.exists' => 'Lokasi tidak ditemukan',
            'jam_selesai_skp.after' => 'Jam selesai harus lebih besar dari jam mulai',
        ]);
        $cekJadwalPkl = JadwalSKP::where(
            'tanggal_skp',
            '=',
            $request->tanggal_skp
        )->where(
            'jam_mulai_skp',
            '=',
            $request->jam_mulai_skp
        )->where(
            'jam_selesai_skp',
            '=',
            $request->jam_selesai_skp
        )->where(
            'id_lokasi',
            '=',
            Crypt::decrypt($request->id_lokasi)
        )->count();
        $cekJadwalTa1 = ModelJadwalSeminarTaSatu::where(
            'jam_selesai_seminar_ta_satu',
            '=',
            $request->tanggal_skp
        )->where(
            'jam_mulai_seminar_ta_satu',
            '=',
            $request->jam_mulai_skp
        )->where(
            'jam_selesai_seminar_ta_satu',
            '=',
            $request->jam_selesai_skp
        )->where(
            'id_lokasi',
            '=',
            Crypt::decrypt($request->id_lokasi)
        )->count();

        $cekJadwalTa2 = ModelJadwalSeminarTaDua::where(
            'tanggal_seminar_ta_dua',
            $request->tanggal_skp
        )->where(
            'jam_mulai_seminar_ta_dua',
            $request->jam_mulai_skp
        )->where(
            'jam_selesai_seminar_ta_dua',
            $request->jam_selesai_skp
        )->where(
            'id_lokasi',
            Crypt::decrypt($request->id_lokasi)
        )->count();

        $cekJadwalKompre = ModelJadwalSeminarKompre::where(
            'tanggal_komprehensif',
            $request->tanggal_skp
        )->where(
            'jam_mulai_komprehensif',
            $request->jam_mulai_skp
        )->where(
            'jam_selesai_komprehensif',
            $request->jam_selesai_skp
        )->where(
            'id_lokasi',
            Crypt::decrypt($request->id_lokasi)
        )->count();

        if ($cekJadwalPkl > 0 || $cekJadwalTa1 > 0 || $cekJadwalTa2 > 0 || $cekJadwalKompre > 0) {
            return response()->json(['message' => 'Failed']);
        } else {
            return response()->json(['message' => 'Valid']);
        }
    }



    public function checkUpdate(Request $request)
    {

        $request->validate([
            'tanggal_skp' => 'required|date|after_or_equal:tomorrow',
            'jam_mulai_skp' => 'required',
            'jam_selesai_skp' => 'required|after:jam_mulai_skp',
            'id_lokasi' => 'required|exists:lokasi,encrypt_id',
        ], [
            'tanggal_skp.required' => 'Tanggal Harus Diisi',
            'tanggal_skp.date' => 'Tanggal harus berupa tanggal',
            'tanggal_skp.after_or_equal' => 'Tanggal Minimal Besok',
            'jam_mulai_skp.required' => 'Jam mulai tidak boleh kosong',
            'jam_selesai_skp.required' => 'Jam selesai tidak boleh kosong',
            'id_lokasi.required' => 'Lokasi tidak boleh kosong',
            'id_lokasi.exists' => 'Lokasi tidak ditemukan',
            'jam_selesai_skp.after' => 'Jam selesai harus lebih besar dari jam mulai',
        ]);
        $cekJadwalPkl = JadwalSKP::where(
            'tanggal_skp',
            '=',
            $request->tanggal_skp
        )->where(
            'jam_mulai_skp',
            '=',
            $request->jam_mulai_skp
        )->where(
            'jam_selesai_skp',
            '=',
            $request->jam_selesai_skp
        )->where(
            'id_lokasi',
            '=',
            Crypt::decrypt($request->id_lokasi)
        )->count();
        $cekJadwalTa1 = ModelJadwalSeminarTaSatu::where(
            'jam_selesai_seminar_ta_satu',
            '=',
            $request->tanggal_skp
        )->where(
            'jam_mulai_seminar_ta_satu',
            '=',
            $request->jam_mulai_skp
        )->where(
            'jam_selesai_seminar_ta_satu',
            '=',
            $request->jam_selesai_skp
        )->where(
            'id_lokasi',
            '=',
            Crypt::decrypt($request->id_lokasi)
        )->count();

        $cekJadwalTa2 = ModelJadwalSeminarTaDua::where(
            'tanggal_seminar_ta_dua',
            $request->tanggal_skp
        )->where(
            'jam_mulai_seminar_ta_dua',
            $request->jam_mulai_skp
        )->where(
            'jam_selesai_seminar_ta_dua',
            $request->jam_selesai_skp
        )->where(
            'id_lokasi',
            Crypt::decrypt($request->id_lokasi)
        )->count();

        $cekJadwalKompre = ModelJadwalSeminarKompre::where(
            'tanggal_komprehensif',
            $request->tanggal_skp
        )->where(
            'jam_mulai_komprehensif',
            $request->jam_mulai_skp
        )->where(
            'jam_selesai_komprehensif',
            $request->jam_selesai_skp
        )->where(
            'id_lokasi',
            Crypt::decrypt($request->id_lokasi)
        )->count();

        if ($cekJadwalPkl > 0 || $cekJadwalTa1 > 0 || $cekJadwalTa2 > 0 || $cekJadwalKompre > 0) {
            return response()->json(['message' => 'Failed']);
        } else {
            return response()->json(['message' => 'Valid']);
        }
    }
}
