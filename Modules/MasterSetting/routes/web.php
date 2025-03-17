<?php

use Illuminate\Support\Facades\Route;
use Modules\MasterSetting\App\Http\Controllers\MasterSettingController;

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
//////Payment Gateway
    Route::get('payments', [MasterSettingController::class, 'paymentGatewaylist'])->name('paymentGateway.list');
    Route::get('payment/gateway/create', [MasterSettingController::class, 'paymentGateway'])->name('paymentGateway.create');
    Route::post('payment/gateway', [MasterSettingController::class, 'storePaymentGateway'])->name('paymentGateway.store');
    Route::get('payment/gateway/edit/{id}', [MasterSettingController::class, 'paymentGateway'])->name('paymentGateway.edit');
    Route::put('payment/gateway/update/{id}', [MasterSettingController::class, 'updatePaymentGateway'])->name('paymentGateway.update');
    Route::delete('payment/gateway/delete/{id}', [MasterSettingController::class, 'destroyPaymentGateway'])->name('paymentGateway.delete');


//////Whatsapp
    Route::get('whatsapp',[MasterSettingController::class,'index'])->name('whatsapp.index');
    Route::get('whatsapp/create',[MasterSettingController::class,'create'])->name('whatsapp.create');
    Route::post('whatsapp/create',[MasterSettingController::class,'store'])->name('whatsapp.store');
    Route::get('whatsapp/{id}/edit',[MasterSettingController::class,'edit'])->name('whatsapp.edit');
    Route::put('whatsapp/{id}/update',[MasterSettingController::class,'update'])->name('whatsapp.update');
    Route::delete('whatsapp/{id}/delete',[MasterSettingController::class,'destroy'])->name('whatsapp.delete');

});
