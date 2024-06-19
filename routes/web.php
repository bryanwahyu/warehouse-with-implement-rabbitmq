<?php

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\AuthFrontEndController as AuthFrontEnd;
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

Route::get(uri: '', action: [AuthFrontEnd::class, 'login']);
Route::prefix('admin')->group(function () {
    Route::get(uri: 'index', action: [AdminController::class, 'index']);
    Route::get(uri: 'user', action: [AdminController::class, 'user']);
    Route::get(uri: 'bahan', action: [AdminController::class, 'index_bahan']);
    Route::get(uri: 'bahan/{id}', action: [AdminController::class, 'detail_bahan']);
    Route::get(uri: 'category', action: [AdminController::class, 'category_bahan']);
    Route::get(uri: 'satuan', action: [AdminController::class, 'satuan_bahan']);
    Route::get(uri: 'supplier', action: [AdminController::class, 'supplier']);
    Route::get(uri: 'po', action: [AdminController::class, 'index_po']);
    Route::get(uri: 'po/create', action: [AdminController::class, 'create_po']);
    Route::get(uri: 'po/{id}', action: [AdminController::class, 'detail_po']);
    Route::get(uri: 'laporan/stok', action: [AdminController::class, 'stok']);
    Route::get(uri: 'laporan/stok-opname', action: [AdminController::class, 'stok_opname']);
    Route::get(uri: 'customer', action: [AdminController::class, 'customer']);
    Route::get(uri: 'sales-order', action: [AdminController::class, 'sales_order']);
    Route::get(uri: 'sales-order/create', action: [AdminController::class, 'create_sales_order']);
    Route::get(uri: 'sales-order/{id}', action: [AdminController::class, 'detail_sales_order']);
    Route::get(uri: 'product', action: [AdminController::class, 'index_product']);
    Route::get(uri: 'production', action: [AdminController::class, 'production']);

    Route::get(uri: 'product/{id}', action: [AdminController::class, 'detail_product']);
    Route::get(uri: 'category-product', action: [AdminController::class, 'category_product']);
    Route::get(uri: 'laporan/stok-product', action: [AdminController::class, 'stok_product']);
    Route::get(uri: 'laporan/stok-opname-product', action: [AdminController::class, 'stok_opname_product']);
    Route::get(uri: 'satuan-product', action: [AdminController::class, 'satuan_product']);
});
