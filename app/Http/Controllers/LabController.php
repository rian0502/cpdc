<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Laboratorium;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreActivityLab;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

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
            'locations' => Lokasi::all()
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
        //
        $data = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan' => $request->keperluan,
            'id_lokasi' => Crypt::decrypt($request->id_lokasi),
            'keterangan' => $request->ket,
            'jumlah_mahasisiswa' => $request->jumlah_mahasiswa,
            'created_at' => now()
        ];
        $insert = Laboratorium::create($data);
        $id = Crypt::encrypt($insert->id);
        $update = Laboratorium::where('id', $insert->id)->update(['encrypted_id' => $id]);
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
        //
        $data = [
            'lab' => Laboratorium::where('id', Crypt::decrypt($id))->first(),
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
        //
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
    public function chartAktivitasLab(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->input('startDate', null);
            $endDate = $request->input('endDate', null);
            $lokasi = $request->input('lokasi', null);

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
                    $data['jumlah_jam_aktivitas'][] = (int)$jumlah_jam_aktivitas;
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
                    $data['jumlah_jam_aktivitas'][] = (int)$jumlah_jam_aktivitas;
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
                        $data['jumlah_jam_aktivitas'][] = (int)$jumlah_jam_aktivitas;
                        $data['jumlah_mahasiswa'][] = (int)$jumlah_mahasiswa;
                        $data['jumlah_praktikum'][] = $jumlah_praktikum;
                        $data['jumlah_seminar'][] = $jumlah_seminar;
                        $data['jumlah_ujian'][] = $jumlah_ujian;
                        $data['jumlah_penelitian'][] = $jumlah_penelitian;
                        $data['jumlah_kegiatan_lainnya'][] = $jumlah_kegiatan_lainnya;

                }
            } elseif ($startDate == null && $endDate == null && $lokasi != null || $lokasi != 'all') {
                foreach ($categories as $day) {
                    $jumlah_jam_aktivitas = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->sum(DB::raw('jam_selesai - jam_mulai'));

                    $jumlah_mahasiswa = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->sum('jumlah_mahasiswa');


                    $jumlah_praktikum = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Praktikum')
                        ->count();

                    $jumlah_seminar = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Seminar')
                        ->count();

                    $jumlah_ujian = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Ujian')
                        ->count();

                    $jumlah_penelitian = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Penelitian')
                        ->count();

                    $jumlah_kegiatan_lainnya = Laboratorium::whereRaw("DAYNAME(tanggal_kegiatan) = '{$day}'")
                        ->when($lokasi, function ($query) use ($lokasi) {
                            return $query->where('id_lokasi', $lokasi);
                        })
                        ->where('keperluan', 'Lainnya')
                        ->count();
                    $data['categories'][] = $day; // ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday
                    $data['jumlah_jam_aktivitas'][] = (int)$jumlah_jam_aktivitas;
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
            $model = Laboratorium::query();

            return DataTables::of($model)
                ->addColumn('nama_lokasi', function ($model) {
                    return $model->lokasi->nama_lokasi;
                })
                ->toJson();
        }
    }
}
