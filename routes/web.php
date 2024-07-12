<?php

use App\Http\Controllers\Front\Orders\CheckoutControllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Front\Product\ProductController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

// Route::get('/', function () {
//     return view('welcome');
// });




Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    //front routes
    Route::get('/', [HomeController::class, 'index'])->name('home');

    //products routes
    Route::get('products', [ProductController::class, 'index'])->name('product.all');

    Route::get('product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

    //profileRoutes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    });

    //cart routes
    Route::resource('cart', CartController::class);
    //  Route::put('/cart/{id}', [CartController::class, 'update']);


    //checkoutRoutes
    Route::get('checkout', [CheckoutControllers::class, 'create'])->name('checkout');
    Route::post('checkout', [CheckoutControllers::class, 'store']);


});




// require __DIR__.'/auth.php'; //to move from breeze to Fortify 
