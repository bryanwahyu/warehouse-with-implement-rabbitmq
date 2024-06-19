<?php

use App\Http\Controllers\API\V1\Bahan\Category\CreateCategoryController;
use App\Http\Controllers\API\V1\Bahan\Category\DeleteCategoryController;
use App\Http\Controllers\API\V1\Bahan\Category\DetailCategoryController;
use App\Http\Controllers\API\V1\Bahan\Category\IndexCategoryController;
use App\Http\Controllers\API\V1\Bahan\Category\UpdateCategoryController;
use App\Http\Controllers\API\V1\Bahan\CRUD\CreateBahanController;
use App\Http\Controllers\API\V1\Bahan\CRUD\DeleteBahanController;
use App\Http\Controllers\API\V1\Bahan\CRUD\DetailBahanController;
use App\Http\Controllers\API\V1\Bahan\CRUD\IndexBahanController;
use App\Http\Controllers\API\V1\Bahan\CRUD\UpdateBahanController;
use App\Http\Controllers\API\V1\Bahan\Export\CategoryExportController;
use App\Http\Controllers\API\V1\Bahan\Export\MasukKeluarExportController;
use App\Http\Controllers\API\V1\Bahan\Export\SatuanExportController;
use App\Http\Controllers\API\V1\Bahan\Export\StokOpnameExportController;
use App\Http\Controllers\API\V1\Bahan\Export\TemplateExportController;
use App\Http\Controllers\API\V1\Bahan\Import\ImportBahanController;
use App\Http\Controllers\API\V1\Bahan\Import\MasukKeluarController;
use App\Http\Controllers\API\V1\Bahan\Import\StokOpnameImportController;
use App\Http\Controllers\API\V1\Bahan\Keluar\CreateKeluarController;
use App\Http\Controllers\API\V1\Bahan\Keluar\DeleteKeluarController;
use App\Http\Controllers\API\V1\Bahan\Keluar\GetKeluarController;
use App\Http\Controllers\API\V1\Bahan\Masuk\CreateMasukController;
use App\Http\Controllers\API\V1\Bahan\Masuk\DeleteMasukController;
use App\Http\Controllers\API\V1\Bahan\Masuk\GetMasukController;
use App\Http\Controllers\API\V1\Bahan\Satuan\CreateSatuanController;
use App\Http\Controllers\API\V1\Bahan\Satuan\DeleteSatuanController;
use App\Http\Controllers\API\V1\Bahan\Satuan\DetailSatuanController;
use App\Http\Controllers\API\V1\Bahan\Satuan\IndexSatuanController;
use App\Http\Controllers\API\V1\Bahan\Satuan\UpdateSatuanController;
use App\Http\Controllers\API\V1\History\Product\GetHistoryProductController;
use App\Http\Controllers\API\V1\History\Stok\ExportHistoryController;
use App\Http\Controllers\API\V1\History\Stok\GetHistoryController;
use App\Http\Controllers\API\V1\Product\Category\CreateCategoryProductController;
use App\Http\Controllers\API\V1\Product\Category\DeleteCategoryProductController;
use App\Http\Controllers\API\V1\Product\Category\DetailCategoryProductController;
use App\Http\Controllers\API\V1\Product\Category\IndexCategoryProductController;
use App\Http\Controllers\API\V1\Product\Category\UpdateCategoryProductController;
use App\Http\Controllers\API\V1\Product\CRUD\CreateProductController;
use App\Http\Controllers\API\V1\Product\CRUD\DeleteProductController;
use App\Http\Controllers\API\V1\Product\CRUD\DetailProductController;
use App\Http\Controllers\API\V1\Product\CRUD\IndexProductController;
use App\Http\Controllers\API\V1\Product\CRUD\UpdateProductController;
use App\Http\Controllers\API\V1\Product\Keluar\CreateKeluarProductController;
use App\Http\Controllers\API\V1\Product\Keluar\DeleteKeluarProductController;
use App\Http\Controllers\API\V1\Product\Keluar\GetKeluarProductController;
use App\Http\Controllers\API\V1\Product\Masuk\CreateMasukProductController;
use App\Http\Controllers\API\V1\Product\Masuk\DeleteMasukProductController;
use App\Http\Controllers\API\V1\Product\Masuk\GetMasukProductController;
use App\Http\Controllers\API\V1\Product\Production\ChangeStatusProductionController;
use App\Http\Controllers\API\V1\Product\Production\CreateProductionController;
use App\Http\Controllers\API\V1\Product\Production\DeleteProductionController;
use App\Http\Controllers\API\V1\Product\Production\DetailProductionController;
use App\Http\Controllers\API\V1\Product\Production\IndexProductionController;
use App\Http\Controllers\API\V1\Product\Production\UpdateProductionController;
use App\Http\Controllers\API\V1\Product\Recipe\CreateRecipeController;
use App\Http\Controllers\API\V1\Product\Recipe\DeleteRecipeController;
use App\Http\Controllers\API\V1\Product\Recipe\DetailRecipeController;
use App\Http\Controllers\API\V1\Product\Recipe\IndexRecipeController;
use App\Http\Controllers\API\V1\Product\Recipe\UpdateRecipeController;
use App\Http\Controllers\API\V1\Product\Satuan\CreateSatuanProductController;
use App\Http\Controllers\API\V1\Product\Satuan\DeleteSatuanProductController;
use App\Http\Controllers\API\V1\Product\Satuan\DetailSatuanProductController;
use App\Http\Controllers\API\V1\Product\Satuan\IndexSatuanProductController;
use App\Http\Controllers\API\V1\Product\Satuan\UpdateSatuanProductController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\CreatePOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DeletePOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPO\CreateDetailPOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPO\DeleteDetailPOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPO\DetailDetailPOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPO\UpdateDetailPOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\IndexPOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\StatusPOController;
use App\Http\Controllers\API\V1\PurchaseOrder\CRUD\UpdatePOController;
use App\Http\Controllers\API\V1\PurchaseOrder\Export\RequestPOController;
use App\Http\Controllers\API\V1\PurchaseOrder\Supplier\CreateSupplierController;
use App\Http\Controllers\API\V1\PurchaseOrder\Supplier\DeleteSupplierController;
use App\Http\Controllers\API\V1\PurchaseOrder\Supplier\DetailSupplierController;
use App\Http\Controllers\API\V1\PurchaseOrder\Supplier\IndexSupplierController;
use App\Http\Controllers\API\V1\PurchaseOrder\Supplier\UpdateSupplierController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\ChangeStatusSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\CreateSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\DeleteSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\DetailSalesOrder\CreateDetailSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\DetailSalesOrder\DeleteDetailSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\DetailSalesOrder\DetailDetailSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\DetailSalesOrder\UpdateDetailSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\DetailSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\IndexSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\CRUD\UpdateSalesOrderController;
use App\Http\Controllers\API\V1\SalesOrder\Customer\CreateCustomerController;
use App\Http\Controllers\API\V1\SalesOrder\Customer\DeleteCustomerController;
use App\Http\Controllers\API\V1\SalesOrder\Customer\DetailCustomerController;
use App\Http\Controllers\API\V1\SalesOrder\Customer\GetCustomerController;
use App\Http\Controllers\API\V1\SalesOrder\Customer\UpdateCustomerController;
use App\Http\Controllers\API\V1\User\Auth\GetDataAuthController;
use App\Http\Controllers\API\V1\User\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::post(uri: 'login', action: LoginController::class);
Route::middleware(['auth:api'])->group(function () {
    Route::get(uri: 'auth', action: GetDataAuthController::class);
    //category Product
    Route::prefix('product-category')->group(function () {
        Route::get(uri: '', action: IndexCategoryProductController::class);
        Route::post(uri: '', action: CreateCategoryProductController::class);
        Route::prefix('{cat}')->group(function () {
            Route::delete(uri: '', action: DeleteCategoryProductController::class);
            Route::put(uri: '', action: UpdateCategoryProductController::class);
            Route::get(uri: '', action: DetailCategoryProductController::class);
        });
    });

    //Category Bahan
    Route::prefix('category')->group(function () {
        Route::get(uri: '', action: IndexCategoryController::class);
        Route::post(uri: '', action: CreateCategoryController::class);
        Route::prefix('{cat}')->group(function () {
            Route::delete(uri: '', action: DeleteCategoryController::class);
            Route::put(uri: '', action: UpdateCategoryController::class);
            Route::get(uri: '', action: DetailCategoryController::class);
        });
    });
    //Satuan Bahan
    Route::prefix('satuan')->group(function () {
        Route::get(uri: '', action: IndexSatuanController::class);
        Route::post(uri: '', action: CreateSatuanController::class);
        Route::prefix('{sat}')->group(function () {
            Route::delete(uri: '', action: DeleteSatuanController::class);
            Route::put(uri: '', action: UpdateSatuanController::class);
            Route::get(uri: '', action: DetailSatuanController::class);
        });
    });

    //Satuan Product
    Route::prefix('product-satuan')->group(function () {
        Route::get(uri: '', action: IndexSatuanProductController::class);
        Route::post(uri: '', action: CreateSatuanProductController::class);
        Route::prefix('{sat}')->group(function () {
            Route::delete(uri: '', action: DeleteSatuanProductController::class);
            Route::put(uri: '', action: UpdateSatuanProductController::class);
            Route::get(uri: '', action: DetailSatuanProductController::class);
        });
    });
    //bahan
    Route::prefix('bahan')->group(function () {
        Route::get(uri: '', action: IndexBahanController::class);
        Route::post(uri: '', action: CreateBahanController::class);
        Route::prefix('{bah}')->group(function () {
            Route::delete(uri: '', action: DeleteBahanController::class);
            Route::put(uri: '', action: UpdateBahanController::class);
            Route::get(uri: '', action: DetailBahanController::class);
        });
    });
    //product
    Route::prefix('product')->group(function () {
        Route::get(uri: '', action: IndexProductController::class);
        Route::post(uri: '', action: CreateProductController::class);
        Route::prefix('{prod}')->group(function () {
            Route::delete(uri: '', action: DeleteProductController::class);
            Route::put(uri: '', action: UpdateProductController::class);
            Route::get(uri: '', action: DetailProductController::class);
        });
    });
    Route::prefix('detail-po')->group(function () {
        Route::post(uri: '', action: CreateDetailPOController::class);
        Route::prefix('{det}')->group(function () {
            Route::get(uri: '', action: DetailDetailPOController::class);
            Route::put(uri: '', action: UpdateDetailPOController::class);
            Route::delete(uri: '', action: DeleteDetailPOController::class);
        });
    });
    //customer
    Route::prefix('customer')->group(function () {
        Route::get(uri: '', action: GetCustomerController::class);
        Route::post(uri: '', action: CreateCustomerController::class);
        Route::prefix('{cus}')->group(function () {
            Route::get(uri: '', action: DetailCustomerController::class);
            Route::put(uri: '', action: UpdateCustomerController::class);
            Route::delete(uri: '', action: DeleteCustomerController::class);
        });
    });

    //supplier
    Route::prefix('supplier')->group(function () {
        Route::get(uri: '', action: IndexSupplierController::class);
        Route::post(uri: '', action: CreateSupplierController::class);
        Route::prefix('{sup}')->group(function () {
            Route::get(uri: '', action: DetailSupplierController::class);
            Route::put(uri: '', action: UpdateSupplierController::class);
            Route::delete(uri: '', action: DeleteSupplierController::class);
        });
    });
    //PO
    Route::prefix('purchase-order')->group(function () {
        Route::get(uri: '', action: IndexPOController::class);
        Route::post(uri: '', action: CreatePOController::class);
        Route::prefix('{po}')->group(function () {
            Route::get(uri: '', action: DetailPOController::class);
            Route::put(uri: '', action: UpdatePOController::class);
            Route::delete(uri: '', action: DeletePOController::class);
            Route::patch(uri: '/{status}', action: StatusPOController::class);
        });
    });

    //detail sales order
    Route::prefix('detail-sales-order')->group(function () {
        Route::post(uri: '', action: CreateDetailSalesOrderController::class);
        Route::prefix('{det}')->group(function () {
            Route::get(uri: '', action: DetailDetailSalesOrderController::class);
            Route::put(uri: '', action: UpdateDetailSalesOrderController::class);
            Route::delete(uri: '', action: DeleteDetailSalesOrderController::class);
        });
    });
    //sales order
    Route::prefix('sales-order')->group(function () {
        Route::get(uri: '', action: IndexSalesOrderController::class);
        Route::post(uri: '', action: CreateSalesOrderController::class);
        Route::prefix('{sal}')->group(function () {
            Route::get(uri: '', action: DetailSalesOrderController::class);
            Route::put(uri: '', action: UpdateSalesOrderController::class);
            Route::delete(uri: '', action: DeleteSalesOrderController::class);
            Route::patch(uri: '/{status}/{payment}', action: ChangeStatusSalesOrderController::class);
        });
    });
    Route::get(uri: 'product-history', action: GetHistoryProductController::class);
    Route::get(uri: 'history', action: GetHistoryController::class);
    // Resep
    Route::prefix('recipe')->group(function () {
        Route::get(uri: '', action: IndexRecipeController::class);
        Route::post(uri: '', action: CreateRecipeController::class);
        Route::prefix('{res}')->group(function () {
            Route::get(uri: '', action: DetailRecipeController::class);
            Route::delete(uri: '', action: DeleteRecipeController::class);
            Route::put(uri: '', action: UpdateRecipeController::class);
        });
    });
    //production
    Route::prefix('production')->group(function () {
        Route::get(uri: '', action: IndexProductionController::class);
        Route::post(uri: '', action: CreateProductionController::class);
        Route::prefix('{prod}')->group(function () {
            Route::put(uri: '', action: UpdateProductionController::class);
            Route::get(uri: '', action: DetailProductionController::class);
            Route::delete(uri: '', action: DeleteProductionController::class);
            Route::patch(uri: '{status}', action: ChangeStatusProductionController::class);
            Route::put(uri: '{status}', action: ChangeStatusProductionController::class);
        });
    });
    //masuk
    Route::prefix('product-masuk')->group(function () {
        Route::get(uri: '', action: GetMasukProductController::class);
        Route::post(uri: '', action: CreateMasukProductController::class);
        Route::prefix('{mas}')->group(function () {
            Route::delete(uri: '', action: DeleteMasukProductController::class);
        });
    });
    //masuk
    Route::prefix('masuk')->group(function () {
        Route::get(uri: '', action: GetMasukController::class);
        Route::post(uri: '', action: CreateMasukController::class);
        Route::prefix('{mas}')->group(function () {
            Route::delete(uri: '', action: DeleteMasukController::class);
        });
    });
    //keluar product
    Route::prefix('product-keluar')->group(function () {
        Route::get(uri: '', action: GetKeluarProductController::class);
        Route::post(uri: '', action: CreateKeluarProductController::class);
        Route::prefix('{kel}')->group(function () {
            Route::delete(uri: '', action: DeleteKeluarProductController::class);
        });
    });

    //keluar
    Route::prefix('keluar')->group(function () {
        Route::get(uri: '', action: GetKeluarController::class);
        Route::post(uri: '', action: CreateKeluarController::class);
        Route::prefix('{kel}')->group(function () {
            Route::delete(uri: '', action: DeleteKeluarController::class);
        });
    });
    Route::prefix('export')->group(function () {
        Route::prefix('excel')->group(function () {
            Route::get(uri: 'category', action: CategoryExportController::class);
            Route::get(uri: 'satuan', action: SatuanExportController::class);
            Route::get(uri: 'bahan', action: TemplateExportController::class);
            Route::get(uri: 'masuk-keluar', action: MasukKeluarExportController::class);
            Route::get(uri: 'history', action: ExportHistoryController::class);
            Route::get(uri: 'request-po/{po}', action: RequestPOController::class);
            Route::get(uri: 'stok-opname', action: StokOpnameExportController::class);
        });
    });
    Route::prefix('import')->group(function () {
        Route::post(uri: 'stok-opname', action: StokOpnameImportController::class);
        Route::post(uri: 'masuk-keluar/{bah}', action: MasukKeluarController::class);
        Route::post(uri: 'bahan', action: ImportBahanController::class);
    });
});
