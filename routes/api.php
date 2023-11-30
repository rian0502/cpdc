<?php

use App\Http\Controllers\CekJadwalController;
use App\Http\Controllers\google_scholar\SyncScholar;
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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/check-jadwal', [CekJadwalController::class, 'checkJadwal']);
Route::put('/check-update', [CekJadwalController::class, 'checkUpdate']);
Route::get('/google-scholar/{userId}', [SyncScholar::class, 'scrapeGoogleScholar']);
