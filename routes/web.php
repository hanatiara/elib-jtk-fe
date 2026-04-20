<?php

use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemberkasanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RepoController;
use Illuminate\Support\Facades\Route;

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



// Repositori
route::get('/cari-dokumen', [RepoController::class, 'viewRepo']);
route::get('/detail-dokumen/{idBerkas}', [RepoController::class, 'viewDetailTA'])->name('view.repo');
route::get('/download-repo/{idBerkas}', [RepoController::class, 'downloadRepo'])->name('download.repo');

// route::get('/laporan-bimbingan', [BimbinganController::class, 'viewLaporanBimbingan']);
route::get('/komentar-bimbingan', [BimbinganController::class, 'viewKomentar']);

// Pemberkasan
route::get('/pemberkasan-koor', [PemberkasanController::class, 'viewPemberkasanKoor']);
route::get('/pengumpulan-berkas', [PemberkasanController::class, 'viewPengumpulan']);

// Login
route::get('/login', [LoginController::class, 'index'])->name('login');
route::post('/login', [LoginController::class, 'authenticate']);
route::get('/logout', [LoginController::class, 'logout']);
route::get('/lupa-pass', [LoginController::class, 'resetPasswordForm'])->name('forgot-password.form');

Route::group(['middleware' => 'user.authentication'], function () {
    //Koordinator
    Route::group(['middleware' => 'koordinator.authentication'], function () {
        route::get('/manage-data-user', [UserController::class, 'menuDataUser'])->name('menu.user');

        // Manage Jadwal
        route::get('/kelola-jadwal', [JadwalController::class, 'index'])->name('kelola.jadwal');
        route::post('/upload-jadwal', [JadwalController::class, 'uploadJadwal']);

        // Manage Dosen
        route::get('/manage-data-dosen', [DosenController::class, 'index'])->name('dosen.manage');
        route::get('/edit-data-dosen/{idDosen}', [DosenController::class, 'formUpdateDosen'])->name('dosen.formUpdate');
        route::post('/update-dosen/{idDosen}', [DosenController::class, 'updateDosen'])->name('dosen.update');

        // Manage Akun
        route::get('/manage-akun', [UserController::class, 'index'])->name('user.manage');
        route::get('/form-akun-dosen', [UserController::class, 'viewImportDosen'])->name('user.formImport');
        route::post('/import-akun-dosen', [UserController::class, 'importAkunDosen'])->name('user.import');
        route::get('/form-akun-kota', [UserController::class, 'viewImportKota']);
        route::post('/import-akun-kota', [UserController::class, 'importAkunKota']);
        route::get('/form-edit-user/{idUser}', [UserController::class, 'formUpdateUserDosen'])->name('user.formUpdate');
        route::post('/update-user/{idUser}', [UserController::class, 'updateUserDosen'])->name('user.update');
        route::get('/download-template/{namaBerkas}', [UserController::class, 'downloadTemplate'])->name('user.download');

        // Manage Kota
        route::get('/manage-kota',[KotaController::class, 'index'])->name('kota.index');
        route::get('/delete-kota/{idKota}',[KotaController::class, 'deleteKota'])->name('kota.delete');
        route::post('/create-kota',[KotaController::class, 'createKota'])->name('kota.create');
        route::view('/register-kota', 'v_register-kota')->name('kota.register');
        route::get('/form-kota/{idKota}',[KotaController::class, 'formUpdateKota'])->name('kota.formUpdate');
        route::post('/update-kota/{idKota}',[KotaController::class, 'updateKota'])->name('kota.update');
        route::get('/view-kota/{idKota}',[KotaController::class, 'viewKota'])->name('kota.view');

        // Bimbingan
        route::get('/lihat-bimbingan', [BimbinganController::class, 'viewBimbinganKoor']);

        // Pemberkasan
        route::get('/lihat-berkas/{seminar_type}', [PemberkasanController::class, 'viewPemberkasanKoor']);
        route::get('/download-berkas-koor/{idBerkas}', [PemberkasanController::class, 'downloadBerkasKoordinator'])->name('berkas.download.koor');

    });
    // Kota
    route::group(['middleware' => 'kota.authentication'], function () {
        // Bimbingan
        route::get('/bimbingan', [BimbinganController::class, 'viewBimbinganKota']);
        route::get('/laporan-bimbingan', [BimbinganController::class, 'viewAjukanBimbingan']);
        route::post('/ajukan-bimbingan', [BimbinganController::class, 'ajukanBimbingan']);
        route::get('/cek-bimbingan/{idBimbingan}', [BimbinganController::class, 'viewExistingBimbingan'])->name('bimbingan.cek');
        route::post('/update-bimbingan-kota/{idBimbingan}', [BimbinganController::class, 'updateExistingBimbingan'])->name('bimbingan.update.kota');

        // Pemberkasan
        route::get('/update-berkas/{seminar_type}', [PemberkasanController::class, 'viewPengumpulan']);
        route::post('/update-berkas/{seminar_type}', [PemberkasanController::class, 'uploadPengumpulan']);
        route::get('/pemberkasan-kota/{seminar_type}', [PemberkasanController::class, 'viewPemberkasanKota']);
    });

    // Pembimbing
    route::group(['middleware' => 'pembimbing.authentication'], function() {
        // Bimbingan
        route::get('/review-bimbingan', [BimbinganController::class, 'viewAjukanPembimbing']);
        route::get('/manage-bimbingan', [BimbinganController::class, 'viewBimbinganPembimbing']);
        route::get('/komentar-bimbingan/{idBimbingan}', [BimbinganController::class, 'viewKomentarBimbingan'])->name('bimbingan.komentar');
        route::post('/update-bimbingan/{idBimbingan}', [BimbinganController::class, 'komentarBimbingan'])->name('bimbingan.update');
        route::post('/accept-bimbingan/{idBimbingan}', [BimbinganController::class, 'acceptBimbingan'])->name('bimbingan.accept');
        route::get('/download-bimbingan/{idBimbingan}', [BimbinganController::class, 'downloadAttachment'])->name('bimbingan.download');
        route::get('/manage-bimbingan-kota/{idKota}', [BimbinganController::class, 'viewBimbinganPerKota']);
    });

    // Penguji
    route::group(['middleware' => 'penguji.authentication'], function() {
        route::get('/detail-berkas-kota/{idKota}', [PemberkasanController::class, 'viewDetailBerkas']);
        route::get('/download-berkas/{idBerkas}/{document}/{seminar_type}', [PemberkasanController::class, 'downloadBerkas'])->name('berkas.download');
    });

    // Information board
    route::get('/', [JadwalController::class, 'viewInfo'])->name('information.board');

    route::get('/ubah-password', [UserController::class, 'viewUbahPassword']);
    route::post('/ubah-password/{idUser}', [UserController::class, 'ubahPassword'])->name('password.update');
});




