<?php

use App\Http\Controllers\ClosedNotificationController;
use App\Http\Controllers\DisplayedNotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('notifications/{notification}/displayed', DisplayedNotificationController::class)
        ->name('notifications.displayed');

    Route::post('notifications/{notification}/closed', ClosedNotificationController::class)
        ->name('notifications.closed');
});

require __DIR__.'/auth.php';
