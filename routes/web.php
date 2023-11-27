<?php

use App\Models\JadwalSKP;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sudo\ResetTA;
use App\Http\Controllers\Kajur\Seminar;
use App\Http\Controllers\LabController;
use App\Http\Controllers\SopController;
use App\Models\ModelJadwalSeminarTaDua;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\sudo\ResetTAS2;
use App\Models\ModelJadwalSeminarKompre;
use App\Models\ModelJadwalSeminarTaSatu;
use App\Http\Controllers\ModelController;
use App\Models\ModelJadwalSeminarTaDuaS2;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Kajur\DataAlumni;
use App\Http\Controllers\Kajur\ExportData;
use App\Models\ModelJadwalSeminarKompreS2;
use App\Models\ModelJadwalSeminarTaSatuS2;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Kajur\Penghargaan;
use App\Http\Controllers\Kajur\DataAlumniS2;
use App\Http\Controllers\Kajur\ExportDataS2;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\dosen\GelarController;
use App\Http\Controllers\Kajur\ExportDataDosen;
use App\Http\Controllers\alumni\PendataanAlumni;
use App\Http\Controllers\Kajur\LokasiController;
use App\Http\Controllers\PangkatAdminController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\sudo\BaseNpmController;
use App\Http\Controllers\dosen\JabatanController;
use App\Http\Controllers\ValidasiPendataanAlumni;
use App\Http\Controllers\dosen\LitabmasController;
use App\Http\Controllers\sudo\AkunAdminController;
use App\Http\Controllers\sudo\AkunDosenController;
use App\Http\Controllers\dosen\PublikasiController;
use App\Http\Controllers\mahasiswa\LabTAController;
use App\Http\Controllers\TemplateSeminarController;
use App\Http\Controllers\dosen\OrganisasiController;
use App\Http\Controllers\kerja_praktik\KPcontroller;
use App\Http\Controllers\alumni\s2\AktivitasAlumniS2;
use App\Http\Controllers\alumni\s2\PendataanAlumniS2;
use App\Http\Controllers\BerkasPersyaratanController;
use App\Http\Controllers\dosen\ControllerSeminarDosen;
use App\Http\Controllers\dosen\PangkatDosenController;
use App\Http\Controllers\dosen\ProfileDosenController;
use App\Http\Controllers\Kajur\ChartSeminarController;
use App\Http\Controllers\Kajur\LitabmasDataController;
use App\Http\Controllers\Kajur\PrestasiDataController;
use App\Http\Controllers\sudo\AkunMahasiswaController;
use App\Http\Controllers\Kajur\AktivitasDataController;
use App\Http\Controllers\Kajur\PublikasiDataController;
use App\Http\Controllers\Kajur\PrestasiDataS2Controller;
use App\Http\Controllers\komprehensif\MahasiswaBaKompre;
use App\Http\Controllers\sudo\ImportMahasiswaController;
use App\Http\Controllers\Kajur\AktivitasDataS2Controller;
use App\Http\Controllers\tugas_akhir_dua\ValidasiBaTaDua;
use App\Http\Controllers\alumni\AktivitasAlumniController;
use App\Http\Controllers\dosen\ControllerPenghargaanDosen;
use App\Http\Controllers\Kajur\DataMahasiswaAllController;
use App\Http\Controllers\sudo\ImportMahasiswaS2Controller;
use App\Http\Controllers\tugas_akhir_dua\MahasiswaBaTaDua;
use App\Http\Controllers\tugas_akhir_dua\PenjadwalanTaDua;
use App\Http\Controllers\kerja_praktik\JadwalPKLController;
use App\Http\Controllers\sudo\PenempatanAdminLabController;
use App\Http\Controllers\sudo\PenempatanDosenLabController;
use App\Http\Controllers\tugas_akhir_satu\ValidasiBaTaSatu;
use App\Http\Controllers\Kajur\DataMahasiswaAllS2Controller;
use App\Http\Controllers\komprehensif\AdminKompreController;
use App\Http\Controllers\tugas_akhir_dua\ValidasiAdminTaDua;
use App\Http\Controllers\tugas_akhir_satu\MahasiswaBaTaSatu;
use App\Http\Controllers\tugas_akhir_satu\PenjadwalanTaSatu;
use App\Http\Controllers\mahasiswa\ProfileMahasiswaController;
use App\Http\Controllers\tugas_akhir_satu\ValidasiAdminTaSatu;
use App\Http\Controllers\kerja_praktik\ValidasiBaPKLController;
use App\Http\Controllers\mahasiswa\KegiatanMahasiswaController;
use App\Http\Controllers\mahasiswa\PrestasiMahasiswaController;
use App\Http\Controllers\komprehensif\MahasiswaKompreController;
use App\Http\Controllers\komprehensif\ArsipAdminKompreController;
use App\Http\Controllers\komprehensif\ValidasiBaKompreController;
use App\Http\Controllers\tugas_akhir_dua\ArsipValidasiAdminTaDua;
use App\Http\Controllers\bimbingan\MahasiswaBimbinganKPController;
use App\Http\Controllers\komprehensif\PenjadwalanKompreController;
use App\Http\Controllers\mahasiswa_s2\ta2\ControllerKoorS2BaTaDua;
use App\Http\Controllers\tugas_akhir_dua\MahasiswaTaDuaController;
use App\Http\Controllers\kerja_praktik\ValidasiSeminarKPController;
use App\Http\Controllers\mahasiswa_s2\ta1\ControllerKoorS2BaTaSatu;
use App\Http\Controllers\mahasiswa_s2\ta2\ControllerAdminS2BpTaDua;
use App\Http\Controllers\tugas_akhir_satu\ArsipValidasiAdminTaSatu;
use App\Http\Controllers\mahasiswa_s2\KegiatanMahasiswaControllerS2;
use App\Http\Controllers\mahasiswa_s2\PrestasiMahasiswaControllerS2;
use App\Http\Controllers\mahasiswa_s2\ta1\ControllerAdminS2BpTaSatu;
use App\Http\Controllers\tugas_akhir_satu\MahasiswaTaSatuController;
use App\Http\Controllers\bimbingan\MahasiswaBimbinganTesisController;
use App\Http\Controllers\controller_seminar\EditSidangTesisController;
use App\Http\Controllers\kerja_praktik\BeritaAcaraSeminarKerjaPraktik;
use App\Http\Controllers\mahasiswa_s2\kompre\ControllerKoorS2BaKompre;
use App\Http\Controllers\mahasiswa_s2\kompre\ControllerAdminS2BpKompre;
use App\Http\Controllers\mahasiswa_s2\ta2\ControllerMahasiswaS2BaTaDua;
use App\Http\Controllers\bimbingan\MahasiswaBimbinganAkademikController;
use App\Http\Controllers\controller_seminar\EditSeminarTesis1Controller;
use App\Http\Controllers\controller_seminar\EditSeminarTesis2Controller;
use App\Http\Controllers\kerja_praktik\ArsipValidasiSeminarKPController;
use App\Http\Controllers\mahasiswa_s2\ta1\ControllerMahasiswaS2BaTaSatu;
use App\Http\Controllers\mahasiswa_s2\ta2\ControllerArsipAdminS2BpTaDua;
use App\Http\Controllers\mahasiswa_s2\ta1\ControllerArsipAdminS2BpTaSatu;
use App\Http\Controllers\bimbingan\MahasiswaBimbinganTugasAkhirController;
use App\Http\Controllers\mahasiswa_s2\kompre\ControllerKoorS2JadwalKompre;
use App\Http\Controllers\mahasiswa_s2\kompre\ControllerMahasiswaS2BaKompre;
use App\Http\Controllers\mahasiswa_s2\ta2\ControllerKoorS2PenjadwalanTaDua;
use App\Http\Controllers\mahasiswa_s2\kompre\ControllerArsipAdminS2BpKompre;
use App\Http\Controllers\mahasiswa_s2\ta1\ControllerKoorS2PenjadwalanTaSatu;
use App\Http\Controllers\mahasiswa_s2\ta2\ControllerMahasiswaS2SeminarTaDua;
use App\Http\Controllers\controller_seminar\EditSeminarTugasAkhir1Controller;
use App\Http\Controllers\controller_seminar\EditSeminarTugasAkhir2Controller;
use App\Http\Controllers\mahasiswa_s2\ta1\ControllerMahasiswaS2SeminarTaSatu;
use App\Http\Controllers\controller_seminar\EditSeminarKerjaPraktikController;
use App\Http\Controllers\controller_seminar\EditSeminarKomprehensifController;
use App\Http\Controllers\mahasiswa_s2\kompre\ControllerMahasiswaS2SidangKompre;

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
    Route::get('asistensi', [LabController::class, 'tableAktivitasLab'])->name('asistensi.ajax');
    Route::get('detail_asistensi/{npm}', [LabController::class, 'showAsistensi'])->name('asistensi.show');
    Route::get('dataAktivitas', [LabController::class, 'dataLaboratorium'])->name('data.ajax');
});
//chart line aktivitas lab
Route::get('chart/aktivitas', [LabController::class, 'chartAktivitasLab'])->name('chart.aktivitas.lab')->middleware('auth', 'verified', 'role:admin lab|jurusan|kalab');
Route::get('chart/seminar', [ChartSeminarController::class, 'ChartSeminar'])->name('chart.seminar.all')->middleware('auth', 'verified', 'role:jurusan|tpmpsS1|kaprodiS1');
Route::get('chart/seminarS2', [ChartSeminarController::class, 'ChartSeminarS2'])->name('chart.seminarS2.all')->middleware('auth', 'verified', 'role:jurusan|tpmpsS2|kaprodiS2');
Route::get('chart/usiadosen', [AkunDosenController::class, 'chartUsiaDosen'])->name('chart.usia.dosen')->middleware('auth', 'verified', 'role:jurusan|tpmpsS1|tpmpsS2');
Route::get('chart/jabatandosen', [AkunDosenController::class, 'chartJabatanDosen'])->name('chart.jabatan.dosen')->middleware('auth', 'verified', 'role:jurusan|tpmpsS1|tpmpsS2');
Route::get('chart/aktivitasalumni', [AktivitasAlumniController::class, 'chartAktivitasAlumni'])->name('chart.aktivitas.alumni')->middleware('auth', 'verified', 'role:jurusan|tpmpsS1|tpmpsS2');
Route::get('chart/seminardosen', [ControllerSeminarDosen::class, 'chartSeminarDosen'])->name('chart.seminar.dosen')->middleware('auth', 'verified', 'role:jurusan|tpmpsS1|tpmpsS2');
Route::get('chart/tahunseminardosen', [ControllerSeminarDosen::class, 'chartTahunSeminarDosen'])->name('chart.tahunseminar.dosen')->middleware('auth', 'verified', 'role:jurusan|tpmpsS1|tpmpsS2');
Route::get('chart/Penghargaandosen', [ControllerPenghargaanDosen::class, 'chartPenghargaanDosen'])->name('chart.Penghargaan.dosen')->middleware('auth', 'verified', 'role:jurusan|tpmpsS1|tpmpsS2');
Route::get('chart/tahunPenghargaandosen', [ControllerPenghargaanDosen::class, 'chartTahunPenghargaanDosen'])->name('chart.tahunPenghargaan.dosen')->middleware('auth', 'verified', 'role:jurusan|tpmpsS1|tpmpsS2');
// end ADMIN LAB

