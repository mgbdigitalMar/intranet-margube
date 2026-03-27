<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;

// Auth routes
Route::get('/', fn() => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require login)
Route::middleware('auth.custom')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // News & Events
    Route::resource('news', NewsController::class)->except(['show']);

    // Room Reservations
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::post('/rooms/{id}/approve', [RoomController::class, 'approve'])->name('rooms.approve');

    // Car Reservations
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::post('/cars/{id}/approve', [CarController::class, 'approve'])->name('cars.approve');

    // Purchase Requests
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::post('/purchases/{id}/approve', [PurchaseController::class, 'approve'])->name('purchases.approve');
    Route::post('/purchases/{id}/reject', [PurchaseController::class, 'reject'])->name('purchases.reject');

    // Absences
    Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
    Route::get('/absences/create', [AbsenceController::class, 'create'])->name('absences.create');
    Route::post('/absences', [AbsenceController::class, 'store'])->name('absences.store');
    Route::delete('/absences/{id}', [AbsenceController::class, 'destroy'])->name('absences.destroy');
    Route::post('/absences/{id}/approve', [AbsenceController::class, 'approve'])->name('absences.approve');
    Route::post('/absences/{id}/reject', [AbsenceController::class, 'reject'])->name('absences.reject');

    // Employees directory (all can view)
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    // Admin only routes
    Route::middleware('admin')->group(function () {
        // Employee management (CRUD)
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
        Route::post('/employees/{id}/toggle-role', [EmployeeController::class, 'toggleRole'])->name('employees.toggleRole');

        // Admin panel
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

        // Config: rooms and cars
        Route::get('/admin/rooms-config', [AdminController::class, 'roomsConfig'])->name('admin.rooms-config');
        Route::post('/admin/rooms-config', [AdminController::class, 'storeRoom'])->name('admin.rooms-config.store');
        Route::delete('/admin/rooms-config/{id}', [AdminController::class, 'destroyRoom'])->name('admin.rooms-config.destroy');

        Route::get('/admin/cars-config', [AdminController::class, 'carsConfig'])->name('admin.cars-config');
        Route::post('/admin/cars-config', [AdminController::class, 'storeCar'])->name('admin.cars-config.store');
        Route::delete('/admin/cars-config/{id}', [AdminController::class, 'destroyCar'])->name('admin.cars-config.destroy');
    });
});
