<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login-confirm', [CustomAuthController::class, 'loginConfirm'])->name('login.confirm'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');

Route::get('patient-insert', [CustomAuthController::class, 'patientInsert'])->name('patient.insert');
Route::post('patient-insert-confirm', [CustomAuthController::class, 'patientInsertConfirm'])->name('patient.insert.confirm');
Route::get('patient-select/{id}', [CustomAuthController::class, 'patientSelect'])->name('patient.select');
Route::get('patient-update/{id}', [CustomAuthController::class, 'patientUpdate'])->name('patient.update');
Route::post('patient-update-confirm', [CustomAuthController::class, 'patientUpdateConfirm'])->name('patient.update.confirm');

Route::get('prescription-insert/{pid}', [CustomAuthController::class, 'prescriptionInsert'])->name('prescription.insert');
Route::post('prescription-insert-confirm', [CustomAuthController::class, 'prescriptionInsertConfirm'])->name('prescription.insert.confirm');
Route::get('prescription-select/{id}', [CustomAuthController::class, 'prescriptionSelect'])->name('prescription.select');
Route::get('prescription-update/{id}', [CustomAuthController::class, 'prescriptionUpdate'])->name('prescription.update');
Route::post('prescription-update-confirm', [CustomAuthController::class, 'prescriptionUpdateConfirm'])->name('prescription.update.confirm');

Route::get('payment-insert/{ppid}', [CustomAuthController::class, 'paymentInsert'])->name('payment.insert');
Route::post('payment-insert-confirm', [CustomAuthController::class, 'paymentInsertConfirm'])->name('payment.insert.confirm');
Route::get('payment-select/{id}', [CustomAuthController::class, 'paymentSelect'])->name('payment.select');

Route::get('report-today/{date}', [CustomAuthController::class, 'reportToday'])->name('report.today');
Route::post('report-date', [CustomAuthController::class, 'reportDate'])->name('report.date');


