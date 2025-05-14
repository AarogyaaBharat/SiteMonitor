<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteCheckerController;

Route::get('/', function () {
    return view('home');
});
Route::get('/site-checker',[SiteCheckerController::class, 'generate'])->name('site-checker');
Route::post('/check-urls-from-excel',[SiteCheckerController::class, 'checkUrlsFromExcel'])->name('check-urls-from-excel');