<?php

use Illuminate\Support\Facades\Route;
use Modules\Members\App\Http\Controllers\MembersController;

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
    Route::get('/get-taluka-town/{pincode}', [MembersController::class, 'getStateCity']);
});

