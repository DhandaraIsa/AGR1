<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CongressController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return Auth::check()
        ? view('pages.home')
        : redirect()->route('login');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', function () {
        return view('pages.perfil');
    })->name('perfil');

    Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalogo');
    Route::get('/congressos', [CongressController::class, 'index'])->name('congressos');
    Route::get('/planos', [PlanController::class, 'index'])->name('planos');
    Route::get('/eventos', [EventController::class, 'index'])->name('eventos');
    Route::get('/cursos', [CourseController::class, 'index'])->name('cursos');
    Route::get('/cursos/{course}', [CourseController::class, 'show'])->name('cursos.show');
    Route::get('/experiencias', [ExperienceController::class, 'index'])->name('experiencias');
    Route::get('/agr-prime', [ExperienceController::class, 'index'])->name('agr-prime');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/bling/redirect', [AuthController::class, 'redirectBling'])->name('bling.redirect');
Route::get('/bling/callback', [AuthController::class, 'callbackBling'])->name('bling.callback');
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
