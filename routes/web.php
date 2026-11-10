<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PricingController;
use Illuminate\Support\Facades\Route;

// Public Directory Routes
Route::get('/', HomeController::class)->name('home');

Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('/listings/{slug}', [ListingController::class, 'show'])->name('listings.show');
Route::post('/listings/{listing}/claim', [ListingController::class, 'claim'])->name('listings.claim');
Route::post('/listings/{listing}/lead', [ListingController::class, 'lead'])->name('listings.lead');
Route::post('/listings/{listing}/review', [ListingController::class, 'review'])->name('listings.review');

Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/pricing', PricingController::class)->name('pricing');