//admin berkas
Route::prefix('admin/berkas')->name('berkas.')->middleware(['auth', 'profile', 'verified', 'role:admin berkas'])->group(function () {
    Route::resource('berkas_persyaratan', BerkasPersyaratanController::class)->except([
        'create', 'store', 'show', 'destroy'
    ]);
    Route::resource('template_seminar', TemplateSeminarController::class)->except([
        'create', 'store', 'show', 'destroy'
    ]);

    Route::resource('validasi/s2/tesis1', ControllerAdminS2BpTaSatu::class)->names('validasi.s2.tesis1');
    Route::resource('validasi/s2/tesis2', ControllerAdminS2BpTaDua::class)->names('validasi.s2.tesis2');
    Route::resource('validasi/s2/sidang_tesis', ControllerAdminS2BpKompre::class)->names('validasi.s2.tesis3');
    Route::resource('validasi/seminar/kp', ValidasiSeminarKPController::class)->names('validasi.seminar.kp');
    Route::resource('validasi/seminar/ta1', ValidasiAdminTaSatu::class)->names('validasi.seminar.ta1');
    Route::resource('validasi/seminar/ta2', ValidasiAdminTaDua::class)->names('validasi.seminar.ta2');
    Route::resource('validasi/sidang/kompre', AdminKompreController::class)->names('validasi.sidang.kompre');
    Route::resource('validasi/pendataan_alumni', ValidasiPendataanAlumni::class)->names('validasi.pendataan_alumni');

    Route::resource('arsip_validasi/s2/tesis1', ControllerArsipAdminS2BpTaSatu::class)->names('arsip_validasi.s2.tesis1');
    Route::resource('arsip_validasi/s2/tesis2', ControllerArsipAdminS2BpTaDua::class)->names('arsip_validasi.s2.tesis2');
    Route::resource('arsip_validasi/s2/sidang_tesis', ControllerArsipAdminS2BpKompre::class)->names('arsip_validasi.s2.tesis3');

    Route::resource('arsip_validasi/seminar/kp', ArsipValidasiSeminarKPController::class)->names('arsip_validasi.seminar.kp');
    Route::resource('arsip_validasi/seminar/ta1', ArsipValidasiAdminTaSatu::class)->names('arsip_validasi.seminar.ta1');
    Route::resource('arsip_validasi/seminar/ta2', ArsipValidasiAdminTaDua::class)->names('arsip_validasi.seminar.ta2');
    Route::resource('arsip_validasi/sidang/kompre', ArsipAdminKompreController::class)->names('arsip_validasi.sidang.kompre');
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
    Route::post('import', [PublikasiController::class, 'import'])->name('publikasi.import');
    Route::resource('penghargaan', ControllerPenghargaanDosen::class);
    Route::resource('seminar', ControllerSeminarDosen::class);
    Route::resource('profile', ProfileDosenController::class, ['only' => ['index', 'edit', 'update']])->names('profile');
    Route::resource('jabatan', JabatanController::class);
    Route::resource('pangkat', PangkatDosenController::class);
    Route::resource('mahasiswa/bimbingan/akademik', MahasiswaBimbinganAkademikController::class)->names('mahasiswa.bimbingan.akademik');
    Route::resource('mahasiswa/bimbingan/kp', MahasiswaBimbinganKPController::class)->names('mahasiswa.bimbingan.kp');
    Route::post('mahasiswa/bimbingan/kp/export', [MahasiswaBimbinganKPController::class, 'export'])->name('mahasiswa.bimbingan.kp.export');
    Route::post('mahasiswa/bimbingan/ta/export', [MahasiswaBimbinganTugasAkhirController::class, 'export'])->name('mahasiswa.bimbingan.ta.export');
    Route::resource('mahasiswa/bimbingan/kompre', MahasiswaBimbinganTugasAkhirController::class)->names('mahasiswa.bimbingan.kompre');
    Route::post('mahasiswa/bimbingan/tesis/export', [MahasiswaBimbinganTesisController::class, 'export'])->name('mahasiswa.bimbingan.tesis.export');
    Route::resource('mahasiswa/bimbingan/tesis', MahasiswaBimbinganTesisController::class)->names('mahasiswa.bimbingan.tesis');
    Route::get('cv', [ProfileDosenController::class, 'export']);
});
//end dosen

