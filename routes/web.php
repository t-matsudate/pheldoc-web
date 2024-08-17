<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhelFunctionController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('/search', 'index')->name('search.index');
});

Route::controller(PhelFunctionController::class)->group(function () {
    Route::get('/function/{namespace}/{name}', 'show')->name('function.show');
});

require __DIR__.'/auth.php';
