<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralSetting\App\Http\Controllers\GeneralSettingController;

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
    Route::get('general/settings',[GeneralSettingController::class,'index'])->name('create.generalSetting');
    Route::post('general/settings',[GeneralSettingController::class,'store'])->name('store.generalSetting');
});
