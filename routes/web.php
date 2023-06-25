<?php

use App\Models\JadwalSKP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KPcontroller;
use App\Http\Controllers\LabController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\TA1Controller;
use App\Http\Controllers\TA2Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\ModelJadwalSeminarTaSatu;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KompreController;
use App\Http\Controllers\BaseNpmController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LitabmasController;
use App\Http\Controllers\AkunAdminController;
use App\Http\Controllers\AkunDosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalPKLController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\Kajur\LokasiController;
use App\Http\Controllers\PangkatAdminController;
use App\Http\Controllers\PangkatDosenController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileDosenController;
use App\Http\Controllers\ValidasiUsulController;
use App\Http\Controllers\AkunMahasiswaController;
use App\Http\Controllers\ValidasiBaPKLController;
use App\Http\Controllers\ValidasiKompreController;
use App\Http\Controllers\ValidasiSemhasController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\BerkasPersyaratanController;
use App\Http\Controllers\KegiatanMahasiswaController;
use App\Http\Controllers\PrestasiMahasiswaController;
use App\Http\Controllers\ValidasiBerkasTA1Controller;
use App\Http\Controllers\ValidasiBerkasTA2Controller;
use App\Http\Controllers\ValidasiSeminarKPController;
use App\Http\Controllers\Kajur\LitabmasDataController;
use App\Http\Controllers\Kajur\PrestasiDataController;
use App\Http\Controllers\Kajur\AktivitasDataController;
use App\Http\Controllers\Kajur\PublikasiDataController;
use App\Http\Controllers\BeritaAcaraSeminarKerjaPraktik;
use App\Http\Controllers\komprehensif\MahasiswaBaKompre;
use App\Http\Controllers\MahasiswaBimbinganKPController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\MahasiswaBimbinganTA1Controller;
use App\Http\Controllers\MahasiswaBimbinganTA2Controller;
use App\Http\Controllers\tugas_akhir_dua\MahasiswaBaTaDua;
use App\Http\Controllers\tugas_akhir_dua\PenjadwalanTaDua;
use App\Http\Controllers\tugas_akhir_satu\MahasiswaBaTaSatu;
use App\Http\Controllers\tugas_akhir_satu\PenjadwalanTaSatu;
use App\Http\Controllers\MahasiswaBimbinganAkademikController;
use App\Http\Controllers\tugas_akhir_satu\ValidasiAdminTaSatu;
use App\Http\Controllers\tugas_akhir_dua\MahasiswaTaDuaController;
use App\Http\Controllers\tugas_akhir_satu\MahasiswaTaSatuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Admin Keseluruhan
Route::get('admin/profile/create', [ProfileAdminController::class, 'create'])->name('admin.profile.create')->middleware('auth', 'verified', 'role:admin lab|admin berkas');
Route::post('admin/profile/store', [ProfileAdminController::class, 'store'])->name('admin.profile.store')->middleware('auth', 'verified', 'role:admin lab|admin berkas');
Route::prefix('admin/')->name('admin.')->middleware(['auth', 'profile', 'verified', 'role:admin lab|admin berkas'])->group(function () {
    Route::resource('profile', ProfileAdminController::class, ['only' => ['index', 'edit', 'update']])->names('profile');
    Route::resource('profile/pangkat', PangkatAdminController::class)->names('pangkat');
});
// end Admin Keseluruhan

