<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Auth Routes (login / register / password reset etc.)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes — must be authenticated AND be the admin email
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Skills CRUD
    Route::post('/skills', [SkillController::class, 'store'])->name('skill.store');
    Route::get('/skills/{id}/edit', [SkillController::class, 'edit'])->name('skill.edit');
    Route::put('/skills/{id}', [SkillController::class, 'update'])->name('skill.update');
    Route::delete('/skills/{id}', [SkillController::class, 'destroy'])->name('skill.destroy');

    // Portfolio CRUD
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

});