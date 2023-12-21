<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Pages\AboutPageController;
use App\Http\Controllers\Pages\ExplorePageController;
use App\Http\Controllers\Pages\FAQPageController;
use App\Http\Controllers\Pages\FindUsPageController;
use App\Http\Controllers\Pages\HomePageController;
use App\Http\Controllers\Pages\ReviewsPageController;
use App\Http\Controllers\Pages\RoomsPageController;
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
        Route::get('/rooms-page', [RoomsPageController::class, 'edit'])->name('.rooms');
        Route::post('/rooms-page', [RoomsPageController::class, 'update'])->name('.rooms.update');
        Route::get('/reviews-page', [ReviewsPageController::class, 'edit'])->name('.reviews');
        Route::post('/reviews-page', [ReviewsPageController::class, 'update'])->name('.reviews.update');
        Route::get('/about-page', [AboutPageController::class, 'edit'])->name('.about');
        Route::post('/about-page', [AboutPageController::class, 'update'])->name('.about.update');
        Route::get('/explore-page', [ExplorePageController::class, 'edit'])->name('.explore');
        Route::post('/explore-page', [ExplorePageController::class, 'update'])->name('.explore.update');
        Route::get('/find-us-page', [FindUsPageController::class, 'edit'])->name('.findus');
        Route::post('/find-us-page', [FindUsPageController::class, 'update'])->name('.findus.update');
        Route::get('/faq-page', [FAQPageController::class, 'edit'])->name('.faq');
        Route::post('/faq-page', [FAQPageController::class, 'update'])->name('.faq.update');
    });
    Route::name('add')->prefix('add')->group(function () {
        Route::get('/', function () { return Inertia::render('AddContent/Add'); });
    });
    Route::name('preview')->prefix('preview')->group(function () {
        Route::get('/', [HomePageController::class, 'preview']);
        Route::get('/rooms', [RoomsPageController::class, 'preview'])->name('.rooms');
        Route::get('/reviews', [ReviewsPageController::class, 'preview'])->name('.reviews');
        Route::get('/about', [AboutPageController::class, 'preview'])->name('.about');
        Route::get('/explore', [ExplorePageController::class, 'preview'])->name('.explore');
        Route::get('/find-us', [FindUsPageController::class, 'preview'])->name('.findus');
    });
});

require __DIR__.'/auth.php';
