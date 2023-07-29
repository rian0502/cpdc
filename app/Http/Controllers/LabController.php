<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Laboratorium;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreActivityLab;
use App\Models\AsistenLab as ModelsAsistenLab;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Contracts\DataTable;

use function PHPUnit\Framework\at;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = [
        //     'activities' => Laboratorium::all()
        // ];
        return view('admin.admin_lab.lab.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'mahasiswa' => Mahasiswa::select('id', 'npm', 'nama_mahasiswa')->where('status', 'Aktif')->get(),
        ];
        return view('admin.admin_lab.lab.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityLab $request)
    {
        $data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan' => $request->keperluan,
            'id_lokasi' => Auth::user()->lokasi_id,
            'keterangan' => $request->ket,
            'jumlah_mahasiswa' => $request->jumlah_mahasiswa,
        ];
        $insert = Laboratorium::create($data);
        $activity = $insert->id;
        $id = Crypt::encrypt($insert->id);
        $update = Laboratorium::where('id', $insert->id)->update(['encrypted_id' => $id]);
        if ($request->keperluan == "Praktikum") {
            for ($i = 0; $i < count($request->anggota_asistensi); $i++) {
                $data = [
                    'id_actity_lab' => $activity,
                    'id_mahasiswa' => $request->anggota_asistensi[$i],
                ];
                $insert = ModelsAsistenLab::create($data);
            }
        }
        if ($update) {
            return redirect()->route('lab.ruang.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('lab.ruang.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lab = Laboratorium::where('id', Crypt::decrypt($id))->first();
        $data = [
            'lab' => $lab,
            'anggota' => $lab->keperluan == "Praktikum" ? ModelsAsistenLab::where('id_actity_lab', $lab->id)->get() : null,
        ];
        return view('admin.admin_lab.lab.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lab = Laboratorium::find(Crypt::decrypt($id));
        $locations = Lokasi::where('jenis_ruangan', 'Lab')->get();
        $data = [
            'lab' => $lab,
            'locations' => $locations,
            'mahasiswa' => Mahasiswa::select('id', 'npm', 'nama_mahasiswa')->where('status', 'Aktif')->get(),
            'anggota' =>  $lab->keperluan == "Praktikum" ? $lab->asisten->pluck('id_mahasiswa')->toArray() : [],
        ];

        return view('admin.admin_lab.lab.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreActivityLab $request, $id)
    {

        $lab = Laboratorium::find(Crypt::decrypt($id));
        if ($lab->keperluan == 'Praktikum' && $request->keperluan != 'Praktikum') {
            $lab->mahasiswa()->detach();
        }
        if ($request->keperluan == 'Praktikum') {
            $lab->mahasiswa()->sync($request->anggota_asistensi);
        }
        $lab->nama_kegiatan = $request->nama_kegiatan;
        $lab->keperluan = $request->keperluan;
        $lab->keterangan = $request->ket;
        $lab->jumlah_mahasiswa = $request->jumlah_mahasiswa;
        $lab->jam_mulai = $request->jam_mulai;
        $lab->jam_selesai = $request->jam_selesai;
        $lab->tanggal_kegiatan = $request->tanggal_kegiatan;
        $lab->updated_at = date('Y-m-d H:i:s');
        $lab->save();
        return redirect()->route('lab.ruang.index')->with('success', 'Data berhasil diubah');
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
        $lab = Laboratorium::find(Crypt::decrypt($id));
        $lab->delete();
        return redirect()->route('lab.ruang.index')->with('success', 'Data berhasil dihapus');
    }

    public function tableAktivitasLab(Request $request)
    {
        if ($request->ajax()) {
            // return dd($request->all());
            $startDate = $request->input('startDate', null);
            $endDate = $request->input('endDate', null);
            $id = Auth::user()->lokasi_id;
            $asisten = Mahasiswa::with(['asisten_lab'])->whereHas('asisten_lab', function ($query) use ($id, $startDate, $endDate) {
                $query->whereHas('lokasi', function ($query) use ($id, $startDate, $endDate) {
                    if($startDate != null && $endDate != null){
                        $query->whereBetween('tanggal_kegiatan', [$startDate, $endDate]);
                    }

                    //tambahkan col pengurangan  jam_selesai - jam_mulai
                    $query->where('id_lokasi', '=', $id);
                });
            })->get();

            $asisten->transform(function ($mahasiswa) {
                $totalDurasi = 0;
                // Jumlahkan durasi dari setiap kegiatan asisten_lab
                foreach ($mahasiswa->asisten_lab as $asisten_lab) {
                    $durasi = $this->hitungSelisihWaktu($asisten_lab->jam_mulai, $asisten_lab->jam_selesai);
                    $totalDurasi += $durasi;
                }
                
                // Konversi totalDurasi ke format HH:mm:ss
                $totalDurasi = gmdate("H:i:s", $totalDurasi);
                
                // Simpan totalDurasi sebagai kolom tambahan pada data mahasiswa
                $mahasiswa->total_durasi = $totalDurasi;
                $mahasiswa->kehadiran = count($mahasiswa->asisten_lab);
                
                return $mahasiswa;
            });
            return DataTables::of($asisten)->toJson();
        }
    }
    function hitungSelisihWaktu($jamMulai, $jamSelesai)
    {
        $mulai = Carbon::parse($jamMulai);
        $selesai = Carbon::parse($jamSelesai);
        $selisih = $selesai->diffInSeconds($mulai);
        return $selisih;
    }



    public function chartAktivitasLab(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->input('startDate', null);
            $endDate = $request->input('endDate', null);
            $lokasi = $request->input('lokasi', Auth::user()->lokasi_id);

            $categories = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            $data = [
                'categories' => $categories,
                'jumlah_jam_aktivitas' => [],
                'jumlah_mahasiswa' => [],
                'jumlah_praktikum' => [],
                'jumlah_seminar' => [],
                'jumlah_ujian' => [],
                'jumlah_penelitian' => [],
                'jumlah_kegiatan_lainnya' => []
            ];
            if ($startDate != null && $endDate != null && $lokasi != null && $lokasi != 'all') {
                foreach ($categories as $day) {
                    $jumlah_jam_aktivitas = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->sum(DB::raw('jam_selesai - jam_mulai'));

                    $jumlah_mahasiswa = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->sum('jumlah_mahasiswa');


                    $jumlah_praktikum = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Praktikum')
                        ->count();

                    $jumlah_seminar = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Seminar')
                        ->count();

                    $jumlah_ujian = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Ujian')
                        ->count();

                    $jumlah_penelitian = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Penelitian')
                        ->count();

                    $jumlah_kegiatan_lainnya = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Lainnya')
                        ->count();
                    $data['categories'][] = $day; // ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday
                    $data['jumlah_jam_aktivitas'][] = (float)$jumlah_jam_aktivitas / 10000;
                    $data['jumlah_mahasiswa'][] = (int)$jumlah_mahasiswa;
                    $data['jumlah_praktikum'][] = $jumlah_praktikum;
                    $data['jumlah_seminar'][] = $jumlah_seminar;
                    $data['jumlah_ujian'][] = $jumlah_ujian;
                    $data['jumlah_penelitian'][] = $jumlah_penelitian;
                    $data['jumlah_kegiatan_lainnya'][] = $jumlah_kegiatan_lainnya;
                }
            } elseif ($startDate != null && $endDate != null && $lokasi == null || $lokasi == 'all') {
                foreach ($categories as $day) {
                    $jumlah_jam_aktivitas = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->sum(DB::raw('jam_selesai - jam_mulai'));

                    $jumlah_mahasiswa = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->sum('jumlah_mahasiswa');


                    $jumlah_praktikum = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->where('keperluan', 'Praktikum')
                        ->count();

                    $jumlah_seminar = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->where('keperluan', 'Seminar')
                        ->count();

                    $jumlah_ujian = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->where('keperluan', 'Ujian')
                        ->count();

                    $jumlah_penelitian = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->where('keperluan', 'Penelitian')
                        ->count();

                    $jumlah_kegiatan_lainnya = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($startDate, function ($query) use ($startDate) {
                            return $query->where('tanggal_kegiatan', '>=', $startDate);
                        })
                        ->when($endDate, function ($query) use ($endDate) {
                            return $query->where('tanggal_kegiatan', '<=', $endDate);
                        })
                        ->where('keperluan', 'Lainnya')
                        ->count();
                    $data['categories'][] = $day; // ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday
                    $data['jumlah_jam_aktivitas'][] = (float)$jumlah_jam_aktivitas / 10000;
                    $data['jumlah_mahasiswa'][] = (int)$jumlah_mahasiswa;
                    $data['jumlah_praktikum'][] = $jumlah_praktikum;
                    $data['jumlah_seminar'][] = $jumlah_seminar;
                    $data['jumlah_ujian'][] = $jumlah_ujian;
                    $data['jumlah_penelitian'][] = $jumlah_penelitian;
                    $data['jumlah_kegiatan_lainnya'][] = $jumlah_kegiatan_lainnya;;
                }
            } elseif ($startDate == null && $endDate == null && $lokasi == null || $lokasi == 'all') {

                foreach ($categories as $day) {
                    $jumlah_jam_aktivitas = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->sum(DB::raw('jam_selesai - jam_mulai'));

                    $jumlah_mahasiswa = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->sum('jumlah_mahasiswa');


                    $jumlah_praktikum = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->where('keperluan', 'Praktikum')
                        ->count();

                    $jumlah_seminar = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->where('keperluan', 'Seminar')
                        ->count();

                    $jumlah_ujian = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->where('keperluan', 'Ujian')
                        ->count();

                    $jumlah_penelitian = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->where('keperluan', 'Penelitian')
                        ->count();

                    $jumlah_kegiatan_lainnya = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->where('keperluan', 'Lainnya')
                        ->count();
                    $data['categories'][] = $day; // ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday
                    $data['jumlah_jam_aktivitas'][] = (float)$jumlah_jam_aktivitas / 10000;
                    $data['jumlah_mahasiswa'][] = (int)$jumlah_mahasiswa;
                    $data['jumlah_praktikum'][] = $jumlah_praktikum;
                    $data['jumlah_seminar'][] = $jumlah_seminar;
                    $data['jumlah_ujian'][] = $jumlah_ujian;
                    $data['jumlah_penelitian'][] = $jumlah_penelitian;
                    $data['jumlah_kegiatan_lainnya'][] = $jumlah_kegiatan_lainnya;
                }
            } elseif ($startDate == null && $endDate == null && $lokasi != null || $lokasi != 'all') {

                foreach ($categories as $day) {
                    $jumlah_jam_aktivitas = Laboratorium::where('id_lokasi', $lokasi)->whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")

                        ->sum(DB::raw('jam_selesai - jam_mulai'));


                    $jumlah_mahasiswa = Laboratorium::where('id_lokasi', $lokasi)->whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")

                        ->sum('jumlah_mahasiswa');


                    $jumlah_praktikum = Laboratorium::where('id_lokasi', $lokasi)->whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Praktikum')
                        ->count();

                    $jumlah_seminar = Laboratorium::where('id_lokasi', $lokasi)->whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")

                        ->where('keperluan', 'Seminar')
                        ->count();

                    $jumlah_ujian = Laboratorium::where('id_lokasi', $lokasi)->whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")

                        ->where('keperluan', 'Ujian')
                        ->count();

                    $jumlah_penelitian = Laboratorium::where('id_lokasi', $lokasi)->whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")

                        ->where('keperluan', 'Penelitian')
                        ->count();

                    $jumlah_kegiatan_lainnya = Laboratorium::where('id_lokasi', $lokasi)->whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")

                        ->where('keperluan', 'Lainnya')
                        ->count();
                    $data['categories'][] = $day; // ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday
                    $data['jumlah_jam_aktivitas'][] = (float)$jumlah_jam_aktivitas / 10000;
                    $data['jumlah_mahasiswa'][] = (int)$jumlah_mahasiswa;

                    $data['jumlah_praktikum'][] = $jumlah_praktikum;
                    $data['jumlah_seminar'][] = $jumlah_seminar;
                    $data['jumlah_ujian'][] = $jumlah_ujian;
                    $data['jumlah_penelitian'][] = $jumlah_penelitian;
                    $data['jumlah_kegiatan_lainnya'][] = $jumlah_kegiatan_lainnya;;
                }
            }

            return response()->json($data);
        }
    }



    public function dataLaboratorium(Request $request)
    {
        if ($request->ajax()) {
            $model = Laboratorium::where('id_lokasi', Auth::user()->lokasi_id)->orderBY('tanggal_kegiatan', 'desc');
            return DataTables::of($model)
                ->addColumn('nama_lokasi', function ($model) {
                    return $model->lokasi->nama_lokasi;
                })
                ->addColumn('waktu', function ($model) {
                    return date(date('H:i', strtotime($model->jam_mulai)) . ' - ' . date('H:i', strtotime($model->jam_selesai)));
                })
                ->toJson();
        }
    }
}
