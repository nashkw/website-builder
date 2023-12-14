<?php

use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/', function () { return Inertia::render('LandingPage'); });

Route::middleware('auth')->group(function () {
    Route::name('account')->prefix('account')->group(function () {
        Route::get('/', [AccountController::class, 'edit']);
        Route::patch('/', [AccountController::class, 'update'])->name('.update');
        Route::delete('/', [AccountController::class, 'destroy'])->name('.destroy');
    });
    Route::name('edit')->prefix('edit')->group(function () {
        Route::get('/', function () { return Inertia::render('EditContent/Edit'); });
        Route::get('/home-page', [HomePageController::class, 'edit'])->name('.home');
        Route::post('/home-page', [HomePageController::class, 'update'])->name('.home.update');
    });
    Route::name('add')->prefix('add')->group(function () {
        Route::get('/', function () { return Inertia::render('AddContent/Add'); });
    });
    Route::name('preview')->prefix('preview')->group(function () {
        Route::get('/', [HomePageController::class, 'preview']);
        Route::get('/about', [AboutPageController::class, 'preview'])->name('.about');
    });
});

require __DIR__.'/auth.php';
