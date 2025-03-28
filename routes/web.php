<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\EntertainmentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RatingController;


Route::get('/', function () {
    return redirect()->route('login');
});

//Rutas para el login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas Protegidas Con Middleware
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

});
// Rutas para realizar busquedas
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::middleware(['auth'])->group(function () {
    Route::get('/entertainment', [EntertainmentController::class, 'index'])->name('entertainment.index');
});
Route::post('/rate-movie', [RatingController::class, 'store'])->name('rate.movie');