// ADMIN LAB
Route::prefix('admin/lab')->name('lab.')->middleware(['auth', 'profile', 'verified', 'role:admin lab'])->group(function () {
    Route::resource('model', ModelController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('ruang', LabController::class);
    Route::resource('sop', SopController::class);
    Route::resource('barang/history', HistoryController::class)->names(
        [
            'index' => 'barang.history.index',
            'create' => 'barang.history.create',
            'store' => 'barang.history.store',
            'show' => 'barang.history.show',
            'edit' => 'barang.history.edit',
            'update' => 'barang.history.update',
            'destroy' => 'barang.history.destroy',
        ]
    );
    //chart line aktivitas lab
});
Route::get('chart/aktivitas', [LabController::class, 'chartAktivitasLab'])->name('chart.aktivitas.lab')->middleware('auth', 'verified', 'role:admin lab|jurusan');
Route::get('chart/usiadosen', [AkunDosenController::class, 'chartUsiaDosen'])->name('chart.usia.dosen')->middleware('auth', 'verified', 'role:jurusan');
Route::get('chart/jabatandosen', [AkunDosenController::class, 'chartJabatanDosen'])->name('chart.jabatan.dosen')->middleware('auth', 'verified', 'role:jurusan');
// end ADMIN LAB

//admin berkas
Route::prefix('admin/berkas')->name('berkas.')->middleware(['auth', 'profile', 'verified', 'role:admin berkas'])->group(function () {
    Route::resource('berkas_persyaratan', BerkasPersyaratanController::class)->except([
        'create', 'store', 'show', 'destroy'
    ]);
    Route::resource('validasi/seminar/kp', ValidasiSeminarKPController::class)->names('validasi.seminar.kp');
    Route::resource('validasi/seminar/ta1', ValidasiAdminTaSatu::class)->names('validasi.seminar.ta1');
    Route::resource('validasai/seminar/ta2', ValidasiBerkasTA2Controller::class)->names('validasi.seminar.ta2');
    Route::resource('validasi/sidang/kompre', ValidasiKompreController::class)->names('validasi.sidang.kompre');
});
//end admin berkas

//dosen
Route::get('dosen/profile/create', [ProfileDosenController::class, 'create'])->name('dosen.profile.create')->middleware('auth', 'verified', 'role:dosen');
Route::post('dosen/profile/store', [ProfileDosenController::class, 'store'])->name('dosen.profile.store')->middleware('auth', 'verified', 'role:dosen');

route::prefix('/dosen')->name('dosen.')->middleware(['auth', 'profile', 'verified', 'role:dosen'])->group(function () {
    Route::resource('litabmas', LitabmasController::class);
    Route::resource('organisasi', OrganisasiController::class);
    Route::resource('publikasi', PublikasiController::class);
    Route::resource('profile', ProfileDosenController::class, ['only' => ['index', 'edit', 'update']])->names('profile');
    Route::resource('jabatan', JabatanController::class);
    Route::resource('pangkat', PangkatDosenController::class);
    Route::resource('mahasiswa/bimbingan/akademik', MahasiswaBimbinganAkademikController::class)->names('mahasiswa.bimbingan.akademik');
    Route::resource('mahasiswa/bimbingan/kp', MahasiswaBimbinganKPController::class)->names('mahasiswa.bimbingan.kp');
    Route::resource('mahasiswa/bimbingan/ta1', MahasiswaBimbinganTA1Controller::class)->names('mahasiswa.bimbingan.ta1');
    Route::resource('mahasiswa/bimbingan/ta2', MahasiswaBimbinganTA2Controller::class)->names('mahasiswa.bimbingan.ta2');
});
//end dosen

Route::prefix('koor')->name('koor.')->group(function () {
    Route::resource('jadwalPKL', JadwalPKLController::class)->middleware(['auth', 'profile', 'verified', 'role:pkl'])->names('jadwalPKL');
    Route::resource('jadwalTA1', PenjadwalanTaSatu::class)->middleware(['auth', 'profile', 'verified', 'role:ta1'])->names('jadwalTA1');
    Route::resource('jadwalTA2', PenjadwalanTaDua::class)->middleware(['auth', 'profile', 'verified', 'role:ta2'])->names('jadwalTA2');
    Route::get('/jadwalPPKL/resend/{id}', [JadwalPKLController::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:pkl'])->name('jadwalPKL.resend');
    Route::resource('validasiBaPKL', ValidasiBaPKLController::class)->middleware(['auth', 'profile', 'verified', 'role:pkl'])->names('validasiBaPKL');
});


//jurusan
Route::prefix('jurusan')->name('jurusan.')->middleware('auth', 'profile', 'verified', 'role:jurusan')->group(function () {
    Route::resource('lokasi', LokasiController::class);
    //prestasi
    Route::resource('prestasi', PrestasiDataController::class);
    Route::resource('aktivitas', AktivitasDataController::class);
    Route::resource('publikasi', PublikasiDataController::class);
    Route::resource('litabmas', LitabmasDataController::class);
    Route::get('chartCapaianPrestasi', [PrestasiDataController::class, 'pieChartCapaian'])->name('prestasi.chartCapaian');
    Route::get('chartScalaPrestasi', [PrestasiDataController::class, 'pieChartScala'])->name('prestasi.chartScala');
    Route::get('barChartPrestasi', [PrestasiDataController::class, 'barChartPrestasi'])->name('prestasi.barChartPrestasi');
    Route::get('barChartAktivitas', [AktivitasDataController::class, 'barChartAktivitas'])->name('aktivitas.barChartAktivitas');
    Route::get('pieChartAktivitas', [AktivitasDataController::class, 'pieChartPeran'])->name('aktivitas.pieChartPeran');
    Route::get('pieChartScalaPublikasi', [PublikasiDataController::class, 'pieChartScala'])->name('publikasi.pieChartScala');
    Route::get('pieChartKategoriPublikasi', [PublikasiDataController::class, 'pieChartKategori'])->name('publikasi.pieChartKategori');
    Route::get('pieChartKategoriLitabmasPublikasi', [PublikasiDataController::class, 'pieChartKategoriLitabmas'])->name('publikasi.pieChartKategoriLitabmas');
    Route::get('barChartTahunPublikasi', [PublikasiDataController::class, 'barChartTahun'])->name('publikasi.barChartTahun');
    Route::get('barChartTahunLitabmas', [LitabmasDataController::class, 'barChartTahun'])->name('litabmas.barChartTahun');
    Route::get('pieChartKategoriLitabmas', [LitabmasDataController::class, 'pieChartKategoriLitabmas'])->name('litabmas.pieChartKategoriLitabmas');
});
//end jurusan
Route::get('mahasiswa/profile/create', [ProfileMahasiswaController::class, 'create'])->name('mahasiswa.profile.create')->middleware('auth', 'verified', 'role:mahasiswa');
Route::post('mahasiswa/profile/store', [ProfileMahasiswaController::class, 'store'])->name('mahasiswa.profile.store')->middleware('auth', 'verified', 'role:mahasiswa');

Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth', 'profile', 'verified', 'role:mahasiswa')->group(function () {
    Route::resource('profile', ProfileMahasiswaController::class, ['only' => ['index', 'edit', 'update']])->names('profile');
    Route::resource('prestasi', PrestasiMahasiswaController::class)->names('prestasi');
    Route::resource('kegiatan', KegiatanMahasiswaController::class)->names('kegiatan');
    Route::resource('bakerjapraktik', BeritaAcaraSeminarKerjaPraktik::class)->names('bakerjapraktik');
    Route::resource('bata1', MahasiswaBaTaSatu::class)->names('bata1');
    Route::resource('bata2', MahasiswaBaTaDua::class)->names('bata2');
    Route::resource('bakompre', MahasiswaBaKompre::class)->names('bakompre');

    Route::group(['prefix' => 'seminar', 'as' => 'seminar.'], function () {
        Route::resource('kp', KPcontroller::class)->names('kp');
        Route::resource('tugas_akhir_1', MahasiswaTaSatuController::class)->names('tugas_akhir_1');
        Route::resource('tugas_akhir_2', MahasiswaTaDuaController::class)->names('tugas_akhir_2');
    });
    Route::group(['prefix' => 'sidang', 'as' => 'sidang.'], function () {
        Route::resource('kompre', KompreController::class)->names('kompre');
    });
});


//AUTH
Route::get('reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::name('auth.')->middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'loginAttempt'])->name('login.post');
    Route::post('/link-reset', [AuthController::class, 'sendResetLinkEmail'])->name('password.link.post');
    Route::post('/update', [AuthController::class, 'resetPassword'])->name('password.update.post');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.forgot');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'attemptRegister'])->name('register.post');
});
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');
Route::get('/settings', [AuthController::class, 'settings'])->middleware('auth')->name('auth.settings');
Route::post('/change-password', [AuthController::class, 'changePassword'])->middleware('auth')->name('auth.change.password');
//end AUTH

