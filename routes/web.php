<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function() {
    Route::get('websites', [App\Http\Controllers\Admin\WebsiteController::class, 'index'])->name('admin.websites.index');
    Route::get('websites/create', [App\Http\Controllers\Admin\WebsiteController::class, 'create'])->name('admin.websites.create');
    Route::post('websites', [App\Http\Controllers\Admin\WebsiteController::class, 'store'])->name('admin.websites.store');
    Route::get('websites/{id}/edit', [App\Http\Controllers\Admin\WebsiteController::class, 'edit'])->name('admin.websites.edit');
    Route::put('websites/{id}', [App\Http\Controllers\Admin\WebsiteController::class, 'update'])->name('admin.websites.update');
    Route::delete('websites/{id}', [App\Http\Controllers\Admin\WebsiteController::class, 'destroy'])->name('admin.websites.destroy');

});

