<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdenController;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/ordenes', [OrdenController::class, 'loadOrdersAdmin'])->name('admin.orders');
    Route::get('/ordenes/{id}/details', [OrdenController::class, 'show']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/usuarios', [UserController::class, 'loadUsers'])->name('admin.users');
    Route::get('/productos', [ProductController::class, 'loadAddProducts'])->name('admin.products');
    Route::post('/productos/add', [ProductController::class, 'store'])->name('products.store');
    Route::put('/productos/edit/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/productos/edit/{id}', [ProductController::class, 'loadEditProducts'])->name('products.startupdate');
    Route::delete('/productos/destroy/{id}', [ProductController::class, 'destroy'])->name('products.delete');
    Route::get('/', function () {
    return view('blank');
    });
});
Route::get('/products/filter/{categoryId}', [ProductController::class, 'filterByCategory']);

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'loadDashboard'])->name('user.dash');
});

Route::post('/ordenes/crear', [OrdenController::class, 'store'])->middleware('auth')->name('orders.store');

Route::get('/store', [ProductController::class,'loadStore'])->middleware('auth')->name('store.main');

Route::get('/', function(){
     return view('testLanding');
})->name('main');

Route::get('/welcomeBack', function(){
     return Inertia::location('/');
})->name('home');

Route::get('/productos/{product:slug}', [ProductController::class, 'show'])->name('products.show');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/Inicio', function () {
        return redirect()->route('home');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
