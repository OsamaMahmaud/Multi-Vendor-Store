<?php
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\Category\CategoryArchiveController;


// routes/dashboard

   Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth.type:super-admin,admin']], function () {

     Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

     Route::middleware('auth')->prefix('dashdoard')->name('dashboard.')->group(function () {

            //categories routes
            Route::resource('categories',CategoryController::class);

            Route::resource('Archive',CategoryArchiveController::class);

            Route::delete('/category/{id}/force-delete', [CategoryArchiveController::class, 'forceDelete'])->name('category.force-delete');

            //products routes
            Route::resource('products',ProductController::class);

            //user profile route
            Route::get('user/profile',[ ProfileController::class ,'edit' ])->name('user.profile');

            Route::patch('user/profile',[ ProfileController::class ,'update' ])->name('user.profile.update');

        });
});












