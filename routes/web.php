<?php

use App\Models\User;
use App\Models\JadwalSKP;
use Illuminate\Http\Request;
use App\Http\Controllers\Kalab;
use App\Http\Controllers\ResetTA;
use App\Models\ModelSeminarKompre;
use App\Http\Controllers\DataAlumni;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminJurusan;
use App\Http\Controllers\AlokasiDosen;
use App\Http\Controllers\KPcontroller;
use App\Http\Controllers\CirculumVitae;
use App\Http\Controllers\LabController;
use App\Http\Controllers\SopController;
use App\Models\ModelJadwalSeminarTaDua;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\ModelJadwalSeminarKompre;
use App\Models\ModelJadwalSeminarTaSatu;
use App\Http\Controllers\LabTAController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\PendataanAlumni;
use App\Http\Controllers\BarangController;
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
use App\Http\Controllers\ChartSeminarController;
use App\Http\Controllers\Kajur\LokasiController;
use App\Http\Controllers\PangkatAdminController;
use App\Http\Controllers\PangkatDosenController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileDosenController;
use App\Http\Controllers\AkunMahasiswaController;
use App\Http\Controllers\ValidasiBaPKLController;
use App\Http\Controllers\ValidasiPendataanAlumni;
use App\Http\Controllers\AktivitasAlumniController;
use App\Http\Controllers\DataMahasiswaAllController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\BerkasPersyaratanController;
use App\Http\Controllers\KegiatanMahasiswaController;
use App\Http\Controllers\PrestasiMahasiswaController;
use App\Http\Controllers\ValidasiSeminarKPController;
use App\Http\Controllers\Kajur\LitabmasDataController;
use App\Http\Controllers\Kajur\PrestasiDataController;
use App\Http\Controllers\PenempatanAdminLabController;
use App\Http\Controllers\PenempatanDosenLabController;
use App\Http\Controllers\Kajur\AktivitasDataController;
use App\Http\Controllers\Kajur\PublikasiDataController;
use App\Http\Controllers\BeritaAcaraSeminarKerjaPraktik;
use App\Http\Controllers\ExportData;
use App\Http\Controllers\komprehensif\MahasiswaBaKompre;
use App\Http\Controllers\MahasiswaBimbinganKPController;
use App\Http\Controllers\MahasiswaBimbinganTA1Controller;
use App\Http\Controllers\MahasiswaBimbinganTA2Controller;
use App\Http\Controllers\tugas_akhir_dua\ValidasiBaTaDua;
use App\Http\Controllers\tugas_akhir_dua\MahasiswaBaTaDua;
use App\Http\Controllers\tugas_akhir_dua\PenjadwalanTaDua;
use App\Http\Controllers\tugas_akhir_satu\ValidasiBaTaSatu;
use App\Http\Controllers\komprehensif\AdminKompreController;
use App\Http\Controllers\MahasiswaBimbinganKompreController;
use App\Http\Controllers\tugas_akhir_dua\ValidasiAdminTaDua;
use App\Http\Controllers\tugas_akhir_satu\MahasiswaBaTaSatu;
use App\Http\Controllers\tugas_akhir_satu\PenjadwalanTaSatu;
use App\Http\Controllers\MahasiswaBimbinganAkademikController;
use App\Http\Controllers\tugas_akhir_satu\ValidasiAdminTaSatu;
use App\Http\Controllers\komprehensif\MahasiswaKompreController;
use App\Http\Controllers\komprehensif\ValidasiBaKompreController;
use App\Http\Controllers\komprehensif\PenjadwalanKompreController;
use App\Http\Controllers\tugas_akhir_dua\MahasiswaTaDuaController;
use App\Http\Controllers\tugas_akhir_satu\MahasiswaTaSatuController;
use App\Http\Controllers\GelarController;
use App\Http\Controllers\SuggestionController;

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
Route::prefix('admin/lab')->name('lab.')->middleware(['auth', 'profile', 'verified', 'role:admin lab|kalab'])->group(function () {

    Route::resource('barang', BarangController::class);
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
    Route::get('dataAktivitas', [LabController::class, 'dataLaboratorium'])->name('data.ajax');
    //chart line aktivitas lab
});
Route::get('chart/aktivitas', [LabController::class, 'chartAktivitasLab'])->name('chart.aktivitas.lab')->middleware('auth', 'verified', 'role:admin lab|jurusan|kalab');
Route::get('chart/seminar', [ChartSeminarController::class, 'ChartSeminar'])->name('chart.seminar.all')->middleware('auth', 'verified', 'role:jurusan');
Route::get('chart/usiadosen', [AkunDosenController::class, 'chartUsiaDosen'])->name('chart.usia.dosen')->middleware('auth', 'verified', 'role:jurusan');
Route::get('chart/jabatandosen', [AkunDosenController::class, 'chartJabatanDosen'])->name('chart.jabatan.dosen')->middleware('auth', 'verified', 'role:jurusan');
Route::get('chart/aktivitasalumni', [AktivitasAlumniController::class, 'chartAktivitasAlumni'])->name('chart.aktivitas.alumni')->middleware('auth', 'verified', 'role:jurusan');
// end ADMIN LAB

