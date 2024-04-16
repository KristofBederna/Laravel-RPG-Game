<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ContestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class);

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/characters', [CharacterController::class, 'index'])->name('characters')->middleware('auth');
Route::get('/characters/{id}', [CharacterController::class, 'show'])->name('characters.show');
Route::get('/characters/{character}', [CharacterController::class, 'show'])->name('characters.show')->middleware('auth');
Route::get('/characters/{character}/{userId}', [CharacterController::class, 'show'])->name('characters.show');

Route::get('/contests/{id}', 'ContestController@show')->name('contests.show');

Route::middleware(['auth', 'can:accessCharacter,character'])->group(function () {
    Route::get('/characters/{character}/edit', 'CharacterController@edit')->name('characters.edit');
    Route::delete('/characters/{character}', 'CharacterController@destroy')->name('characters.destroy');
    Route::get('/characters/{character}/matches/create', 'CharacterController@createMatch')->name('characters.matches.create');
});

Route::middleware(['auth', 'can:accessCharacter,character'])->group(function () {
    Route::put('/characters/{character}', 'CharacterController@update')->name('characters.update');
});

Route::get('/contests/{id}', [ContestController::class, 'show'])->name('contests.show');




