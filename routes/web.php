<?php

use App\Http\Controllers\KundaliController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalculateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvExportController;
use App\Http\Controllers\PlanetPositionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kundali/{id}', [HomeController::class, 'detail'])->name('kundali.detail');
Route::post('/save-kundali-review', [HomeController::class, 'saveReview'])->name('kundali.saveReview');

// Account Routes (Guest)
Route::group(['prefix' => 'account'], function () {
    Route::get('register', [AccountController::class, 'register'])->name('account.register');
    Route::post('register', [AccountController::class, 'processRegister'])->name('account.processRegister');
    Route::get('login', [AccountController::class, 'login'])->name('account.login');
    Route::post('login', [AccountController::class, 'authenticate'])->name('account.authenticate');
});

// Account Routes (Authenticated)
Route::group(['prefix' => 'account'], function () {
    Route::get('profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::post('updateProfile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
});

// Kundali Routes
Route::get('kundalis', [KundaliController::class, 'index'])->name('kundalis.index');
Route::get('kundalis/create', [KundaliController::class, 'create'])->name('kundalis.create');
Route::get('kundalis/upload', [KundaliController::class, 'upload'])->name('kundalis.upload');
Route::post('kundalis/store', [KundaliController::class, 'store'])->name('kundalis.store');
Route::delete('kundalis', [KundaliController::class, 'destroy'])->name('kundalis.destroy');
Route::get('/kundalis/download-csv', [CsvExportController::class, 'downloadCsv'])->name('kundalis.downloadCsv');
Route::post('/kundalis/upload-csv', [CsvExportController::class, 'uploadCsv'])->name('kundalis.uploadCsv');
Route::get('/Kundalis/view/{id}', [KundaliController::class, 'view_details'])->name('kundalis.view_kundali');
Route::get('/kundalis/edit/{id}', [KundaliController::class, 'edit'])->name('kundalis.edit');
Route::post('/kundalis/{id}', [KundaliController::class, 'update'])->name('kundalis.update');

// Kundali Download CSV (Slide Routes)
Route::get('/kundalis/{kundali}/download-csv/slide1', [CsvExportController::class, 'downloadSlide1'])->name('download.csv.slide1');
Route::get('/kundalis/{kundali}/download-csv/slide2', [CsvExportController::class, 'downloadSlide2'])->name('download.csv.slide2');
Route::get('/kundalis/{kundali}/download-csv/slide3', [CsvExportController::class, 'downloadSlide3'])->name('download.csv.slide3');
Route::get('/kundalis/{kundali}/download-csv/slide4', [CsvExportController::class, 'downloadSlide4'])->name('download.csv.slide4');

// Calculation Routes
Route::get('kundalis/calculation', [CalculateController::class, 'showForm'])->name('showForm');
Route::post('/convert-degrees-to-dms', [CalculateController::class, 'convertDegreesToDMS'])->name('convertDegreesToDMS');
Route::post('/convert-dms-to-degrees', [CalculateController::class, 'convertDMSToDegrees'])->name('convertDMSToDegrees');
Route::post('/birth', [CalculateController::class, 'calculate'])->name('calculate');
// Route::get('kundalis/birth', [CalculateController::class, 'showbirth'])->name('kundalis.birth');

// Planet Positions Routes
// Route::get('/planet-positions', [PlanetPositionsController::class, 'showForm'])->name('planet-positions.form');
Route::post('/planet-positions', [PlanetPositionsController::class, 'getPlanetPositions'])->name('planet-positions.submit');
