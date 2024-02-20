<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PageFlagsController;
use App\Http\Controllers\Pages\AboutPageController;
use App\Http\Controllers\Pages\ExplorePageController;
use App\Http\Controllers\Pages\FAQPageController;
use App\Http\Controllers\Pages\FindUsPageController;
use App\Http\Controllers\Pages\HomePageController;
use App\Http\Controllers\Pages\ReviewsPageController;
use App\Http\Controllers\Pages\RoomsPageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\WebsiteController;
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

Route::domain('websitebuilder.ftb.sites')->group(function () {
    Route::get('/', function () { return Inertia::render('LandingPage'); })->name('landing');

    Route::middleware('auth')->group(function () {
        Route::name('account')->prefix('account')->group(function () {
            Route::get('/', [AccountController::class, 'edit']);
            Route::patch('/', [AccountController::class, 'update'])->name('.update');
            Route::post('/', [AccountController::class, 'subdomain'])->name('.subdomain');
            Route::delete('/', [AccountController::class, 'destroy'])->name('.destroy');
        });

        Route::name('edit')->prefix('edit')->group(function () {
            Route::get('/', [PageFlagsController::class, 'edit']);
            Route::get('/property', [PropertyController::class, 'edit'])->name('.property');
            Route::post('/property', [PropertyController::class, 'update'])->name('.property.update');
            Route::get('/website', [WebsiteController::class, 'edit'])->name('.website');
            Route::post('/website', [WebsiteController::class, 'update'])->name('.website.update');
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
            Route::get('/', [PageFlagsController::class, 'add']);
            Route::get('/reviews-page', [ReviewsPageController::class, 'add'])->name('.reviews');
            Route::post('/reviews-page', [ReviewsPageController::class, 'create'])->name('.reviews.create');
            Route::get('/about-page', [AboutPageController::class, 'add'])->name('.about');
            Route::post('/about-page', [AboutPageController::class, 'create'])->name('.about.create');
            Route::get('/explore-page', [ExplorePageController::class, 'add'])->name('.explore');
            Route::post('/explore-page', [ExplorePageController::class, 'create'])->name('.explore.create');
            Route::get('/find-us-page', [FindUsPageController::class, 'add'])->name('.findus');
            Route::post('/find-us-page', [FindUsPageController::class, 'create'])->name('.findus.create');
            Route::get('/faq-page', [FAQPageController::class, 'add'])->name('.faq');
            Route::post('/faq-page', [FAQPageController::class, 'create'])->name('.faq.create');
        });

        Route::name('preview')->prefix('preview')->group(function () {
            Route::get('/', [HomePageController::class, 'preview']);
            Route::get('/rooms', [RoomsPageController::class, 'preview'])->name('.rooms');
            Route::get('/reviews', [ReviewsPageController::class, 'preview'])->name('.reviews');
            Route::get('/about', [AboutPageController::class, 'preview'])->name('.about');
            Route::get('/explore', [ExplorePageController::class, 'preview'])->name('.explore');
            Route::get('/find-us', [FindUsPageController::class, 'preview'])->name('.findus');
            Route::get('/faq', [FAQPageController::class, 'preview'])->name('.faq');
        });

        Route::get('/download', [AccountController::class, 'download'])->name('download');
    });
});

Route::domain('{subdomain}.ftb.sites')->group(function () {
    Route::name('website')->group(function () {
        Route::get('/', [HomePageController::class, 'display']);
        Route::get('/rooms', [RoomsPageController::class, 'display'])->name('.rooms');
        Route::get('/reviews', [ReviewsPageController::class, 'display'])->name('.reviews');
        Route::get('/about', [AboutPageController::class, 'display'])->name('.about');
        Route::get('/explore', [ExplorePageController::class, 'display'])->name('.explore');
        Route::get('/find-us', [FindUsPageController::class, 'display'])->name('.findus');
        Route::get('/faq', [FAQPageController::class, 'display'])->name('.faq');
    });
});

require __DIR__.'/auth.php';
