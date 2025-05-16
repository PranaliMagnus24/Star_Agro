<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\App\Http\Controllers\LocationController;
use Modules\Location\App\Http\Controllers\DistrictController;
use Modules\Location\App\Http\Controllers\TalukaController;
use Modules\Location\App\Http\Controllers\VillageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {


});

//districts Routes
Route::get('districts', [DistrictController::class, 'index'])->name('districts.index');
Route::get('districts/create', [DistrictController::class, 'create'])->name('districts.create');
Route::post('districts', [DistrictController::class, 'store'])->name('districts.store');
Route::get('districts/{id}/edit', [DistrictController::class, 'edit'])->name('districts.edit');
Route::put('districts/{id}/update', [DistrictController::class, 'update'])->name('districts.update');
Route::get('districts/{id}/delete', [DistrictController::class, 'delete'])->name('districts.delete');

// Taluka Routes
Route::get('talukas', [TalukaController::class, 'index'])->name('talukas.index');
Route::get('talukas/create', [TalukaController::class, 'create'])->name('talukas.create');
Route::post('talukas', [TalukaController::class, 'store'])->name('talukas.store');
Route::get('talukas/{id}/edit', [TalukaController::class, 'edit'])->name('talukas.edit');
Route::put('talukas/{id}/update', [TalukaController::class, 'update'])->name('talukas.update');
Route::get('talukas/{id}/delete', [TalukaController::class, 'destroy'])->name('talukas.delete');

// Village Routes
Route::get('villages', [VillageController::class, 'index'])->name('villages.index');
Route::get('villages/create', [VillageController::class, 'create'])->name('villages.create');
Route::post('villages', [VillageController::class, 'store'])->name('villages.store');
Route::get('villages/{id}/edit', [VillageController::class, 'edit'])->name('villages.edit');
Route::put('villages/{id}/update', [VillageController::class, 'update'])->name('villages.update');
Route::get('villages/{id}/delete', [VillageController::class, 'destroy'])->name('villages.delete');
