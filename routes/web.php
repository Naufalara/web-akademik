<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\MahasiswaController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [adminController::class, 'login']);
    Route::get('/dashboard/operator', [adminController::class, 'operator'])->middleware('UserAccess:operator');
    Route::get('/dashboard/dosen_wali', [adminController::class, 'dosen_wali'])->middleware('UserAccess:dosen_wali');
    Route::get('/dashboard/departemen', [adminController::class, 'departemen'])->middleware('UserAccess:departemen');
    Route::get('/dashboard/mahasiswa', [adminController::class, 'mahasiswa'])->middleware('UserAccess:mahasiswa');
    Route::get('/dashboard/page_access_error', [adminController::class, 'page_error']);
});
