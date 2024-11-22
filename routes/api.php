<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\DiagnoseController;
use App\Http\Controllers\Api\AppointmentController;


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

Route::post('/patient', [PatientController::class, 'store']);
Route::post('/service', [ServiceController::class, 'store']);
Route::post('/diagnose', [DiagnoseController::class, 'store']);
Route::middleware('api')->group(function () {
    Route::post('/appointment', [AppointmentController::class, 'store']);
});
Route::get('/appointment/{id}', [AppointmentController::class, 'show']);
Route::patch('/appointment/{id}', [AppointmentController::class, 'update']);


Route::middleware('api')->get('/test', function (Request $request) {
    return response()->json(['message' => 'API is working']);
});
