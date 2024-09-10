<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TampilanController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\DataController;


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




// Route untuk menampilkan formulir
Route::get('/', [UserController::class, 'create'])->name('users.create');
// Route untuk menyimpan data pengguna dari formulir
Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route untuk menampilkan data pengguna
Route::get('/users', [UserController::class, 'index'])->name('users.index');


// Route::get('/login', function () {
//     return view('users.login');
// });
// Route::get('/daftar', function () {
//     return view('users.daftar');
// });



// Route::get('/data', function () {
//     return view('datalatih');
// });

// Route::get('/tampil', function () {
//     return view('tampilandata');
// });

// Route::get('/tampilan', [TampilanController::class, 'index']);

// Route::get('/coba', function () {
//     return view('coba');
// });

// Route::post('/submit', [SimpanController::class, 'store']);

// Route::get('/yoga', function () {
//     return view('latihan.halamanlogin');
// });

// Route::get('/lay', [LayoutController::class, 'index']);

// Route::prefix('layout')->group(function () {
//     Route::get('/dashboard', [LayoutController::class, 'dashboard']);
//     Route::get('/index', [LayoutController::class, 'index']);
//     Route::get('/dataproduksi', [LayoutController::class, 'dataproduksi']);
//     Route::get('/monitor', [LayoutController::class, 'monitor']);
//     Route::get('/setup', [LayoutController::class, 'setup']);
//     Route::get('/baru', [LayoutController::class, 'baru']);
// });

// Route::prefix('data')->group(function () {
//     // Route::get('/daftar', [DataController::class, 'daftar']);
//     Route::get('/login', [DataController::class, 'login']);
// });
