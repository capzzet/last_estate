<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallbackController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/consultation', [ConsultationController::class, 'store']);
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/buildings', [BuildingsController::class, 'index'])->name('buildings');
Route::get('/for-sale', [SaleController::class, 'index'])->name('for-sale');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::post('/contacts', [ContactsController::class, 'store']);
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewsController::class, 'store'])->name('reviews.store');

Route::post('/callback', [CallbackController::class, 'store']);
