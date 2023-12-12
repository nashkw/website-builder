<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('LandingPage');
});

Route::get('/edit', function () {
    return Inertia::render('EditContent/Edit');
})->middleware(['auth'])->name('edit');

Route::name('edit.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/edit/home-page', [HomePageController::class, 'edit'])->name('home');
        Route::post('/edit/home-page', [HomePageController::class, 'update'])->name('home.update');
    });
});

Route::get('/add', function () {
    return Inertia::render('AddContent/Add');
})->middleware(['auth'])->name('add');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');
});

Route::get('/preview', function () {
    return Inertia::render('GeneratedSite/Home');
})->middleware(['auth'])->name('preview');

require __DIR__.'/auth.php';