//admin berkas
Route::prefix('admin/berkas')->name('berkas.')->middleware(['auth', 'profile', 'verified', 'role:admin berkas'])->group(function () {
    Route::resource('berkas_persyaratan', BerkasPersyaratanController::class)->except([
        'create', 'store', 'show', 'destroy'
    ]);
    Route::resource('validasi/seminar/kp', ValidasiSeminarKPController::class)->names('validasi.seminar.kp');
    Route::resource('validasi/seminar/ta1', ValidasiAdminTaSatu::class)->names('validasi.seminar.ta1');
    Route::resource('validasi/seminar/ta2', ValidasiAdminTaDua::class)->names('validasi.seminar.ta2');
    Route::resource('validasi/sidang/kompre', AdminKompreController::class)->names('validasi.sidang.kompre');
    Route::resource('validasi/pendataan_alumni', ValidasiPendataanAlumni::class)->names('validasi.pendataan_alumni');
});
//end admin berkas

//dosen
Route::get('dosen/profile/create', [ProfileDosenController::class, 'create'])->name('dosen.profile.create')->middleware('auth', 'verified', 'role:dosen');
Route::post('dosen/profile/store', [ProfileDosenController::class, 'store'])->name('dosen.profile.store')->middleware('auth', 'verified', 'role:dosen');

route::prefix('/dosen')->name('dosen.')->middleware(['auth', 'profile', 'verified', 'role:dosen'])->group(function () {
    Route::resource('litabmas', LitabmasController::class);
    Route::resource('organisasi', OrganisasiController::class);
    Route::resource('gelar', GelarController::class);
    Route::resource('publikasi', PublikasiController::class);
    Route::resource('profile', ProfileDosenController::class, ['only' => ['index', 'edit', 'update']])->names('profile');
    Route::resource('jabatan', JabatanController::class);
    Route::resource('pangkat', PangkatDosenController::class);
    Route::resource('mahasiswa/bimbingan/akademik', MahasiswaBimbinganAkademikController::class)->names('mahasiswa.bimbingan.akademik');
    Route::resource('mahasiswa/bimbingan/kp', MahasiswaBimbinganKPController::class)->names('mahasiswa.bimbingan.kp');
    Route::post('mahasiswa/bimbingan/kp/export', [MahasiswaBimbinganKPController::class, 'export'])->name('mahasiswa.bimbingan.kp.export');
    Route::post('mahasiswa/bimbingan/ta/export', [MahasiswaBimbinganKompreController::class, 'export'])->name('mahasiswa.bimbingan.ta.export');

    Route::resource('mahasiswa/bimbingan/ta1', MahasiswaBimbinganTA1Controller::class)->names('mahasiswa.bimbingan.ta1');
    Route::resource('mahasiswa/bimbingan/ta2', MahasiswaBimbinganTA2Controller::class)->names('mahasiswa.bimbingan.ta2');
    Route::resource('mahasiswa/bimbingan/kompre', MahasiswaBimbinganKompreController::class)->names('mahasiswa.bimbingan.kompre');
    Route::get('cv', [ProfileDosenController::class, 'export']);
});
//end dosen

