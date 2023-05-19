<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\SocietiesController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\UserController;
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
//Authentication
Route::post('v1/auth/register', [SocietiesController::class, 'register']);
Route::post('v1/auth/login', [SocietiesController::class, 'login']);
Route::post('v1/auth/logout', [SocietiesController::class, 'logout']);
Route::post('register/user', [UserController::class, 'register']);

//Request Consultation
Route::get('v1/consultations/{society_id}', [ConsultationController::class, 'show'])->middleware('auth:sanctum');
Route::post('v1/consultations', [ConsultationController::class, 'create'])->middleware('auth:sanctum');

//Spots
Route::get('v1/spots/{regional_id}', [SpotController::class, 'show']);
