<?php

use App\Http\Controllers\CinemaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CinemaController::class, 'show'])->name("home");
Route::post('/book-seats', [CinemaController::class, 'book']);
