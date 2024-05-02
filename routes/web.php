<?php

use App\Http\Controllers\Web\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome',);
})->name('index');

// Route group with middleware for authenticated users
// Route::middleware('ensureWebUserLogin')->group(function () {
//     // Home page for authenticated users
//     Route::get('/home', function () {
//         return view('welcome');
//     })->name('home');
// });

// Route group for guest users (not logged in)


Route::fallback(function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
