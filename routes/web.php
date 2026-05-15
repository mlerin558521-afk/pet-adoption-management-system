<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetBrowseController;  
use App\Http\Controllers\UserController; 
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/browse', [PetBrowseController::class, 'index'])->name('pets.browse');
    Route::post('/adoptions', [AdoptionController::class, 'store'])->name('adoptions.store');
    Route::get('/my-requests', [AdoptionController::class, 'userIndex'])->name('adoptions.userIndex');

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('admin/pets', PetController::class);
        Route::resource('users', UserController::class);
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::patch('/pets/{pet}/archive', [PetController::class, 'archive'])->name('admin.pets-archive');
        Route::get('/pets-archived', [PetController::class, 'archived'])->name('admin.pets-archived');
        Route::patch('/pets/{pet}/restore', [PetController::class, 'restore'])->name('admin.pets-restore');
        Route::get('/adoptions', [AdoptionController::class, 'index'])->name('adoptions.index');
        Route::patch('/adoptions/{id}/approve', [AdoptionController::class, 'approve'])->name('adoptions.approve');
        Route::patch('/adoptions/{id}/disapprove', [AdoptionController::class, 'disapprove'])->name('adoptions.disapprove');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });
});

require __DIR__.'/auth.php';