Route::prefix('koor')->name('koor.')->group(function () {
    //koor S1
    Route::resource('jadwalPKL', JadwalPKLController::class)->middleware(['auth', 'profile', 'verified', 'role:pkl'])->names('jadwalPKL');
    Route::resource('jadwalTA1', PenjadwalanTaSatu::class)->middleware(['auth', 'profile', 'verified', 'role:ta1'])->names('jadwalTA1');
    Route::resource('jadwalTA2', PenjadwalanTaDua::class)->middleware(['auth', 'profile', 'verified', 'role:ta2'])->names('jadwalTA2');
    Route::resource('jadwalKompre', PenjadwalanKompreController::class)->middleware(['auth', 'profile', 'verified', 'role:kompre'])->names('jadwalKompre');

    Route::get('/jadwalPPKL/resend/{id}', [JadwalPKLController::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:pkl'])->name('jadwalPKL.resend');
    Route::get('/jadwalTA1/resend/{id}', [PenjadwalanTaSatu::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:ta1'])->name('jadwalTA1.resend');
    Route::get('/jadwalTA2/resend/{id}', [PenjadwalanTaDua::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:ta2'])->name('jadwalTA2.resend');
    Route::get('/jadwalKompre/resend/{id}', [PenjadwalanKompreController::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:kompre'])->name('jadwalKompre.resend');
    Route::post('/download/jadwal', [PenjadwalanTaSatu::class, 'downloadJadwal'])->middleware(['auth', 'profile', 'verified', 'role:ta1'])->name('jadwalTA1.download');

    Route::resource('validasiBaPKL', ValidasiBaPKLController::class)->middleware(['auth', 'profile', 'verified', 'role:pkl'])->names('validasiBaPKL');
    Route::resource('validasiBaTA1', ValidasiBaTaSatu::class)->middleware(['auth', 'profile', 'verified', 'role:ta1'])->names('validasiBaTA1');
    Route::resource('validasiBaTA2', ValidasiBaTaDua::class)->middleware(['auth', 'profile', 'verified', 'role:ta2'])->names('validasiBaTA2');
    Route::resource('validasiBaKompre', ValidasiBaKompreController::class)->middleware(['auth', 'profile', 'verified', 'role:kompre'])->names('validasiBaKompre');

    Route::resource('arsip/pkl', EditSeminarKerjaPraktikController::class)->middleware(['auth', 'profile', 'verified', 'role:pkl'])->names('arsip.pkl');
    Route::resource('arsip/ta1', EditSeminarTugasAkhir1Controller::class)->middleware(['auth', 'profile', 'verified', 'role:ta1'])->names('arsip.ta1');
    Route::resource('arsip/ta2', EditSeminarTugasAkhir2Controller::class)->middleware(['auth', 'profile', 'verified', 'role:ta2'])->names('arsip.ta2');
    Route::resource('arsip/kompre', EditSeminarKomprehensifController::class)->middleware(['auth', 'profile', 'verified', 'role:kompre'])->names('arsip.kompre');

    //koor S2
    Route::get('/jadwalTA1S2/resend/{id}', [ControllerKoorS2PenjadwalanTaSatu::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:ta1S2'])->name('jadwalTA1S2.resend');
    Route::get('/jadwalTA2S2/resend/{id}', [ControllerKoorS2PenjadwalanTaDua::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:ta2S2'])->name('jadwalTA2S2.resend');
    Route::get('/jadwalSidangS2/resend/{id}', [ControllerKoorS2JadwalKompre::class, 'resend'])->middleware(['auth', 'profile', 'verified', 'role:kompreS2'])->name('jadwalSidangS2.resend');

    Route::resource('jadwal/TA1/S2', ControllerKoorS2PenjadwalanTaSatu::class)->middleware(['auth', 'profile', 'verified', 'role:ta1S2'])->names('jadwalTA1S2');
    Route::resource('jadwal/TA2/S2', ControllerKoorS2PenjadwalanTaDua::class)->middleware(['auth', 'profile', 'verified', 'role:ta2S2'])->names('jadwalTA2S2');
    Route::resource('jadwal/Kompre/S2', ControllerKoorS2JadwalKompre::class)->middleware(['auth', 'profile', 'verified', 'role:kompreS2'])->names('jadwalKompreS2');
    Route::resource('validasi/Ba/TA1/S2', ControllerKoorS2BaTaSatu::class)->middleware(['auth', 'profile', 'verified', 'role:ta1S2'])->names('ValidasiBaTa1S2');
    Route::resource('validasi/Ba/TA2/S2', ControllerKoorS2BaTaDua::class)->middleware(['auth', 'profile', 'verified', 'role:ta2S2'])->names('ValidasiBaTa2S2');
    Route::resource('validasi/Ba/Kompre/S2', ControllerKoorS2BaKompre::class)->middleware(['auth', 'profile', 'verified', 'role:kompreS2'])->names('ValidasiBaKompreS2');

    Route::resource('arsip/tesis1', EditSeminarTesis1Controller::class)->middleware(['auth', 'profile', 'verified', 'role:ta1S2'])->names('arsip.tesis1');
    Route::resource('arsip/tesis2', EditSeminarTesis2Controller::class)->middleware(['auth', 'profile', 'verified', 'role:ta2S2'])->names('arsip.tesis2');
    Route::resource('arsip/sidang_tesis', EditSidangTesisController::class)->middleware(['auth', 'profile', 'verified', 'role:kompreS2'])->names('arsip.sidang_tesis');
});


//jurusan
Route::prefix('jurusan')->name('jurusan.')->middleware('auth', 'profile', 'verified', 'role:jurusan|tpmpsS1|tpmpsS2')->group(function () {

    //prestasi
    Route::resource('publikasi', PublikasiDataController::class);
    Route::resource('litabmas', LitabmasDataController::class);
    Route::resource('penghargaan', Penghargaan::class);
    Route::resource('seminar', Seminar::class);
    Route::get('pieChartScalaPublikasi', [PublikasiDataController::class, 'pieChartScala'])->name('publikasi.pieChartScala');
    Route::get('pieChartKategoriPublikasi', [PublikasiDataController::class, 'pieChartKategori'])->name('publikasi.pieChartKategori');
    Route::get('pieChartKategoriLitabmasPublikasi', [PublikasiDataController::class, 'pieChartKategoriLitabmas'])->name('publikasi.pieChartKategoriLitabmas');
    Route::get('barChartTahunPublikasi', [PublikasiDataController::class, 'barChartTahun'])->name('publikasi.barChartTahun');
    Route::get('barChartTahunLitabmas', [LitabmasDataController::class, 'barChartTahun'])->name('litabmas.barChartTahun');
    Route::get('pieChartKategoriLitabmas', [LitabmasDataController::class, 'pieChartKategoriLitabmas'])->name('litabmas.pieChartKategoriLitabmas');
});

Route::prefix('jurusan')->name('jurusan.')->middleware('auth', 'profile', 'verified', 'role:jurusan|kaprodiS1|tpmpsS1')->group(function () {
    Route::resource('alumni', DataAlumni::class);
    Route::resource('prestasi', PrestasiDataController::class);
    Route::get('chartScalaPrestasi', [PrestasiDataController::class, 'pieChartScala'])->name('prestasi.chartScala');
    Route::get('barChartPrestasi', [PrestasiDataController::class, 'barChartPrestasi'])->name('prestasi.barChartPrestasi');
    Route::get('chartCapaianPrestasi', [PrestasiDataController::class, 'pieChartCapaian'])->name('prestasi.chartCapaian');
    Route::resource('aktivitas', AktivitasDataController::class);
    Route::get('barChartAktivitas', [AktivitasDataController::class, 'barChartAktivitas'])->name('aktivitas.barChartAktivitas');
    Route::get('pieChartAktivitas', [AktivitasDataController::class, 'pieChartPeran'])->name('aktivitas.pieChartPeran');

    //unduh data
    Route::get('unduh_data_s1', [ExportData::class, 'index'])->name('unduh.index');
    Route::post('unduh/mahasiswa/seminar', [ExportData::class, 'mahasiswaSeminar'])->name('unduh.mahasiswa.seminar');
    Route::post('unduh/prestasi', [ExportData::class, 'prestasi'])->name('unduh.prestasi');
    Route::post('unduh/aktivitas', [ExportData::class, 'aktivitas'])->name('unduh.aktivitas');
    Route::post('unduh/mahasiswa', [ExportData::class, 'mahasiswa'])->name('unduh.mahasiswa');
    Route::post('unduh/alumni', [ExportData::class, 'alumni'])->name('unduh.alumni');
    Route::post('unduh/kp', [ExportData::class, 'kp'])->name('unduh.kp');
    Route::post('unduh/ta1', [ExportData::class, 'ta1'])->name('unduh.ta1');
    Route::post('unduh/ta2', [ExportData::class, 'ta2'])->name('unduh.ta2');
    Route::post('unduh/kompre', [ExportData::class, 'kompre'])->name('unduh.kompre');
    Route::resource('mahasiswa', DataMahasiswaAllController::class);
});
Route::prefix('jurusan')->name('jurusan.')->middleware('auth', 'profile', 'verified', 'role:jurusan|kaprodiS2|tpmpsS2')->group(function () {
    Route::get('unduh_data_s2', [ExportDataS2::class, 'index'])->name('unduhs2.index');
    Route::post('unduh/prestasiS2', [ExportDataS2::class, 'prestasiS2'])->name('unduh.prestasiS2');
    Route::post('unduh/aktivitasS2', [ExportDataS2::class, 'aktivitasS2'])->name('unduh.aktivitasS2');

    Route::post('unduh/mahasiswaS2/seminar', [ExportDataS2::class, 'mahasiswaS2Seminar'])->name('unduh.mahasiswaS2.seminar');
    Route::post('unduh/tesis1', [ExportDataS2::class, 'tesis1'])->name('unduh.tesis1');
    Route::post('unduh/tesis2', [ExportDataS2::class, 'tesis2'])->name('unduh.tesis2');
    Route::post('unduh/sidang', [ExportDataS2::class, 'sidang'])->name('unduh.sidang');
    Route::post('unduh/mahasiswas2', [ExportDataS2::class, 'mahasiswas2'])->name('unduh.mahasiswas2');
    Route::post('unduh/alumniS2', [ExportDataS2::class, 'alumni'])->name('unduh.alumniS2');
    Route::resource('alumniS2', DataAlumniS2::class);
    Route::resource('prestasiS2', PrestasiDataS2Controller::class);
    Route::get('chartCapaianPrestasiS2', [PrestasiDataS2Controller::class, 'pieChartCapaian'])->name('prestasiS2.chartCapaian');
    Route::get('chartScalaPrestasiS2', [PrestasiDataS2Controller::class, 'pieChartScala'])->name('prestasiS2.chartScala');
    Route::get('barChartPrestasiS2', [PrestasiDataS2Controller::class, 'barChartPrestasi'])->name('prestasiS2.barChartPrestasi');
    Route::resource('aktivitasS2', AktivitasDataS2Controller::class);
    Route::get('barChartAktivitasS2', [AktivitasDataS2Controller::class, 'barChartAktivitas'])->name('aktivitasS2.barChartAktivitas');
    Route::get('pieChartAktivitasS2', [AktivitasDataS2Controller::class, 'pieChartPeran'])->name('aktivitasS2.pieChartPeran');

    Route::resource('mahasiswaS2', DataMahasiswaAllS2Controller::class);
});
Route::prefix('jurusan')->name('jurusan.')->middleware('auth', 'profile', 'verified', 'role:jurusan|kaprodiS1|kaprodiS2|tpmpsS2|tpmpsS1')->group(function () {
    Route::get('unduh_aktivitas_dosen', [ExportDataDosen::class, 'index'])->name('unduh.dosen.index');
    Route::post('unduh/penelitian', [ExportDataDosen::class, 'penelitian'])->name('unduh.penelitian');
    Route::post('unduh/pengabdian', [ExportDataDosen::class, 'pengabdian'])->name('unduh.pengabdian');
    Route::post('unduh/publikasi', [ExportDataDosen::class, 'publikasi'])->name('unduh.publikasi');
    Route::post('unduh/seminar', [ExportDataDosen::class, 'seminar'])->name('unduh.seminar');
    Route::post('unduh/penghargaan', [ExportDataDosen::class, 'penghargaan'])->name('unduh.penghargaan');
});

Route::prefix('jurusan')->name('jurusan.')->middleware('auth', 'profile', 'verified', 'role:jurusan')->group(function () {
    Route::resource('lokasi', LokasiController::class);
});

//end jurusan
Route::get('mahasiswa/profile/create', [ProfileMahasiswaController::class, 'create'])->name('mahasiswa.profile.create')->middleware('auth', 'verified', 'role:mahasiswa|mahasiswaS2');
Route::post('mahasiswa/profile/store', [ProfileMahasiswaController::class, 'store'])->name('mahasiswa.profile.store')->middleware('auth', 'verified', 'role:mahasiswa|mahasiswaS2');
Route::resource('survey', SuggestionController::class)->names('mahasiswa.survey');


Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth', 'profile', 'verified', 'role:mahasiswa|alumni|mahasiswaS2')->group(function () {
    Route::resource('profile', ProfileMahasiswaController::class, ['only' => ['index', 'edit', 'update']])->names('profile');
    Route::resource('aktivitas_alumni', AktivitasAlumniController::class)->names('aktivitas_alumni');
    Route::resource('pendataan_alumni', PendataanAlumni::class)->names('pendataan_alumni');
});

Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth', 'profile', 'verified', 'role:mahasiswaS2|mahasiswaS2&alumni')->group(function () {
    Route::resource('seminar/ta1/S2', ControllerMahasiswaS2SeminarTaSatu::class)->names('seminarta1s2');
    Route::resource('seminar/ta2/S2', ControllerMahasiswaS2SeminarTaDua::class)->names('seminarta2s2');
    Route::resource('ba/ta1/S2', ControllerMahasiswaS2BaTaSatu::class)->names('bata1s2');
    Route::resource('ba/ta2/S2', ControllerMahasiswaS2BaTaDua::class)->names('bata2s2');
    Route::resource('ba/kompre/S2', ControllerMahasiswaS2BaKompre::class)->names('bakompres2');
    Route::resource('prestasiS2', PrestasiMahasiswaControllerS2::class)->names('prestasiS2');
    Route::resource('kegiatanS2', KegiatanMahasiswaControllerS2::class)->names('kegiatanS2');
    Route::resource('aktivitas_alumni_S2', AktivitasAlumniS2::class)->names('aktivitas_alumni_S2');
    Route::resource('pendataan_alumni_S2', PendataanAlumniS2::class)->names('pendataan_alumni_S2');

    Route::group(['prefix' => 'sidang', 'as' => 'sidang.'], function () {
        Route::resource('kompre/S2', ControllerMahasiswaS2SidangKompre::class)->names('kompres2');
    });
});

Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth', 'profile', 'verified', 'role:mahasiswa|alumni&mahasiswa')->group(function () {
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
        Route::resource('kompre', MahasiswaKompreController::class)->names('kompre');
    });
    Route::get('lab', [LabTAController::class, 'index'])->name('lab.index');
    Route::get('lab/cekin', [LabTAController::class, 'cekin'])->name('lab.cekin');
    Route::post('lab/pergroup', [LabTAController::class, 'perGroup'])->name('lab.per.group');
    Route::post('lab/cekin', [LabTAController::class, 'cekinStore'])->name('lab.cekin.store');
    Route::post('lab/cekin/alternatif', [LabTAController::class, 'alternatif'])->name('lab.cekin.alternatif.store');
    Route::post('lab/cekin/belumta', [LabTAController::class, 'belumTA'])->name('lab.cekin.belum.ta');
    Route::post('lab/cekin/belumta/alternatif', [LabTAController::class, 'belumTaAlternativ'])->name('lab.cekin.belum.ta.alternatif');
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
    Route::resource('resetSeminarS2', ResetTAS2::class);
    Route::get('resetSeminar', [ResetTA::class, 'index'])->name('reset.seminar.index');
    Route::get('resetSeminarS2', [ResetTAS2::class, 'index'])->name('reset.seminarS2.index');
    Route::delete('resetSeminar/delete/{id}', [ResetTA::class, 'destroy'])->name('reset.seminar.destroy');
    Route::delete('resetSeminarS2/delete/{id}', [ResetTAS2::class, 'destroy'])->name('reset.seminarS2.destroy');

    Route::get('impormahasiswa', [ImportMahasiswaController::class, 'index'])->name('import.mahasiswa.index');
    Route::post('impormahasiswa', [ImportMahasiswaController::class, 'store'])->name('import.mahasiswa.store');
    Route::get('unduhimportmahasiswa', [ImportMahasiswaController::class, 'unduh'])->name('import.mahasiswa.unduh');

    Route::get('impormahasiswas2', [ImportMahasiswaS2Controller::class, 'index'])->name('import.mahasiswas2.index');
    Route::post('impormahasiswas2', [ImportMahasiswaS2Controller::class, 'store'])->name('import.mahasiswas2.store');
    Route::get('unduhimportmahasiswas2', [ImportMahasiswaS2Controller::class, 'unduh'])->name('import.mahasiswas2.unduh');

    Route::get('failed_jobs', [FailedJobsController::class, 'index'])->name('failed_jobs.index');
    Route::get('failed_jobs/{id}/show', [FailedJobsController::class, 'retry'])->name('failed_jobs.show');
    Route::get('failed_jobs/{id}/retry', [FailedJobsController::class, 'retry'])->name('failed_jobs.retry');
    Route::delete('failed_jobs/{id}/delete', [FailedJobsController::class, 'destroy'])->name('failed_jobs.destroy');
});

Route::get('/', function () {
    return view('index');
});
Route::get('/team', function () {
    return view('team');
});
Route::get('/kp', function () {
    $jadwal_kp = JadwalSKP::orderBy('tanggal_skp', 'desc')->get();
    return view('kp', compact('jadwal_kp'));
});
Route::get('/ta1', function () {
    $jadwal_ta1 = ModelJadwalSeminarTaSatu::orderBy('tanggal_seminar_ta_satu', 'desc')->get();
    return view('ta1', compact('jadwal_ta1'));
});
Route::get('/ta2', function () {
    $ta2 = ModelJadwalSeminarTaDua::orderBy('tanggal_seminar_ta_dua', 'desc')->get();
    return view('ta2', compact('ta2'));
});
Route::get('/kompre', function () {
    $kompre = ModelJadwalSeminarKompre::orderBy('tanggal_komprehensif', 'desc')->get();
    return view('kompre', compact('kompre'));
});

Route::get('/tesis1', function () {
    $tesis1 = ModelJadwalSeminarTaSatuS2::orderBy('tanggal', 'desc')->get();
    return view('tesis1', compact('tesis1'));
});
Route::get('/tesis2', function () {
    $tesis2 = ModelJadwalSeminarTaDuaS2::orderBy('tanggal', 'desc')->get();
    return view('tesis2', compact('tesis2'));
});
Route::get('/sidang', function () {
    $sidang = ModelJadwalSeminarKompreS2::orderBy('tanggal', 'desc')->get();
    return view('sidang', compact('sidang'));
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
Route::get('/custom', function () {
    return view('custom');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'profile', 'verified'])->name('dashboard');

Route::get('/reset-password', function () {
    return view('auth.reset');
})->name('reset');
