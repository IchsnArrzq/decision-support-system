<?php

use App\Http\Controllers\SimpleAdditiveWeightingController;
use App\Http\Controllers\TechniqueforOrderPreferencebySimilaritytoIdealSolutionController;
use App\Http\Controllers\WeightedProductController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('saw', SimpleAdditiveWeightingController::class);
Route::get('wp', WeightedProductController::class);
Route::get('topsis', TechniqueforOrderPreferencebySimilaritytoIdealSolutionController::class);

require __DIR__.'/auth.php';