Route::prefix('koor')->name('koor.')->group(function () {
    Route::resource('jadwalPKL', JadwalPKLController::class)->middleware(['auth', 'profile', 'verified', 'role:pkl'])->names('jadwalPKL');
    Route::resource('jadwalTA1', PenjadwalanTaSatu::class)->middleware(['auth', 'profile', 'verified', 'role:ta1'])->names('jadwalTA1');
    Route::resource('jadwalTA2', PenjadwalanTaDua::class)->middleware(['auth', 'profile', 'verified', 'role:ta2'])->names('jadwalTA2');
    Route::resource('jadwalKompre', PenjadwalanKompreController::class)->middleware(['auth', 'profile', 'verified', 'role:kompre'])->names('jadwalKompre');

    Route::get('/jadwalPPKL/resend/{id}', [JadwalPKLController::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:pkl'])->name('jadwalPKL.resend');
    Route::get('/jadwalTA1/resend/{id}', [PenjadwalanTaSatu::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:ta1'])->name('jadwalTA1.resend');
    Route::get('/jadwalTA2/resend/{id}', [PenjadwalanTaDua::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:ta2'])->name('jadwalTA2.resend');
    Route::get('/jadwalKompre/resend/{id}', [PenjadwalanKompreController::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:kompre'])->name('jadwalKompre.resend');

    Route::resource('validasiBaPKL', ValidasiBaPKLController::class)->middleware(['auth', 'profile', 'verified', 'role:pkl'])->names('validasiBaPKL');
    Route::resource('validasiBaTA1', ValidasiBaTaSatu::class)->middleware(['auth', 'profile', 'verified', 'role:ta1'])->names('validasiBaTA1');
    Route::resource('validasiBaTA2', ValidasiBaTaDua::class)->middleware(['auth', 'profile', 'verified', 'role:ta2'])->names('validasiBaTA2');
    Route::resource('validasiBaKompre', ValidasiBaKompreController::class)->middleware(['auth', 'profile', 'verified', 'role:kompre'])->names('validasiBaKompre');
});


//jurusan
Route::prefix('jurusan')->name('jurusan.')->middleware('auth', 'profile', 'verified', 'role:jurusan')->group(function () {
    Route::resource('lokasi', LokasiController::class);
    //prestasi
    Route::resource('prestasi', PrestasiDataController::class);
    Route::resource('aktivitas', AktivitasDataController::class);
    Route::resource('publikasi', PublikasiDataController::class);
    Route::resource('litabmas', LitabmasDataController::class);
    Route::resource('mahasiswa', DataMahasiswaAllController::class);
    Route::resource('alumni', DataAlumni::class);
    Route::get('unduh', [ExportData::class, 'index'])->name('unduh.index');
    Route::post('unduh/penelitian', [ExportData::class, 'penelitian'])->name('unduh.penelitian');
    Route::post('unduh/pengabdian', [ExportData::class, 'pengabdian'])->name('unduh.pengabdian');
    Route::post('unduh/publikasi', [ExportData::class, 'publikasi'])->name('unduh.publikasi');
    Route::post('unduh/prestasi', [ExportData::class, 'prestasi'])->name('unduh.prestasi');
    Route::post('unduh/aktivitas', [ExportData::class, 'aktivitas'])->name('unduh.aktivitas');
    Route::post('unduh/mahasiswa', [ExportData::class, 'mahasiswa'])->name('unduh.mahasiswa');
    Route::post('unduh/alumni', [ExportData::class, 'alumni'])->name('unduh.alumni');
    Route::post('unduh/kp', [ExportData::class, 'kp'])->name('unduh.kp');
    Route::post('unduh/ta1', [ExportData::class, 'ta1'])->name('unduh.ta1');
    Route::post('unduh/ta2', [ExportData::class, 'ta2'])->name('unduh.ta2');
    Route::post('unduh/kompre', [ExportData::class, 'kompre'])->name('unduh.kompre');

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





Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth', 'profile', 'verified', 'role:mahasiswa|alumni')->group(function () {
    Route::resource('profile', ProfileMahasiswaController::class, ['only' => ['index', 'edit', 'update']])->names('profile');
    Route::resource('prestasi', PrestasiMahasiswaController::class)->names('prestasi');
    Route::resource('kegiatan', KegiatanMahasiswaController::class)->names('kegiatan');
    Route::resource('bakerjapraktik', BeritaAcaraSeminarKerjaPraktik::class)->names('bakerjapraktik');
    Route::resource('bata1', MahasiswaBaTaSatu::class)->names('bata1');
    Route::resource('bata2', MahasiswaBaTaDua::class)->names('bata2');
    Route::resource('bakompre', MahasiswaBaKompre::class)->names('bakompre');
    Route::resource('survey', SuggestionController::class)->names('survey');

    Route::group(['prefix' => 'seminar', 'as' => 'seminar.'], function () {
        Route::resource('kp', KPcontroller::class)->names('kp');
        Route::resource('tugas_akhir_1', MahasiswaTaSatuController::class)->names('tugas_akhir_1');
        Route::resource('tugas_akhir_2', MahasiswaTaDuaController::class)->names('tugas_akhir_2');
    });
    Route::group(['prefix' => 'sidang', 'as' => 'sidang.'], function () {
        Route::resource('kompre', MahasiswaKompreController::class)->names('kompre');
    });
    Route::resource('aktivitas_alumni', AktivitasAlumniController::class)->names('aktivitas_alumni');
    Route::resource('pendataan_alumni', PendataanAlumni::class)->names('pendataan_alumni');

    Route::get('lab', [LabTAController::class, 'index'])->name('lab.index');
    Route::get('lab/cekin', [LabTAController::class, 'cekin'])->name('lab.cekin');
    Route::post('lab/cekin', [LabTAController::class, 'cekinStore'])->name('lab.cekin.store');
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
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = App\Models\User::find($id);

    if (!$user || !hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return redirect('/login')->with('error', 'Invalid verification link.');
    }

    if ($user->hasVerifiedEmail()) {
        return redirect('/dashboard')->with('success', 'Akun anda sudah terverivikasi.');
    }

    $user->markEmailAsVerified();
    event(new Verified($user));

    return redirect('/dashboard')->with('success', 'Akun anda berhasil terverivikasi!');
})->middleware('signed')->name('verification.verify');

Route::get('/email/verify', [AuthController::class, 'reactivation'])->middleware(['auth', 'unverified'])
    ->name('verification.notice');

Route::get('/email/activation-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Tautan verifikasi telah dikirim!');
})->middleware(['auth', 'unverified', 'throttle:6,1'])->name('activation.send');
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







Route::prefix('sudo')->name('sudo.')->middleware(['auth', 'verified', 'role:sudo|jurusan'])->group(function () {
    Route::resource('akun_dosen', AkunDosenController::class);
    Route::resource('akun_mahasiswa', AkunMahasiswaController::class);
    Route::post('base_npm/add/excel', [BaseNpmController::class, 'storeExcel'])->name('base_npm.store.excel');
    Route::resource('akun_admin', AkunAdminController::class);
    Route::resource('base_npm', BaseNpmController::class);
    Route::get('BaseNpm', [BaseNpmController::class, 'BaseNpm'])->name('base_npm.ajax');
    Route::resource('model', ModelController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kalab', PenempatanDosenLabController::class);
    Route::resource('admin_jurusan', PenempatanAdminLabController::class);
    Route::get('resetSeminar', [ResetTA::class, 'index'])->name('reset.seminar.index');
    Route::delete('delete/{id}', [ResetTA::class, 'destroy'])->name('reset.seminar.destroy');
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
    $ta2 = ModelJadwalSeminarTaDua::where('tanggal_seminar_ta_dua', '>=', date('Y-m-d'))->get();
    return view('ta2', compact('ta2'));
});
Route::get('/kompre', function () {
    $kompre = ModelJadwalSeminarKompre::where('tanggal_komprehensif', '>=', date('Y-m-d'))->get();
    return view('kompre', compact('kompre'));
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/help', function () {
    return view('help');
});
Route::get('/helps', function () {
    return view('helps');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'profile', 'verified'])->name('dashboard');

Route::get('/reset-password', function () {
    return view('auth.reset');
})->name('reset');
