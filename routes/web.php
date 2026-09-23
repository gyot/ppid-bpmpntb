<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BerkalaController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InformationController as AdminInformationController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\KeberatanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DipController as AdminDipController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\LhkpnController as AdminLhkpnController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\KeuanganController as AdminKeuanganController;
use App\Http\Controllers\Admin\PengadaanController as AdminPengadaanController;
use App\Http\Controllers\Admin\SopController as AdminSopController;
use App\Http\Controllers\Admin\RegulasiController as AdminRegulasiController;
use App\Http\Controllers\Admin\PejabatController as AdminPejabatController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\UploadController as AdminUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('profil')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/visi-misi', [ProfileController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/tugas-fungsi', [ProfileController::class, 'tugasFungsi'])->name('tugas-fungsi');
    Route::get('/struktur-organisasi', [ProfileController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
    Route::get('/pejabat-ppid', [ProfileController::class, 'pejabatPpid'])->name('pejabat');
    Route::get('/maklumat-pelayanan', [ProfileController::class, 'maklumatPelayanan'])->name('maklumat');
    Route::get('/standar-pelayanan', [ProfileController::class, 'standarPelayanan'])->name('standar');
    Route::get('/sop', [ProfileController::class, 'sop'])->name('sop');
    Route::get('/sop-pengujian-konsekuensi', [ProfileController::class, 'sopPengujianKonsekuensi'])->name('sop-pengujian-konsekuensi');
    Route::get('/sop-penetapan-dip', [ProfileController::class, 'sopPenetapanDip'])->name('sop-penetapan-dip');
    Route::get('/sop-pendokumentasian', [ProfileController::class, 'sopPendokumentasian'])->name('sop-pendokumentasian');
    Route::get('/sk-ppid', [ProfileController::class, 'skPpid'])->name('sk-ppid');
    Route::get('/sk-ppid/download', [ProfileController::class, 'downloadSk'])->name('sk-ppid.download');
    Route::get('/sop/{sop}/download', [ProfileController::class, 'sopDownload'])->name('sop.download');
    Route::get('/sop/{sop}/view', [ProfileController::class, 'sopView'])->name('sop.view');
});

Route::prefix('informasi-publik')->name('informasi.')->group(function () {
    Route::get('/', [InformationController::class, 'index'])->name('index');
    Route::get('/berkala', [InformationController::class, 'berkala'])->name('berkala');
    Route::get('/setiap-saat', [InformationController::class, 'setiapSaat'])->name('setiap-saat');
    Route::get('/serta-merta', [InformationController::class, 'sertaMerta'])->name('serta-merta');
    Route::get('/dikecualikan', [InformationController::class, 'dikecualikan'])->name('dikecualikan');
    Route::get('/dip-online', [InformationController::class, 'dipOnline'])->name('dip-online');
    Route::get('/daftar', [InformationController::class, 'daftarInformasi'])->name('daftar');
    Route::get('/{slug}/download', [InformationController::class, 'download'])->name('download');
    Route::get('/{slug}/view', [InformationController::class, 'viewFile'])->name('view');
    Route::get('/{slug}', [InformationController::class, 'show'])->name('show');
});

Route::prefix('dokumen')->name('dokumen.')->group(function () {
    Route::get('/', [DocumentController::class, 'index'])->name('index');
    Route::get('/{slug}', [DocumentController::class, 'show'])->name('show');
    Route::get('/{id}/download', [DocumentController::class, 'download'])->name('download');
});

Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/alur', [ServiceController::class, 'alur'])->name('alur');
    Route::get('/permohonan', [ServiceController::class, 'permohonanForm'])->name('permohonan.create');
    Route::post('/permohonan', [ServiceController::class, 'permohonanStore'])->name('permohonan.store');
    Route::get('/permohonan/sukses/{registrationNumber}', [ServiceController::class, 'permohonanSuccess'])->name('permohonan.success');
    Route::get('/cek-status', [ServiceController::class, 'cekStatus'])->name('cek-status');
    Route::post('/cek-status', [ServiceController::class, 'cekStatusResult'])->name('cek-status.result');
    Route::get('/keberatan', [ServiceController::class, 'keberatanForm'])->name('keberatan.create');
    Route::post('/keberatan', [ServiceController::class, 'keberatanStore'])->name('keberatan.store');
    Route::get('/keberatan/sukses/{registration_number}', [ServiceController::class, 'keberatanSuccess'])->name('keberatan.success');
});

Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

Route::get('/halaman/{slug}', [PageController::class, 'show'])->name('page.show');

Route::prefix('berkala')->name('berkala.')->group(function () {
    Route::get('/', [BerkalaController::class, 'index'])->name('index');
    Route::get('/profil', [BerkalaController::class, 'profil'])->name('profil');
    Route::get('/lhkpn', [BerkalaController::class, 'lhkpn'])->name('lhkpn');
    Route::get('/program', [BerkalaController::class, 'program'])->name('program');
    Route::get('/keuangan', [BerkalaController::class, 'keuangan'])->name('keuangan');
    Route::get('/akses-informasi', [BerkalaController::class, 'aksesInformasi'])->name('akses-informasi');
    Route::get('/regulasi', [BerkalaController::class, 'regulasi'])->name('regulasi');
    Route::get('/tatacara', [BerkalaController::class, 'tatacara'])->name('tatacara');
    Route::get('/pengaduan', [BerkalaController::class, 'pengaduan'])->name('pengaduan');
});

