<?php

use App\Http\Controllers\MunicipalGeometryController;
use App\Http\Controllers\UserPointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('municipal')
    ->group(function () {
        Route::post('/find',[MunicipalGeometryController::class,'find']);
    });


Route::prefix('user-point')->group(function () {
    Route::get('/', [UserPointController::class, 'index']);
    Route::get('/{id}', [UserPointController::class, 'show']);
    Route::post('/', [UserPointController::class, 'store']);
    Route::put('/{id}', [UserPointController::class, 'update']);
    Route::delete('/{id}', [UserPointController::class, 'destroy']);
});
