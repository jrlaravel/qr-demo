<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContentController;

Route::get('/', function () {
    return view('welcome');
});

// Route to show the form
Route::get('/content/create', [ContentController::class, 'create'])->name('admin.create');

// Route to handle the form submission
Route::post('/content', [ContentController::class, 'store'])->name('admin.store');

// Existing dynamic content route
Route::get('/dynamic-content/{website}/{slug}', [ContentController::class, 'show']);