//routing untuk aktivasi email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    if (auth()->user()) {
        $request->fulfill();
    } else {
        return redirect('/login')->with('error', 'Login dulu Sebelum Vertifikasi!');
    }
    return redirect('/dashboard')->with('success', 'Akun Berhasil di Aktivasi !');
})->name('verification.verify');


Route::get(
    '/email/verify',
    [AuthController::class, 'reactivation']
)->middleware(['auth', 'unverified'])->name('verification.notice');

Route::get(
    '/email/activation-notification',
    function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
)->middleware(['auth', 'unverified', 'throttle:6,1'])->name('activation.send');
//end routing untuk aktivasi email


// Extra activity mahasiswa start
Route::get('/mahasiswa/kegiatan/create', function () {
    return view('mahasiswa.kegiatan.create');
});
Route::get('/mahasiswa/kegiatan/edit', function () {
    return view('mahasiswa.kegiatan.edit');
});
// Extra activity mahasiswa end

//pendaftaran seminar
Route::get('/seminar/create', function () {
    return view('mahasiswa.seminar.create');
})->name('mahasiswa.seminar.create');
Route::get('/seminar/edit', function () {
    return view('mahasiswa.seminar.edit');
})->name('mahasiswa.seminar.edit');
Route::get('/seminar/detail', function () {
    return view('mahasiswa.seminar.detail');
})->name('mahasiswa.seminar.detail');


