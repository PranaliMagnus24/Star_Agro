<?php

use Illuminate\Support\Facades\Route;
use Modules\Members\App\Http\Controllers\MembersController;
use Modules\Members\App\Http\Controllers\CropManagementController;

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

// Route::group([], function () {
//     Route::resource('members', MembersController::class)->names('members');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/member', [MembersController::class, 'index'])->name('member');
    Route::get('/profile', [MembersController::class, 'profile'])->name('member.profile');
    Route::post('/profile/update', [MembersController::class, 'updateProfile'])->name('member.profile.update');
    Route::post('/profile/store', [MembersController::class, 'store'])->name('member.store');

    Route::post('api/fetch-states', [MembersController::class, 'fetchState']);
    Route::post('api/fetch-cities', [MembersController::class, 'fetchCity']);
    Route::get('api/get-zipcodes', [MembersController::class, 'getZipCodes']);
    Route::post('api/fetch-zipcode-details', [MembersController::class, 'fetchZipCodeDetails']);
    Route::get('/get-taluka-town/{pincode}', [MembersController::class, 'getTalukaTown']);
    Route::post('/update-password', [MembersController::class, 'updatePassword'])->name('updatePassword');


    Route::get('/crops/list', [CropManagementController::class, 'indexCrop'])->name('crop.index');
    Route::get('/crop', [CropManagementController::class, 'createCrop'])->name('crop.create');
    Route::get('/get-subcategories/{categoryId}', [CropManagementController::class, 'getSubcategories']);
    Route::get('/get-crops/{subcategoryId}', [CropManagementController::class, 'getCrops']);
    Route::post('/store-crop-management', [CropManagementController::class, 'store'])->name('crop.management.store');
    Route::get('/crop{id}', [CropManagementController::class, 'editCrops'])->name('crop.edit');
    Route::post('/crop{id}/update', [CropManagementController::class, 'updateCrops'])->name('crop.management.update');
    Route::delete('/crop{id}/delete', [CropManagementController::class, 'destroyCrop'])->name('crop.delete');
    Route::get('/crop-inquiries/{id}', [CropManagementController::class, 'showInquiries'])->name('crop.inquiries');





});

