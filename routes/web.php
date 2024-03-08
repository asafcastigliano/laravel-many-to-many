<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;

Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::resource('projects', ProjectController::class);
    Route::resource('types', ProjectController::class);
    Route::resource('technologies', ProjectController::class);
});