<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Inertia\Inertia;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'products' => \App\Models\Product::all(),
            'tenantName' => ucfirst(tenant('id')), 
        ]);
    });    
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    require __DIR__.'/auth.php';

});
