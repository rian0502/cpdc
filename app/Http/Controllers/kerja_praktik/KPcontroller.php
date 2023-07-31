<?php

namespace App\Http\Controllers\kerja_praktik;

use App\Http\Requests\StoreSeminarKP;
use App\Http\Requests\UpdateSeminarKpRequest;
use App\Models\BaSKP;
use App\Models\BerkasPersyaratanSeminar;
use App\Models\Dosen;
use App\Models\JadwalSKP;
use App\Models\Mahasiswa;
use App\Models\ModelSeminarKP;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class KPcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $seminarKp = ModelSeminarKP::where('id_mahasiswa', $mahasiswa->id)->get();
        if (count($seminarKp) <= 0) {
            return redirect()->route('mahasiswa.seminar.kp.create');
        } else {
            $data = [
                'mahasiswa' => $mahasiswa,
                'seminar' => ModelSeminarKP::where('id_mahasiswa', $mahasiswa->id)->first(),
                'berita_acara' => BaSKP::where('id_seminar', ModelSeminarKP::where('id_mahasiswa', $mahasiswa->id)->first()->id)->first(),
            ];
            return view('mahasiswa.kp.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::select('id')->where('user_id', auth()->user()->id)->first();
        $seminarKp = ModelSeminarKP::where('id_mahasiswa', $mahasiswa->id)->count();
        $syarat = BerkasPersyaratanSeminar::find(1);
        if ($seminarKp >= 1) {
            return redirect()->route('mahasiswa.seminar.kp.index');
        }
        $data = [
            'dosens' => Dosen::select('encrypt_id', 'nama_dosen')->where('status', 'Aktif')
                ->get(),
            'syarat' => $syarat,
        ];
        return view('mahasiswa.kp.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeminarKP $request)
    {
        $file_seminar = $request->file('berkas_seminar_pkl');
        $mahasiswa = Mahasiswa::select('id')->where('user_id', auth()->user()->id)->first();
        $nama_file = $file_seminar->hashName();
        $file_seminar->move(('uploads/syarat_seminar_kp'), $nama_file);
        $data = [
            'judul_kp' => Str::title($request->judul_kp),
            'semester' => $request->semester,
            'tahun_akademik' => $request->tahun_akademik,
            'mitra' => $request->mitra,
            'region' => $request->region,
            'rencana_seminar' => $request->rencana_seminar,
            'pembimbing_lapangan' => $request->pembimbing_lapangan,
            'ni_pemlap' => $request->ni_pemlap,
            'toefl' => $request->toefl,
            'sks' => $request->sks,
            'ipk' => $request->ipk,
            'berkas_seminar_pkl' => $nama_file,
            'agreement' => 1,
            'status_seminar' => 'Belum Selesai',
            'proses_admin' => 'Proses',
            'ket' => '',
            'id_dospemkp' => Crypt::decrypt($request->id_dospemkp),
            'id_mahasiswa' => $mahasiswa->id,
            'proses_admin' => 'Valid',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $insert = ModelSeminarKP::create($data);
        $insert_id = $insert->id;
        $update = ModelSeminarKP::find($insert_id);
        $update->encrypt_id = Crypt::encrypt($insert_id);
        $update->save();
        //buatkan jadwal seminar untuk mahasiswa 19
        $faker = \Faker\Factory::create('id_ID');
        $jadwal = JadwalSKP::create([
            'tanggal_skp' => date('Y-m-d'),
            'jam_mulai_skp' => date('H:i'),
            'jam_selesai_skp' => date('H:i'),
            'id_lokasi' => $faker->numberBetween(1, 5),
            'id_skp' => $insert_id,
        ]);
        $jadwal_id = $jadwal->id;
        $jadwal_update = JadwalSKP::find($jadwal_id);
        $jadwal_update->encrypt_id = Crypt::encrypt($jadwal_id);
        $jadwal_update->save();
        return redirect()->route('mahasiswa.seminar.kp.index')->with('success', 'Data Seminar KP Berhasil Ditambahkan');
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

    public function edit($id)
    {
        //
        $syarat = BerkasPersyaratanSeminar::find(1);
        $seminar = ModelSeminarKP::select('id', 'id_mahasiswa')->where('id', Crypt::decrypt($id))->first();
        if ($seminar->id_mahasiswa != auth()->user()->mahasiswa->id) {
            return redirect()->back();
        }
        $data = [
            'seminar' => ModelSeminarKP::find(Crypt::decrypt($id)),
            'dosens' => Dosen::select('encrypt_id', 'nama_dosen')->where('status', 'Aktif')->get(),
            'syarat' => $syarat,
        ];

        return view('mahasiswa.kp.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeminarKpRequest $request, $id)
    {
        $seminarKp = ModelSeminarKP::find(Crypt::decrypt($id));
        if ($request->file('berkas_seminar_pkl')) {
            $file_seminar = $request->file('berkas_seminar_pkl');
            $file_before = $seminarKp->berkas_seminar_pkl;
            unlink(('uploads/syarat_seminar_kp/' . $file_before));
            $nama_file = $file_seminar->hashName();
            $file_seminar->move(('uploads/syarat_seminar_kp'), $nama_file);
            $seminarKp->berkas_seminar_pkl = $nama_file;
        }
        $seminarKp->mitra = $request->mitra;
        $seminarKp->semester = $request->semester;
        $seminarKp->sks = $request->sks;
        $seminarKp->tahun_akademik = $request->tahun_akademik;
        $seminarKp->region = $request->region;
        $seminarKp->judul_kp = $request->judul_kp;
        $seminarKp->id_dospemkp = Crypt::decrypt($request->id_dospemkp);
        $seminarKp->pembimbing_lapangan = $request->pembimbing_lapangan;
        $seminarKp->ni_pemlap = $request->ni_pemlap;
        $seminarKp->rencana_seminar = $request->rencana_seminar;
        $seminarKp->toefl = $request->toefl;
        $seminarKp->ipk = $request->ipk;
        $seminarKp->keterangan = '';
        $seminarKp->proses_admin = 'Proses';
        $seminarKp->updated_at = date('Y-m-d H:i:s');
        $seminarKp->save();
        return redirect()->route('mahasiswa.seminar.kp.index')->with('success', 'Data Seminar KP Berhasil Diubah');
    }
}
