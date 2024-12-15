<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhelFunctionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsageExampleController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('/search', 'index')->name('search.index');
});

Route::controller(PhelFunctionController::class)->group(function () {
    Route::get('/function/{namespace}/{name}', 'show')
        ->name('function.show');
    Route::get('/function/draft/create', 'createDraft')
        ->middleware('auth')
        ->name('function.draft.create');
    Route::post('/function/draft/create', 'storeDraft')
        ->middleware('auth')
        ->name('function.draft.store');
    Route::get('/function/draft/{id}', 'showDraft')
        ->name('function.draft.show');
    Route::get('/function/draft/{id}/edit', 'editDraft')
        ->middleware('auth')
        ->name('function.draft.edit');
    Route::post('/function/draft/{id}/edit', 'updateDraft')
        ->middleware('auth')
        ->name('function.draft.update');
});

Route::controller(UsageExampleController::class)->group(function () {
    Route::post('/function/example/create', 'store')
        ->middleware('auth')
        ->name('function.example.store');
});

require __DIR__.'/auth.php';
