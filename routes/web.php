<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CongressController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', function () {
        return view('pages.perfil');
    })->name('perfil');
});    

Route::get('/catalogo', [CatalogController::class, 'index']);
Route::get('/congressos', [CongressController::class, 'index']);
Route::get('/planos', [PlanController::class, 'index']);
Route::get('/eventos', [\App\Http\Controllers\EventController::class, 'index']);
Route::get('/cursos', [CourseController::class, 'index']);
Route::get('/cursos/{course}', [CourseController::class, 'show']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/bling/redirect', [AuthController::class, 'redirectBling'])->name('bling.redirect');
Route::get('/bling/callback', [AuthController::class, 'callbackBling'])->name('bling.callback');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
