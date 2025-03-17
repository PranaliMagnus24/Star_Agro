<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

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
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit',[CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/{id}/update',[CategoryController::class,'update'])->name('category.update');
    Route::get('category/{id}/delete',[CategoryController::class,'destroy'])->name('category.delete');
    Route::get('/get-subcategories/{id}', [CategoryController::class, 'getSubcategories']);
    Route::get('/get-subsubcategories/{id}', [CategoryController::class, 'getSubSubcategories']);
});
