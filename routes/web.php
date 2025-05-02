<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanDetailsController;
use App\Http\Controllers\EmiProcessingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// loan view
Route::get('/loan-details', [LoanDetailsController::class, 'index'])->middleware('auth');

// emi
Route::get('/process-emi', [EmiProcessingController::class, 'showForm'])->name('process.emi')->middleware('auth');
Route::post('/process-emi', [EmiProcessingController::class, 'process'])->name('emi.process')->middleware('auth');
Route::get('/view-emi-details', [EmiProcessingController::class, 'viewEmiDetails'])->name('emi.list')->middleware('auth');
