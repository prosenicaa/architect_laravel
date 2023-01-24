<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\FlatBuildingController;
use App\Http\Controllers\ArchitectController;
use App\Http\Controllers\ArchitectBuildingController;
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


Route::get('/architects', [ArchitectController::class, 'index']);
Route::get('/architects/{id}', [ArchitectController::class, 'show']);

Route::get('/flats', [FlatController::class, 'index']);
Route::get('/flats/{id}', [FlatController::class, 'show']);

Route::get('/buildings', [BuildingController::class, 'index']);
Route::get('/buildings/{id}', [BuildingController::class, 'show']);

Route::resource('architects.buildings', ArchitectBuildingController::class)
    ->only(['index']);

Route::resource('flats.buildings', FlatBuildingController::class)
    ->only(['index']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::resource('/architects', ArchitectController::class)
        ->only(['store', 'update', 'destroy']);

    Route::resource('/flats', FlatController::class)
        ->only(['store', 'update', 'destroy']);

    Route::resource('/buildings', BuildingController::class)
        ->only(['store', 'update', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});