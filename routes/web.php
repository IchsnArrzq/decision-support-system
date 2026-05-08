<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SimpleAdditiveWeightingController;
use App\Http\Controllers\TechniqueforOrderPreferencebySimilaritytoIdealSolutionController;
use App\Http\Controllers\ValueController;
use App\Http\Controllers\WeightedProductController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('alternatives', AlternativeController::class)->only(['index', 'create', 'edit', 'show']);
Route::resource('criteria', CriteriaController::class)
    ->parameters(['criteria' => 'criteria'])
    ->only(['index', 'create', 'edit', 'show']);
Route::resource('values', ValueController::class)->only(['index', 'create', 'edit', 'show']);
Route::get('saw', SimpleAdditiveWeightingController::class)->name('saw.index');
Route::get('wp', WeightedProductController::class)->name('wp.index');
Route::get('topsis', TechniqueforOrderPreferencebySimilaritytoIdealSolutionController::class)->name('topsis.index');

require __DIR__.'/auth.php';
