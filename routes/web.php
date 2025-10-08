<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FroalaController;
use Illuminate\Support\Facades\Route;


// Shared routes
    $sharedRoutes = function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Events (read-only)
            Route::controller(EventController::class)->prefix('events')->name('events.')->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('{event}/show', 'show')->name('show');
            });
        // Events (read-only)
    };
// Shared routes


// Admin only routes
    $adminOnlyRoutes = function () {
        // Froala upload route
            Route::controller(FroalaController::class)->prefix('froala')->name('froala.')->group(function() {
                Route::post('upload', 'upload')->name('upload');
                Route::post('delete', 'delete')->name('delete');
            });
        // Froala upload route

        // Events routes
            Route::controller(EventController::class)->prefix('events')->name('events.')->group(function() {
                Route::post('/', 'store')->name('store');
                Route::get('{event}/edit', 'edit')->name('edit');
                Route::post('{event}', 'update')->name('update');
                Route::delete('{event}', 'destroy')->name('destroy');
            });
        // Events routes

        // Users routes
            // Route::controller(UserController::class)->prefix('users')->name('users.')->group(function() {
            //     Route::get('/', 'index')->name('index');
            //     Route::get('create', 'create')->name('create');
            //     Route::post('/', 'store')->name('store');
            //     Route::get('{user}/edit', 'edit')->name('edit');
            //     Route::post('{user}', 'update')->name('update');
            //     Route::delete('{user}', 'destroy')->name('destroy');
            // });
        // Users routes

        // Settings routes
            // Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function() {
            //     Route::get('/', 'index')->name('index');
            //     Route::post('/', 'update')->name('update');
            // });
        // Settings routes
    };
// Admin only routes



// Member routes → only shared
    Route::middleware(['auth', 'role:member'])
    ->prefix('member')
    ->name('member.')
    ->group($sharedRoutes);
// Member routes → only shared


// Admin routes → shared + admin-only
    Route::middleware(['auth', 'role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () use ($sharedRoutes, $adminOnlyRoutes) {
            $sharedRoutes();
            $adminOnlyRoutes();
        });
// Admin routes → shared + admin-only