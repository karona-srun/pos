<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PaymentTypesController;
use App\Http\Controllers\ProductInventoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductTypesController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('customer', CustomerController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('product-types', ProductTypesController::class);
    Route::get('/search-products', [ProductTypesController::class, 'search'])->name('product-types.search');
    Route::resource('discount', DiscountController::class);
    Route::get('/search-discount', [DiscountController::class, 'search'])->name('discount.search');
    Route::resource('products', ProductsController::class);
    Route::resource('inventory', ProductInventoryController::class);
    Route::resource('suppliers', SupplierController::class);

    // Settings
    Route::resource('company', CompanyProfileController::class);
    Route::resource('site', SiteSettingsController::class);
    Route::resource('tax', TaxController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('payment-type', PaymentTypesController::class);
    Route::resource('currency', CurrencyController::class);
});
