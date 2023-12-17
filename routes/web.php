<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\CsvImportFormController;
use App\Http\Controllers\EmailController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/import-csv', [CsvImportController::class, 'import'])->name('csv.import');
Route::get('/import-csv-form', [CsvImportFormController::class, 'showForm'])->name('csv.import.form');
Route::get('/send-emails', [EmailController::class, 'sendEmails']);
