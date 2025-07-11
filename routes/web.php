<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\JournalController::class, 'index']);

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index']);

Route::get('/journal', [App\Http\Controllers\JournalController::class, 'index'])->name('journal');
Route::get('/journal-details', [App\Http\Controllers\JournalController::class, 'journalDetails'])->name('journal-details');
Route::get('/journal-master',  [App\Http\Controllers\JournalController::class, 'journalMaster'])->name('journal-master');
Route::get('/payment-reports',  [App\Http\Controllers\JournalController::class, 'paymentReports'])->name('payment-reports');
// Route::get('/payment-reports',  [App\Http\Controllers\JournalController::class, 'paymentReports1'])->name('payment-reports');
