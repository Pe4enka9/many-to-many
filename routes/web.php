<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');

    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::patch('/{id}/edit', 'update')->name('update');

    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');

    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::patch('/{id}/edit', 'update')->name('update');

    Route::delete('/{id}', 'destroy')->name('destroy');
});
