<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleManagement\RoleController;
use App\Http\Controllers\Admin\RoleManagement\PermissionController;
use App\Http\Controllers\Admin\RoleManagement\UserRoleController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



Route::group(['middleware' => ['isAdmin']], function() {

    Route::get('dashboard',[AdminController::class,'adminIndex'])->middleware(['auth', 'verified'])->name('dashboard');

    // Permissions Routes
    Route::prefix('permissions')->group(function() {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.list')->middleware('permission:view permission');
        Route::get('/create', [PermissionController::class, 'create'])->name('permission.create')->middleware('permission:create permission');
        Route::post('/', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit')->middleware('permission:edit permission');
        Route::patch('/{id}', [PermissionController::class, 'update'])->name('permission.update')->middleware('permission:update permission');
        Route::get('/{id}/delete', [PermissionController::class, 'delete'])->name('permission.delete')->middleware('permission:delete permission');
    });

    // Roles Routes
    Route::prefix('roles')->group(function() {
        Route::get('/', [RoleController::class, 'index'])->name('role.list')->middleware('permission:view role');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:create role');
        Route::post('/', [RoleController::class, 'store'])->name('role.store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:edit role');
        Route::patch('/{id}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:update role');
        Route::get('/{id}/delete', [RoleController::class, 'delete'])->name('role.delete')->middleware('permission:delete role');
        Route::get('/{id}/permissions', [RoleController::class, 'permissionToRole'])->name('role.permissions');
        Route::patch('/{id}/permissions', [RoleController::class, 'updatePermissionToRole'])->name('role.updatePermissions');
    });

    // Users Routes
    Route::prefix('users')->group(function() {
        Route::get('/', [UserRoleController::class, 'index'])->name('users.list')->middleware('permission:view user');
        Route::get('/create', [UserRoleController::class, 'create'])->name('user.create')->middleware('permission:create user');
        Route::post('/', [UserRoleController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserRoleController::class, 'edit'])->name('user.edit')->middleware('permission:edit user');
        Route::patch('/{id}', [UserRoleController::class, 'update'])->name('user.update')->middleware('permission:update user');
        Route::get('/{id}/delete', [UserRoleController::class, 'delete'])->name('user.delete')->middleware('permission:delete user');
    });
    Route::get('language/{lang}', [LanguageController::class, 'switchLanguage']);
});

Route::post('/store-location', [LocationController::class, 'store'])->name('location.store');
Route::post('/update-location/{id}', [LocationController::class, 'update'])->name('location.update');
Route::delete('/delete-location/{id}', [LocationController::class, 'destroy'])->name('location.delete');
Route::get('location',[LocationController::class,'create'])->name('create.location');



require __DIR__.'/auth.php';
