<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\dashController;
use App\Http\Controllers\landingController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\AdministrativeNotificationRecipientController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use App\Models\Orden;

use Inertia\Inertia;

Route::prefix('admin')->middleware(['auth', 'role:admin,employee'])->group(function () {

    Route::get('/landing', [landingController::class, 'editSections'])->name('admin.lander');
    Route::put('/landing', [landingController::class, 'updateSections'])->name('sections.update');
    Route::get('/partners', [landingController::class, 'editPartners'])->name('admin.partners');
    Route::post('/partners', [landingController::class, 'storePartner'])->name('partners.store');
    Route::delete('/partners/{filename}', [landingController::class, 'destroyPartner'])->name('partners.destroy');


    
    Route::get('/ordenes', [OrdenController::class, 'loadOrdersAdmin'])->name('admin.orders');
    Route::get('/ordenes/{orden}/details', [OrdenController::class, 'show'])->name('admin.orders.details');
    Route::delete('/ordenes/{orden}/delete', [OrdenController::class, 'destroy'])->name('admin.orders.destroy');
    Route::patch('/ordenes/{orden}/status', [OrdenController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::post('/ordenes/{orden}/complete', [OrdenController::class, 'completeOrder'])->name('admin.orders.complete');
    Route::post('/ordenes/{ordenProducto}/update-details', [OrdenController::class, 'updateDetails'])->name('admin.orders.updateDetails');
    Route::delete('/orders/product/{ordenProducto}', [OrdenController::class, 'destroyProduct'])->name('admin.orders.destroyProduct');
    

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/usuarios', [UserController::class, 'loadUsers'])->name('admin.users');
    Route::put('/usuarios/{user}/update-role', [UserController::class, 'updateUserRole'])->name('admin.users.updateRole');
    Route::get('/usuarios/{user}/details', [UserController::class, 'getUserDetails'])->name('admin.users.details');
    Route::put('/usuarios/{user}/update-admin', [UserController::class, 'updateFromModal'])->name('admin.users.updateAdmin');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware('role:admin');

    Route::get('/categorias', [CategoriesController::class, 'index'])->name('admin.categories');
    Route::get('/categorias-editing', [CategoriesController::class, 'indexEditMode'])->name('admin.categories.editMode');
    Route::get('/categorias/{id}', [CategoriesController::class, 'indexProducts'])->name('admin.categories.showProducts');
    Route::get('/categoria-add', [CategoriesController::class, 'indexAdder'])->name('admin.categories.showAdder');
    Route::post('/categorias/add', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::delete('/categories/bye/{category}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');
    Route::put('/categories/edit/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');


    Route::get('/services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');


    Route::get('/productos', [ProductController::class, 'loadAddProducts'])->name('admin.products');
    Route::post('/productos/add', [ProductController::class, 'store'])->name('products.store');
    Route::put('/productos/edit/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/productos/edit/{id}', [ProductController::class, 'loadEditProducts'])->name('products.startupdate');
    Route::delete('/productos/destroy/{id}', [ProductController::class, 'destroy'])->name('products.delete');

    Route::get('/options', [OptionController::class, 'index'])->name('admin.options');
    Route::post('/options', [OptionController::class, 'store'])->name('admin.options.store');
    Route::get('/options/edit', [OptionController::class, 'indexEditMode'])->name('admin.options.editMode');
    Route::put('/options/{option}', [OptionController::class, 'update'])->name('admin.options.update');
    Route::delete('/options/{option}', [OptionController::class, 'destroy'])->name('admin.options.destroy');

    Route::get('notification-recipients', [AdministrativeNotificationRecipientController::class, 'index'])->name('admin.notification_recipients.index');
    Route::post('notification-recipients', [AdministrativeNotificationRecipientController::class, 'store'])->name('admin.notification_recipients.store');
    Route::delete('notification-recipients/{recipient}', [AdministrativeNotificationRecipientController::class, 'destroy'])->name('admin.notification_recipients.destroy');
    // Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users');
    // Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
    // Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/', [dashController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [OptionController::class, 'index'])->name('admin.dash');
    Route::get('/orders-chart-data', [dashController::class, 'ordersChartData'])->name('admin.orders.chart.data');
});


Route::post('/solicitud/crear', [OrdenController::class, 'crearDesdeCarrito'])->name('solicitud.crear')->middleware('auth');

Route::get('/store', [ProductController::class,'loadStore'])->name('store.main');

Route::get('/products/filter/{categoryId}', [ProductController::class, 'filterByCategory'])->name('products.filter');

Route::get('/store/{categoryId}', [ProductController::class, 'loadStoreFiltered'])->name('store.filtered');

Route::prefix('carrito')->middleware(['auth'])->group(function (){

    Route::get('/', [OrdenController::class, 'loadCart'])->name('cart.load');
    Route::delete('/items/{cartProduct}', [OrdenController::class, 'destroyCartProduct'])->name('cart.item.destroy');
    Route::patch('/items/{cartProduct}', [OrdenController::class, 'update'])->name('cart.item.update');
});


Route::prefix('user')->middleware(['auth'])->middleware('verified')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'loadDashboard'])->name('dash');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update.profile');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('/orders/{order}', [UserController::class, 'showOrder'])->name('order.show');

});


//activar middleware en éste
Route::post('/ordenes/crear', [OrdenController::class, 'store'])->name('orders.store')->middleware('auth')->middleware('verified');
Route::post('/ordenes/guardar', [OrdenController::class, 'storeCart'])->name('orders.storeCart')->middleware('auth')->middleware('verified');
Route::post('/solicitud/{servicio}/crear',[OrdenController::class, 'storeServiceSolicitation'])->name('service.request.submit')->middleware('auth')->middleware('verified');

Route::get('mail1',function(){
    $order = Orden::where('user_id', auth()->id())->latest()->first()->load(['product', 'user']);
    return view('mail.formato-orden',compact('order'));
});
Route::get('mail3',function(){

$order = Orden::with(['product.producto', 'user']) // Precargamos toda la cadena de relaciones
    ->where('user_id', auth()->id())
    ->whereHas('product', function ($pivotQuery) {
        $pivotQuery->whereHas('producto', function ($productQuery) {
            $productQuery->where('type', 'service');
        });
    }, '=', 1)
    ->latest()
    ->first();
    return view('mail.formato-solicitud-servicio',compact('order'));
});
Route::get('mail2',function(){
    $order = Orden::where('user_id', auth()->id())->latest()->first()->load(['product', 'user']);
    $user = $order->user;
    return view('mail.admin_order_notification',compact('order', 'user'));
});

Route::get('/', [landingController::class,'index'])->name('main');

Route::get('/welcomeBack', function(){
     return Inertia::location('/');
})->name('home');

Route::get('/productos/{product:slug}', [ProductController::class, 'show'])->name('products.show');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/Inicio', function () {
        return redirect()->route('home');
    })->name('dashboard');
});
Route::get('/mass-message', [landingController::class, 'massMessageForm'])->name('mass-message.send');
Route::post('/whatsapp/incoming', [WhatsAppController::class, 'handleIncomingMessage']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
