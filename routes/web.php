<?php

use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProductsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/', [ProductsController::class, 'list'])->name('products.list');
    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductsController::class, 'list'])->name('products.list');
        Route::post('/', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/add', [ProductsController::class, 'add'])->name('products.add');
        Route::get('/{id}', [ProductsController::class, 'view'])->name('products.view');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
        Route::post('/{id}/update', [ProductsController::class, 'update'])->name('products.update');
        Route::post('/{id}/movement', [MovementController::class, 'addMovement'])->name('products.addMovement');
        Route::post('/{id}/delete', [ProductsController::class, 'delete'])->name('products.delete');
    });
});
