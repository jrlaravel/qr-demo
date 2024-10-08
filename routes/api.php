<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebsiteHitController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/script/{id}', [WebsiteHitController::class, 'generateScript'])->name('api/script');
Route::post('/api/hit-url', [WebsiteHitController::class, 'hitUrl'])->name('api/hit-url');