Route::prefix('pengadaan')->name('pengadaan.')->group(function () {
    Route::get('/', [PengadaanController::class, 'index'])->name('index');
    Route::get('/rencana', [PengadaanController::class, 'rencana'])->name('rencana');
    Route::get('/pemilihan', [PengadaanController::class, 'pemilihan'])->name('pemilihan');
    Route::get('/pelaksanaan', [PengadaanController::class, 'pelaksanaan'])->name('pelaksanaan');
});

Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::get('/ringkasan-akses', [LaporanController::class, 'ringkasanAkses'])->name('ringkasan-akses');
    Route::get('/tahunan', [LaporanController::class, 'laporanTahunan'])->name('tahunan');
});

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('informasi', AdminInformationController::class);
    Route::get('informasi/bulk/create', [AdminInformationController::class, 'bulkCreate'])->name('informasi.bulk-create');
    Route::post('informasi/bulk/store', [AdminInformationController::class, 'bulkStore'])->name('informasi.bulk-store');
    Route::post('informasi/{id}/toggle-status', [AdminInformationController::class, 'toggleStatus'])->name('informasi.toggle-status');

    Route::resource('dokumen', AdminDocumentController::class);
    Route::get('dokumen/bulk/create', [AdminDocumentController::class, 'bulkCreate'])->name('dokumen.bulk-create');
    Route::post('dokumen/bulk/store', [AdminDocumentController::class, 'bulkStore'])->name('dokumen.bulk-store');
    Route::post('dokumen/{id}/toggle-status', [AdminDocumentController::class, 'toggleStatus'])->name('dokumen.toggle-status');

    Route::resource('berita', AdminNewsController::class);
    Route::post('berita/{id}/toggle-status', [AdminNewsController::class, 'toggleStatus'])->name('berita.toggle-status');
    Route::post('berita/{id}/toggle-featured', [AdminNewsController::class, 'toggleFeatured'])->name('berita.toggle-featured');

    Route::resource('faq', AdminFaqController::class);
    Route::post('faq/{id}/toggle-active', [AdminFaqController::class, 'toggleActive'])->name('faq.toggle-active');
    Route::post('faq/reorder', [AdminFaqController::class, 'reorder'])->name('faq.reorder');

    Route::prefix('permohonan')->name('permohonan.')->group(function () {
        Route::get('/', [PermohonanController::class, 'index'])->name('index');
        Route::get('/{permohonan}', [PermohonanController::class, 'show'])->name('show');
        Route::post('/{permohonan}/verify', [PermohonanController::class, 'verify'])->name('verify');
        Route::post('/{permohonan}/process', [PermohonanController::class, 'process'])->name('process');
        Route::post('/{permohonan}/complete', [PermohonanController::class, 'complete'])->name('complete');
        Route::post('/{permohonan}/reject', [PermohonanController::class, 'reject'])->name('reject');
    });

    Route::prefix('keberatan')->name('keberatan.')->group(function () {
        Route::get('/', [KeberatanController::class, 'index'])->name('index');
        Route::get('/{keberatan}', [KeberatanController::class, 'show'])->name('show');
        Route::post('/{keberatan}/review', [KeberatanController::class, 'review'])->name('review');
        Route::post('/{keberatan}/respond', [KeberatanController::class, 'respond'])->name('respond');
        Route::post('/{keberatan}/resolve', [KeberatanController::class, 'resolve'])->name('resolve');
    });

    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('pesan', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('pesan/{id}/read', [ContactMessageController::class, 'markAsRead'])->name('pesan.read');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('dip', AdminDipController::class);
    Route::post('dip/{dip}/toggle-status', [AdminDipController::class, 'toggleStatus'])->name('dip.toggle-status');

    Route::resource('halaman', AdminPageController::class);

    Route::resource('lhkpn', AdminLhkpnController::class);
    Route::post('lhkpn/{lhkpn}/toggle-status', [AdminLhkpnController::class, 'toggleStatus'])->name('lhkpn.toggle-status');

    Route::resource('program', AdminProgramController::class);
    Route::post('program/{program}/toggle-status', [AdminProgramController::class, 'toggleStatus'])->name('program.toggle-status');

    Route::resource('keuangan', AdminKeuanganController::class);
    Route::post('keuangan/{keuangan}/toggle-status', [AdminKeuanganController::class, 'toggleStatus'])->name('keuangan.toggle-status');

    Route::resource('pengadaan', AdminPengadaanController::class);
    Route::post('pengadaan/{pengadaan}/toggle-status', [AdminPengadaanController::class, 'toggleStatus'])->name('pengadaan.toggle-status');

    Route::resource('sop', AdminSopController::class);
    Route::get('sop/bulk/create', [AdminSopController::class, 'bulkCreate'])->name('sop.bulk-create');
    Route::post('sop/bulk/store', [AdminSopController::class, 'bulkStore'])->name('sop.bulk-store');
    Route::post('sop/{sop}/toggle-active', [AdminSopController::class, 'toggleActive'])->name('sop.toggle-active');

    Route::resource('regulasi', AdminRegulasiController::class);
    Route::get('regulasi-import', [AdminRegulasiController::class, 'importForm'])->name('regulasi.import-form');
    Route::post('regulasi-import', [AdminRegulasiController::class, 'import'])->name('regulasi.import');
    Route::post('regulasi/{regulasi}/toggle-status', [AdminRegulasiController::class, 'toggleStatus'])->name('regulasi.toggle-status');

    Route::resource('pejabat', AdminPejabatController::class);
    Route::post('pejabat/{pejabat}/toggle-active', [AdminPejabatController::class, 'toggleActive'])->name('pejabat.toggle-active');

    Route::get('/profil', [AdminProfilController::class, 'index'])->name('profil.index');
    Route::post('/profil', [AdminProfilController::class, 'update'])->name('profil.update');
    Route::get('/profil/download-sk', [AdminProfilController::class, 'downloadSk'])->name('profil.download-sk');

    Route::post('/upload/image', [AdminUploadController::class, 'image'])->name('upload.image');
});
