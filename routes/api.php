<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\API\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//per indonesia
Route::get('/indonesia', [ApiController::class, 'indonesia']);

// per provinsi
Route::get('/provinsi', [ApiController::class, 'provinsi']);
Route::get('/provinsi/{id}', [ApiController::class, 'showprovinsi']);

Route::get('/kota', [ApiController::class, 'kota']);
Route::get('/kota/{id}', [ApiController::class, 'showkota']);

Route::get('/kecamatan', [ApiController::class, 'kecamatan']);
Route::get('/kecamatan/{id}', [ApiController::class, 'showkecamatan']);

Route::get('/kelurahan', [ApiController::class, 'kelurahan']);
Route::get('/kelurahan/{id}', [ApiController::class, 'showkelurahan']);

Route::get('/rw', [ApiController::class, 'rw']);
Route::get('/rw/{id}', [ApiController::class, 'showrw']);

Route::get('negara',[ ApiController::class,'negara']);