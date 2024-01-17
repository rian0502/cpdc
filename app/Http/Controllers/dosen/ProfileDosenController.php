<?php

namespace App\Http\Controllers\dosen;

use App\Http\Requests\ProfileDosenRequest;
use App\Http\Requests\UpdateProfileDosenRequest;
use App\Models\Dosen;
use App\Models\HistoryJabatanDosen;
use App\Models\HistoryPangkatDosen;
use App\Models\LitabmasDosen;
use App\Models\ModelGelar;
use App\Models\ModelSPDosen;
use App\Models\PublikasiDosen;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use PDF;

class ProfileDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->dosen->count() > 0) {

            $tgl_lahir = Carbon::createFromFormat('Y-m-d', Auth::user()->dosen->tanggal_lahir);
            $now = Carbon::now();
            $umur = $tgl_lahir->diffInYears($now);
            $data = [

                'gelar' => ModelGelar::select(
                    'encrypt_id',
                    'instansi_pendidikan',
                    'jurusan',
                    'tahun_lulus',
                    'nama_gelar',
                    'singkatan_gelar'
                )->where('dosen_id', Auth::user()->dosen->id)->get(),
                'kepangkatan' => HistoryPangkatDosen::where('dosen_id', Auth::user()->dosen->id)
                    ->orderBy('id', 'desc')->get(),
                'jabatan' => HistoryJabatanDosen::where('dosen_id', Auth::user()->dosen->id)->get(),
                'umur' => $umur,
            ];
            return view('dosen.profile.index', $data);
        } else {
            return redirect()->route('dosen.profile.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->dosen != null) {
            return redirect()->back();
        }
        return view('dosen.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(ProfileDosenRequest $request)
    {
        $foto = $request->file('foto_profile');
        $nama_foto_profile = Str::random() . '.' . $foto->getClientOriginalExtension();
        $foto->move('uploads/foto_profile', $nama_foto_profile);
        $user = User::find(Auth::user()->id);
        $user->profile_picture = $nama_foto_profile;
        $user->name = $request->nama_dosen;
        $user->save();

        $profileDosen = [
            'nip' => $request->nip,
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => 'Aktif',
            'user_id' => Auth::user()->id,
        ];

        $insertProfile = Dosen::create($profileDosen);
        $idProfileDosen = $insertProfile->id;
        Dosen::find($idProfileDosen)->update([
            'encrypt_id' => Crypt::encrypt($idProfileDosen)
        ]);

        //insert data ketable jabatan dosen
        $file_sk_jabatan = $request->file('file_sk_jabatan');
        $nama_file_sk_jabatan = Str::random() . '.' . $file_sk_jabatan->getClientOriginalExtension();
        $file_sk_jabatan->move('uploads/sk_jabatan_dosen', $nama_file_sk_jabatan);
        $dataJabatan = [
            'jabatan' => $request->jabatan,
            'tgl_sk' => $request->tanggal_sk_jabatan,
            'file_sk' => $nama_file_sk_jabatan,
            'dosen_id' => $idProfileDosen,
        ];
        $insertJabatan = HistoryJabatanDosen::create($dataJabatan);
        $idJabatan = $insertJabatan->id;
        HistoryJabatanDosen::find($idJabatan)->update([
            'encrypted_id' => Crypt::encrypt($idJabatan)
        ]);
        //end insert data ketable jabatan dosen
        //insert data ketable pangkat dosen
        $file_sk_pangkat = $request->file('file_sk_pangkat');
        $nama_file_sk_pangkat = Str::random() . '.' . $file_sk_pangkat->getClientOriginalExtension();
        $file_sk_pangkat->move('uploads/sk_pangkat_dosen', $nama_file_sk_pangkat);
        $dataPangkat = [
            'kepangkatan' => $request->kepangkatan,
            'tgl_sk' => $request->tanggal_sk_pangkat,
            'file_sk' => $nama_file_sk_pangkat,
            'dosen_id' => $idProfileDosen,
        ];
        $insertPangkat = HistoryPangkatDosen::create($dataPangkat);
        $idPangkat = $insertPangkat->id;
        HistoryPangkatDosen::find($idPangkat)->update([
            'encrypted_id' => Crypt::encrypt($idPangkat)
        ]);
        //end insert data ketable pangkat dosen
        return redirect()->route('dosen.profile.index')->with('success', 'Profile Berhasil Disimpan');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->dosen->nip != $id) {
            return redirect()->back();
        }
        $dosen = Dosen::where('nip', $id)->first();
        return view('dosen.profile.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileDosenRequest $request, $id)
    {
        if (Auth::user()->dosen->nip != $id) {
            return redirect()->back();
        }
        $dosen = Dosen::where('nip', $id)->first();
        $user = User::find(Auth::user()->id);

        if ($request->file('foto_profile') != null) {
            $foto = $request->file('foto_profile');
            $nama_foto = $foto->hashName();
            if ($user->profile_picture != 'default.png') {
                unlink('uploads/profile/' . $user->profile_picture);
            }
            $foto->move('uploads/profile', $nama_foto);
            $user->profile_picture = $nama_foto;
        }
        $user->name = $request->nama_dosen;
        $user->save();
        $dosen->nip = $request->nip;
        $dosen->nidn = $request->nidn;
        $dosen->nama_dosen = $request->nama_dosen;
        $dosen->no_hp = $request->no_hp;
        $dosen->tanggal_lahir = $request->tanggal_lahir;
        $dosen->tempat_lahir = $request->tempat_lahir;
        $dosen->alamat = $request->alamat;
        $dosen->jenis_kelamin = $request->gender;
        $dosen->updated_at = date('Y-m-d H:i:s');
        $dosen->save();
        return redirect()->route('dosen.profile.index')->with('success', 'Profile Berhasil Diperbarui');
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


    public function export()
    {
        $penelitian = LitabmasDosen::whereHas('dosen', function ($q) {
            $q->where('dosen.id', Auth::user()->dosen->id);
        })->where('kategori', 'Penelitian')->get();
        $pengabdian = LitabmasDosen::whereHas('dosen', function ($q) {
            $q->where('dosen.id', Auth::user()->dosen->id);
        })->where('kategori', 'Pengabdian')->get();
        $publikasi = PublikasiDosen::whereHas('dosen', function ($q) {
            $q->where('dosen.id', Auth::user()->dosen->id);
        })->get();
        $gelar = ModelGelar::where('dosen_id', Auth::user()->dosen->id)->get();
        $seminar = ModelSPDosen::where('jenis', 'Seminar')->where('dosen_id', Auth::user()->dosen->id)->get();
        $penghargaan = ModelSPDosen::where('jenis', 'Penghargaan')->where('dosen_id', Auth::user()->dosen->id)->get();
        $gelar_pendidikan = [
            'S.Pd.',          // Sarjana Pendidikan
            'S.Kom.',         // Sarjana Komputer
            'S.Si.',          // Sarjana Sains
            'S.T.',           // Sarjana Teknik
            'M.Pd.',          // Magister Pendidikan
            'M.Kom.',         // Magister Komputer
            'M.Si.',          // Magister Sains
            'M.T.',           // Magister Teknik
            'Dr.',            // Doktor
            'Ph.D.',          // Doctor of Philosophy (Ph.D.)
            'Prof.',          // Profesor
            'Ir.',            // Insinyur
            'Drs.',           // Diploma
            'Dra.',           // Diploma
            'ST.',            // Sarjana Teknik
            'H.',             // Haji (Hajah for female)
            'B.Sc.',          // Bachelor of Science
            'M.Sc.',          // Master of Science
            'B.A.',           // Bachelor of Arts
            'M.A.',           // Master of Arts
            'B.Eng.',         // Bachelor of Engineering
            'M.Eng.',         // Master of Engineering
            'LLB',            // Bachelor of Laws
            'LLM',            // Master of Laws
            'Pharm.D.',       // Doctor of Pharmacy
            'D.V.M.',         // Doctor of Veterinary Medicine
            'M.D.',           // Doctor of Medicine
            'J.D.',           // Juris Doctor
            'B.B.A.',         // Bachelor of Business Administration
            'M.B.A.',         // Master of Business Administration
            'B.Sc.N.',        // Bachelor of Science in Nursing
            'M.Sc.N.',        // Master of Science in Nursing
            'B.Pharm.',       // Bachelor of Pharmacy
            'M.Pharm.',       // Master of Pharmacy
            'B.H.Sc.',        // Bachelor of Health Sciences
            'M.H.Sc.',        // Master of Health Sciences
            'B.F.A.',         // Bachelor of Fine Arts
            'M.F.A.',           // Master of Fine Arts
            'Ph.D, S.Si, M.Si',
            'Eng.',
        ];
        $nama = str_replace($gelar_pendidikan, '', Auth::user()->dosen->nama_dosen);
        $nama = str_replace(',', '', $nama);


        $data = [
            'penelitian' => $penelitian,
            'pengabdian' => $pengabdian,
            'publikasi' => $publikasi,
            'organisasi' => Auth::user()->dosen->organisasi,
            'nama' => trim($nama),
            'gelar' => $gelar,
            'seminar' => $seminar,
            'penghargaan' => $penghargaan,
        ];

        $option = new Options();
        $option->set('isRemoteEnabled', true);
        $option->set('defaultPaperSize', 'A4');
        $option->set('marginTop', 0);
        $view =  view('dosen.cv.index', $data);
        $domPdf = new Dompdf();
        $domPdf->loadHtml($view->render());
        $domPdf->render();
        $pdf = PDF::loadView('dosen.cv.index', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([$option]);
        return $pdf->stream('cv.pdf');
    }
}