Route::prefix('user')->name('user.')->group(function () {
    Route::resource('profile', UserController::class);
});


Route::prefix('dosen')->name('dosen.')->group(function () {
});





Route::prefix('sudo')->name('sudo.')->middleware(['auth', 'verified', 'role:sudo|jurusan'])->group(function () {
    Route::resource('akun_dosen', AkunDosenController::class);
    Route::resource('akun_mahasiswa', AkunMahasiswaController::class);
    Route::post('base_npm/add/excel', [BaseNpmController::class, 'storeExcel'])->name('base_npm.store.excel');
    Route::resource('akun_admin', AkunAdminController::class);
    Route::resource('base_npm', BaseNpmController::class);
    Route::get('BaseNpm', [BaseNpmController::class, 'BaseNpm'])->name('base_npm.ajax');
});

// route FE

// CONTOH
// Route::prefix('fe')->name('fe')->group(function () {
//     Route::get('kategori/create', function () {
//         return view('admin.inventaris.kategori.create');
//     })->name('admin.kategori.create');
//     Route::view('dosen/profile', 'dosen.profile.index');
// });


Route::get('/', function () {
    return view('index');
});
Route::get('/team', function () {
    return view('team');
});
Route::get('/kp', function () {
    $jadwal_kp = JadwalSKP::where('tanggal_skp', '>=', date('Y-m-d'))->get();
    return view('kp', compact('jadwal_kp'));
});
Route::get('/ta1', function () {
    $jadwal_ta1 = ModelJadwalSeminarTaSatu::where('tanggal_seminar_ta_satu', '>=', date('Y-m-d'))->get();
    return view('ta1', compact('jadwal_ta1'));
});
Route::get('/ta2', function () {
    return view('ta2');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'profile', 'verified'])->name('dashboard');

Route::get('/reset-password', function () {
    return view('auth.reset');
})->name('reset');
