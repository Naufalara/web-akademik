<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\DosenWaliController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\OperatorController;
//use App\Http\Controllers\IRSController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/welcome", function () {
    return view('welcome');
});

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [adminController::class, 'login']);
    Route::get('/dashboard/operator', [adminController::class, 'operator'])->middleware('UserAccess:operator');
    Route::get('/dashboard/dosen_wali', [adminController::class, 'dosen_wali'])->middleware('UserAccess:dosen_wali');
    Route::get('/dashboard/departemen', [adminController::class, 'departemen'])->middleware('UserAccess:departemen');
    Route::get('/dashboard/mahasiswa', [adminController::class, 'mahasiswa'])->middleware('UserAccess:mahasiswa');
    Route::get('/dashboard/guest', [adminController::class, 'guest'])->middleware('UserAccess:guest');
    Route::get('/dashboard/page_access_error', [adminController::class, 'page_error']);

    // Mahasiswa 
    Route::get('/dashboard/mahasiswa/profil/{id}', [MahasiswaController::class, 'edit_profil'])->name('edit_profil');
    Route::post('/dashboard/mahasiswa/profil/{id}/update', [MahasiswaController::class, 'update_profil'])->name('update_profil');
    Route::get('/dashboard/mahasiswa/IRS', [MahasiswaController::class, 'show_IRS']);
    Route::post('/dashboard/mahasiswa/IRS', [MahasiswaController::class, 'input_IRS'])->name('input_IRS');
    Route::get('/dashboard/mahasiswa/KHS', [MahasiswaController::class, 'show_KHS']);
    Route::post('/dashboard/mahasiswa/KHS', [MahasiswaController::class, 'input_KHS'])->name('input_KHS');
    Route::get('/dashboard/mahasiswa/PKL', [MahasiswaController::class, 'show_PKL']);
    Route::post('/dashboard/mahasiswa/PKL', [MahasiswaController::class, 'input_PKL'])->name('input_PKL');
    Route::get('/dashboard/mahasiswa/skripsi', [MahasiswaController::class, 'show_skripsi']);
    Route::post('/dashboard/mahasiswa/skripsi', [MahasiswaController::class, 'input_skripsi'])->name('input_skripsi');
    Route::get('/dashboard/mahasiswa/view-profile', [MahasiswaController::class, 'view_profile']);

    // Operator
    Route::get('/dashboard/operator/profil/{id}', [OperatorController::class, 'index'])->name('operator_index');
    Route::get('/operator/data-mahasiswa', [OperatorController::class, 'menu'])->name('show-menu-data-mahasiswa');
    Route::post('/data-mahasiswa', [OperatorController::class, 'import'])->name('import-data-mahasiswa');
    Route::post('/data-mahasiswa/reset/{id}', [OperatorController::class, 'reset'])->name('reset-data-mahasiswa');
    Route::post('/data-mahasiswa/addaccount', [OperatorController::class, 'addaccount'])->name('addaccount-data-mahasiswa');

    // guest
    Route::post('/dashboard/guest/{id}', [MahasiswaController::class, 'inputfirst'])->name('inputfirst');

    //Dosen Wali
    Route::get('/dashboard/verifikasi_irs', [DosenWaliController::class, 'index']);
    Route::post('/dashboard/verifikasi_irs/{nim}/verified', [DosenWaliController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/dashboard/verifikasi_irs/{nim}/reject', [DosenWaliController::class, 'reject'])->name('reject');
    Route::get('/dashboard/verifikasi_irs/{nim}/modify', [DosenWaliController::class, 'modify'])->name('modify');
    Route::post('/dashboard/verifikasi_irs/{nim}/update', [DosenWaliController::class, 'update'])->name('update');

    Route::get('/dashboard/verifikasi_khs', [DosenWaliController::class, 'index_khs']);
    Route::post('/dashboard/veifikasi_khs/{nim}/verified', [DosenWaliController::class, 'verifikasi_khs'])->name('verifikasi_khs');
    Route::post('/dashboard/veifikasi_khs/{nim}/reject', [DosenWaliController::class, 'reject_khs'])->name('reject_khs');
    Route::get('/dashboard/verifikasi_khs/{nim}/modify', [DosenWaliController::class, 'modify_khs'])->name('modify_khs');
    Route::post('/dashboard/verifikasi_khs/{nim}/update', [DosenWaliController::class, 'update_khs'])->name('update_khs');

    Route::get('/dashboard/verifikasi_pkl', [DosenWaliController::class, 'index_pkl']);
    Route::post('/dashboard/veifikasi_pkl/{nim}/verified', [DosenWaliController::class, 'verifikasi_pkl'])->name('verifikasi_pkl');
    Route::post('/dashboard/veifikasi_pkl/{nim}/reject', [DosenWaliController::class, 'reject_pkl'])->name('reject_pkl');
    Route::get('/dashboard/verifikasi_pkl/{nim}/modify', [DosenWaliController::class, 'modify_pkl'])->name('modify_pkl');
    Route::post('/dashboard/verifikasi_pkl/{nim}/update', [DosenWaliController::class, 'update_pkl'])->name('update_pkl');

    Route::get('/dashboard/verifikasi_skripsi', [DosenWaliController::class, 'index_skripsi']);
    Route::post('/dashboard/veifikasi_skripsi/{nim}/verified', [DosenWaliController::class, 'verifikasi_skripsi'])->name('verifikasi_skripsi');
    Route::post('/dashboard/veifikasi_skripsi/{nim}/reject', [DosenWaliController::class, 'reject_skripsi'])->name('reject_skripsi');
    Route::get('/dashboard/verifikasi_skripsi/{nim}/modify', [DosenWaliController::class, 'modify_skripsi'])->name('modify_skripsi');
    Route::post('/dashboard/verifikasi_skripsi/{nim}/update', [DosenWaliController::class, 'update_skripsi'])->name('update_skripsi');

    Route::get('dashboard/mahasiswa_perwalian', [DosenWaliController::class, 'mahasiswa_perwalian_index'])->name('mahasiswa_perwalian_index');
    Route::get('dashboard/mahasiswa_perwalian_progres/{nim}', [DosenWaliController::class, 'mahasiswa_perwalian_progres'])->name('mahasiswa_perwalian_progres');
    Route::get('dashboard/mahasiswa_perwalian_progres_detail_irs/{nim}/{semester}', [DosenWaliController::class, 'mahasiswa_perwalian_progres_irs_detail'])->name('mahasiswa_perwalian_progres_irs_detail');
    Route::get('dashboard/mahasiswa_perwalian_progres_detail_khs/{nim}/{semester}', [DosenWaliController::class, 'mahasiswa_perwalian_progres_khs_detail'])->name('mahasiswa_perwalian_progres_khs_detail');

    Route::get('dashboard/mahasiswa_perwalian_input_irs/{nim}', [OperatorController::class, 'mahasiswa_perwalian_input_irs'])->name('mahasiswa_perwalian_input_irs');
    Route::post('/dashboard/mahasiswa_perwalian_input_irs/{nim}', [OperatorController::class, 'mahasiswa_perwalian_input_irs_update'])->name('mahasiswa_perwalian_input_irs_update');

    Route::get('dashboard/mahasiswa_perwalian_input_khs/{nim}', [OperatorController::class, 'mahasiswa_perwalian_input_khs'])->name('mahasiswa_perwalian_input_khs');
    Route::post('/dashboard/mahasiswa_perwalian_input_khs/{nim}', [OperatorController::class, 'mahasiswa_perwalian_input_khs_update'])->name('mahasiswa_perwalian_input_khs_update');

    Route::get('dashboard/mahasiswa_perwalian_input_pkl/{nim}', [OperatorController::class, 'mahasiswa_perwalian_input_pkl'])->name('mahasiswa_perwalian_input_pkl');
    Route::post('/dashboard/mahasiswa_perwalian_input_pkl/{nim}', [OperatorController::class, 'mahasiswa_perwalian_input_pkl_update'])->name('mahasiswa_perwalian_input_pkl_update');

    Route::get('dashboard/mahasiswa_perwalian_input_skripsi/{nim}', [OperatorController::class, 'mahasiswa_perwalian_input_skripsi'])->name('mahasiswa_perwalian_input_skripsi');
    Route::post('/dashboard/mahasiswa_perwalian_input_skripsi/{nim}', [OperatorController::class, 'mahasiswa_perwalian_input_skripsi_update'])->name('mahasiswa_perwalian_input_skripsi_update');
    //Departemen
    Route::get('/rekap_pkl', [DepartemenController::class, 'rekappkl'])->name('rekappkl');
    Route::get('/rekap_pkl_belum', [DepartemenController::class, 'rekappkl_belum'])->name('rekappkl_belum');
    Route::get('/exportexcel_pkl', [DepartemenController::class, 'exportexcel_pkl'])->name('exportexcel_pkl');
    Route::get('/exportexcel_pkl_belum', [DepartemenController::class, 'exportexcel_pkl_belum'])->name('exportexcel_pkl_belum');
});
