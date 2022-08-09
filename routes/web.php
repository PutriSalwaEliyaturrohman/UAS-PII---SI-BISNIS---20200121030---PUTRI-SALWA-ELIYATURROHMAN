<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\dosen\AbsenMhsController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\KontrakMataKuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AbsenController;


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

Route::middleware(['auth'])->group(function () {
    Route::resource('/absenMhs', AbsenMhsController::class);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['admin'])->name('index');

Route::get('/test', function(){
    return view('tester');
})->middleware('mahasiswa');

Route::resources([
    'mahasiswa'=> MahasiswaController::Class,
    'matakuliah' => MataKuliahController::Class,
    'absen'=> AbsenController::Class,
    'jadwal'=> JadwalController::Class,
    'kontrakmatakuliah'=>KontrakMataKuliahController::Class,
    'semester'=>SemesterController::Class,

]);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('admin')
                ->name('logout');


require __DIR__.'/auth.php';
