<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinsiController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/index', function () {
    return view('layouts.master.index');
});

Route::get('admin',function(){
    return view('admin.index');
});
Route::resource('provinsi', ProvinsiController::class);
Route::get('/kota', function () {
    return view('admin.kota.index');
});

Route::get('/kecamatan', function () {
    return view('admin.kecamatan.index');
});

Route::get('/kelurahan', function () {
    return view('admin.kelurahan.index');
});

Route::get('/rw', function () {
    return view('admin.rw.index');
});

Route::get('/laporan', function () {
    return view('admin.laporan.index');
});