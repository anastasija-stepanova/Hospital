<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalAppointmentController;
use App\Http\Controllers\PatientController;
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

Route::post('/doctor', [DoctorController::class, 'create']);
Route::post('/patient', [PatientController::class, 'create']);
Route::post('/appointment', [MedicalAppointmentController::class, 'create']);
Route::get('/appointments', [MedicalAppointmentController::class, 'list']);
