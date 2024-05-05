<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\UserController;


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


    Route::get('/dynamic-form', [DynamicController::class, 'index'])->name('dynamic-form.create');
    Route::post('/dynamic-form-save', [DynamicController::class, 'store'])->name('dynamic-form.store');
    Route::get('/dynamic-form-edit/{Id}', [DynamicController::class, 'edit'])->name('dynamic-form.edit');
    Route::put('/dynamic-form-update/{Id}', [DynamicController::class, 'update'])->name('dynamic-form.update');
    Route::delete('/dynamic-form-destroy/{Id}', [DynamicController::class, 'destroy'])->name('dynamic-form.destroy');

    Route::get('/admin/forms', [DynamicController::class, 'show'])->name('dynamic-form.show');


});


Route::get('/forms', [UserController::class, 'index'])->name('forms.index');
Route::get('/forms/{id}', [UserController::class, 'show'])->name('forms.show');
Route::post('/forms/store', [UserController::class, 'store'])->name('forms.store');



require __DIR__.'/auth.php';
