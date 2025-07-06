<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\VacationsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\InfoPortalController;
use App\Http\Controllers\ProjectTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events', [CalendarController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [CalendarController::class, 'show'])->name('events.show');

    // Projects routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project?}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/tasks/{task}', [ProjectTaskController::class, 'show'])->name('tasks.show');

    // Other resource routes
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::get('/vacancies', [VacationsController::class, 'index'])->name('vacancies');
    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees');
    Route::get('/messenger', [MessengerController::class, 'index'])->name('messenger');
    Route::get('/info-portal', [InfoPortalController::class, 'index'])->name('info-portal');
});

require __DIR__ . '/auth.php';
