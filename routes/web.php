<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\KardexController;

Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('movements', MovementController::class);
    Route::get('/kardex', [KardexController::class, 'index'])->name('kardex.index'); // Vista inicial
    Route::get('/kardex/{productId}', [KardexController::class, 'kardex'])->name('kardex.show'); // Ver Kardex de un producto
    Route::get('/kardex/{productId}/export-csv', [KardexController::class, 'exportKardexCsv'])->name('kardex.export-csv'); // Exportar CSV
    Route::get('/warehouses/{id}/export', [WarehouseController::class, 'exportCsv'])->name('warehouses.export');    
    Route::get('/documentation', function () {
        return view('documentation');
    })->name('api.documentation');
});




Route::get('/', function () {
    return view('auth.login');
});

// Rutas de autenticación (Login/Registro)
Auth::routes();