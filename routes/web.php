<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ComplaintController;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/event', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('events.show');

Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinasi/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

Route::post('/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
Route::view('/about', 'about')->name('about');