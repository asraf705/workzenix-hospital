<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;

// User routes
Route::prefix('user')->name('user.')->group(function () {
    // Protected routes (only accessible by users)
    Route::middleware('isUser')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});