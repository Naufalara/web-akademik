<?php

use App\Http\Controllers\adminController;
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
Route::get('/dashboard/mahasiswa/profil/{id}', [MahasiswaController::class, 'index'])->name('mahasiswa_index');
Route::get('/dashboard/mahasiswa/IRS', [MahasiswaController::class, 'show_IRS']);
Route::get('/dashboard/mahasiswa/KHS', [MahasiswaController::class, 'show_KHS']);
Route::get('/dashboard/mahasiswa/PKL', [MahasiswaController::class, 'show_PKL']);
Route::get('/dashboard/mahasiswa/skripsi', [MahasiswaController::class, 'show_skripsi']);
Route::get('/operator/data-mahasiswa', [OperatorController::class, 'menu'])->name('show-menu-data-mahasiswa');
Route::post('/data-mahasiswa', [OperatorController::class, 'import'])->name('import-data-mahasiswa');
Route::post('/data-mahasiswa/reset', [OperatorController::class, 'reset'])->name('reset-data-mahasiswa');

Route::post('/dashboard/guest/{id}', [MahasiswaController::class, 'inputfirst'])->name('inputfirst');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [adminController::class, 'login']);
    Route::get('/dashboard/operator', [adminController::class, 'operator'])->middleware('UserAccess:operator');
    Route::get('/dashboard/dosen_wali', [adminController::class, 'dosen_wali'])->middleware('UserAccess:dosen_wali');
    Route::get('/dashboard/departemen', [adminController::class, 'departemen'])->middleware('UserAccess:departemen');
    Route::get('/dashboard/mahasiswa', [adminController::class, 'mahasiswa'])->middleware('UserAccess:mahasiswa');
    Route::get('/dashboard/guest', [adminController::class, 'guest'])->middleware('UserAccess:guest');
    Route::get('/dashboard/page_access_error', [adminController::class, 'page_error']);
});
