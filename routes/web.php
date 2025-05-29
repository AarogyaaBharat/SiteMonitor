<?php

use App\Http\Controllers\PageSpeedController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteCheckerController;
use App\Http\Controllers\BacklinkCheckController;

Route::get('/', function () {
    return view('home');
});
Route::get('/site-checker',[SiteCheckerController::class, 'generate'])->name('site-checker');
Route::post('/check-urls-from-excel',[SiteCheckerController::class, 'checkUrlsFromExcel'])->name('check-urls-from-excel');
Route::get('/check-urls-regx',function () {
    return view('RegexQuery');
})->name('check-urls-regx');
Route::get('/check-urls-regx-result',[SiteCheckerController::class, 'checkUrlsRegx'])->name('check-urls-regx-result');
Route::get('/check-page-speed-metrics',[PageSpeedController::class, 'trackMetrics'])->name('check-page-speed-metrics');
Route::get('/check-page-speed',function () {
    return view('Pagespeedcheck');
})->name('check-page-speed');
Route::get('/check-backlinks', [BacklinkCheckController::class, 'check']);