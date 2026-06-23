<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/group');
});


Route::prefix('group')->name('group.')->group(function () {
    Route::get('/', [GroupController::class, 'index'])->name('index');
    Route::get('/create', [GroupController::class, 'create'])->name('create');
    Route::post('/store', [GroupController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [GroupController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [GroupController::class, 'destroy'])->name('destroy');
    Route::get('/trash', [GroupController::class, 'trash'])->name('trash');
    Route::get('/restore/{id}', [GroupController::class, 'restore'])->name('restore');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    Route::get('/trash', [UserController::class, 'trash'])->name('trash');
    Route::get('/restore/{id}', [UserController::class, 'restore'])->name('restore');
});
