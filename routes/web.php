<?php

use Illuminate\Support\Facades\Route;


// Shared routes
    $sharedRoutes = function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Events (read-only)
            Route::controller(EventController::class)->prefix('events')->name('events.')->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('show/{event}', 'show')->name('show');
            });
        // Events (read-only)
    };
// Shared routes


// Admin only routes
    $adminOnlyRoutes = function () {
        // Events routes
            Route::controller(EventController::class)->prefix('events')->name('events.')->group(function() {
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{article}/edit', 'edit')->name('edit');
                Route::post('{article}', 'update')->name('update');
                Route::delete('{article}', 'destroy')->name('destroy');
            });
        // Events routes
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