<?php

use App\Http\Controllers\ConciergeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\VillaController;
use App\Http\Controllers\YachtController;
use Illuminate\Support\Facades\Route;

Route::get('/',              [HomeController::class,        'index'])->name('home');

Route::get('/villas',        [VillaController::class,       'index'])->name('villas.index');
Route::get('/villas/{villa}', [VillaController::class,      'show'])->name('villas.show');

Route::get('/yachts',        [YachtController::class,       'index'])->name('yachts.index');
Route::get('/yachts/{yacht}', [YachtController::class,      'show'])->name('yachts.show');

Route::get('/destinations',               [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/magazine',              [MagazineController::class, 'index'])->name('magazine.index');
Route::get('/magazine/{magazinePost}', [MagazineController::class, 'show'])->name('magazine.show');

Route::get('/concierge', [ConciergeController::class, 'index'])->name('concierge');

Route::get('/contact',  [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
