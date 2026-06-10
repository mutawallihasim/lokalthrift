<?php
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
});

use App\Http\Controllers\AuthController;

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');