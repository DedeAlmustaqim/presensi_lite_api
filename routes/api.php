<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/api_login', [AuthController::class, 'api_login']);
Route::post('/admin_login', [AuthController::class, 'admin_login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::prefix('user')->group(function () {
        Route::get('/{id}', [UserController::class, 'index']);
        Route::get('/get_by_unit/{id}', [UserController::class, 'get_by_unit']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/', [UserController::class, 'update']);
        Route::post('/verifikasi_loc', [UserController::class, 'verifyLocation']);
        Route::post('/qr_in', [UserController::class, 'qr_in']);
        Route::post('/qr_out', [UserController::class, 'qr_out']);
        Route::post('/ijin', [UserController::class, 'ijin']);
        Route::post('/get_ijin_bulanan', [UserController::class, 'get_ijin_bulanan']);
        Route::post('/get_rekap_bulanan', [UserController::class, 'get_rekap_bulanan']);
        Route::post('/get_today', [UserController::class, 'get_today']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
    Route::prefix('unit')->group(function () {
        Route::get('/', [UnitController::class, 'index']);
        Route::get('/show/{id}', [UnitController::class, 'show']);
        Route::post('/', [UnitController::class, 'store']);
        Route::put('/{id}', [UnitController::class, 'update']);
        Route::delete('/{id}', [UnitController::class, 'destroy']);
    });
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::post('/', [NewsController::class, 'store']);
        Route::get('/show/{id}', [NewsController::class, 'show']);
        Route::put('/{id}', [NewsController::class, 'update']);
        Route::delete('/{id}', [NewsController::class, 'destroy']);
    });
    Route::prefix('info')->group(function () {
        Route::get('/', [InfoController::class, 'index']);
        Route::post('/', [InfoController::class, 'store']);
        Route::get('/show/{id}', [InfoController::class, 'show']);
        Route::put('/{id}', [InfoController::class, 'update']);
        Route::delete('/{id}', [InfoController::class, 'destroy']);
    });
    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerController::class, 'index']);
        Route::post('/', [BannerController::class, 'store']);
        Route::put('/{id}', [BannerController::class, 'update']);
        Route::delete('/{id}', [BannerController::class, 'destroy']);
    });
});



Route::prefix('scan')->group(function () {
    Route::get('/{id}', [ScanController::class, 'index']);
    // Route::post('/', [ScanController::class, 'store']);
    // Route::put('/{id}', [ScanController::class, 'update']);
    // Route::delete('/{id}', [ScanController::class, 'destroy']);
});


