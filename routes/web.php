<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleManagement\RoleController;
use App\Http\Controllers\Admin\RoleManagement\PermissionController;
use App\Http\Controllers\Admin\RoleManagement\UserRoleController;
use App\Http\Controllers\Admin\FarmerRegistration\FarmerRegistrationController;
use App\Http\Controllers\Admin\QuantityMass\QuantityMassController;
use App\Http\Controllers\Admin\FAQ\FAQController;
use App\Http\Controllers\Admin\FAQ\FaqCategoryController;

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserRegistrationController;
use App\Http\Controllers\Frontend\CropController;



// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('language/{lang}', [LanguageController::class, 'switchLanguage']);
////Home Controller
Route::get('/', [HomeController::class,'mainIndex'])->name('home.index');
Route::get('about', [HomeController::class,'mainAbout'])->name('home.about');
Route::get('services', [HomeController::class,'mainServices'])->name('home.services');
Route::get('gallery', [HomeController::class,'mainGallery'])->name('home.gallery');
Route::get('blog', [HomeController::class,'mainBlog'])->name('home.blog');
Route::get('contact', [HomeController::class,'mainContact'])->name('home.contact');
Route::get('/live-search', [HomeController::class, 'liveSearch'])->name('live.search'); 
Route::get('/faqs', [HomeController::class, 'mainFaq'])->name('home.faq');




/////Crop Controller
Route::get('crops', [CropController::class,'mainCrops'])->name('home.crops');
Route::get('crops-management/{categoryId}', [CropController::class, 'showCropManagementList'])->name('crop.management.list');
Route::post('crops-inquiry', [CropController::class,'cropInquiry'])->name('home.cropsInquiry');
Route::post('/favorites/add', [CropController::class, 'add'])->name('favorite.add')->middleware('auth');
Route::post('/favorites/remove', [CropController::class, 'remove'])->name('favorite.remove')->middleware('auth');



Route::post('api/fetch-states', [HomeController::class, 'fetchState']);
Route::post('api/fetch-cities', [HomeController::class, 'fetchCity']);

////User Registration Controller
Route::get('registration', [UserRegistrationController::class,'mainRegister'])->name('home.register');
Route::post('registration', [UserRegistrationController::class,'mainStore'])->name('home.register.store');



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


    /////FarmerRegistrationController
    Route::get('farmer',[FarmerRegistrationController::class,'farmerIndex'])->name('admin.farmer.index');
    Route::get('farmer/create',[FarmerRegistrationController::class,'farmerCreate'])->name('admin.farmer.create');
    Route::get('entrepreneur',[FarmerRegistrationController::class,'entrepreneurIndex'])->name('admin.entrepreneur.index');

});

/////Location Controller
Route::post('/store-location', [LocationController::class, 'store'])->name('location.store');
Route::post('/update-location/{id}', [LocationController::class, 'update'])->name('location.update');
Route::delete('/delete-location/{id}', [LocationController::class, 'destroy'])->name('location.delete');
Route::get('location',[LocationController::class,'create'])->name('create.location');


////FarmerRegistrationController


//  QunantityMass
// Admin route group

    Route::get('/unitmass', [QuantityMassController::class, 'index'])->name('admin.quantityMass.index');
    Route::get('/unitmass/create', [QuantityMassController::class, 'create'])->name('admin.quantityMass.create');
    Route::post('/unitmass/store', [QuantityMassController::class, 'store'])->name('admin.quantityMass.store');
    Route::get('/unitmass/edit/{id}', [QuantityMassController::class, 'edit'])->name('admin.quantityMass.edit');
    Route::put('/unitmass/update/{id}', [QuantityMassController::class, 'update'])->name('admin.quantityMass.update');
    Route::delete('/quantityMass/{id}', [QuantityMassController::class, 'destroy'])->name('admin.quantityMass.delete');

//FAQ 
//admin route group
    Route::get('faq', [FAQController::class, 'index'])->name('admin.faq.index');
    Route::get('faq/create', [FAQController::class, 'create'])->name('admin.faq.create');
    Route::post('faq/store', [FAQController::class, 'store'])->name('admin.faq.store');
    Route::get('faq/{id}/edit', [FAQController::class, 'edit'])->name('admin.faq.edit');
    Route::put('faq/{id}', [FAQController::class, 'update'])->name('admin.faq.update');
    Route::delete('faq/{id}', [FAQController::class, 'destroy'])->name('admin.faq.delete');

    //FAQCategory 
    // Route::get('faqcat', [FAQController::class, 'index'])->name('admin.faq.faq_cat.index');
// FAQ Category Routes

    Route::get('/faqCategory', [FaqCategoryController::class, 'index'])->name('admin.faqCategory'); 
     Route::get('faqCategory/create', [FaqCategoryController::class, 'create'])->name('admin.faqCategory.create'); 
   Route::post('faqCategory/store', [FaqCategoryController::class, 'store'])->name('admin.faq.faqCategory.store'); 
    Route::get('faqCategory/{id}/edit', [FaqCategoryController::class, 'edit'])->name('admin.faq.faqCategory.edit'); 
    Route::put('faqCategory/{id}', [FaqCategoryController::class, 'update'])->name('admin.faq.faqCategory.update');
    Route::delete('faqCategory/{id}', [FaqCategoryController::class, 'destroy'])->name('admin.faq.faqCategory.delete'); 



require __DIR__.'/auth.php';
