<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DeliveryMethodController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ExpenseCategoriesController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PackagingTypeController;
use App\Http\Controllers\Admin\PaymentTermsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\PurchaseOrderReturnController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SalesOrderReturnController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransferStockController;
use App\Http\Controllers\Admin\WarehousesController;
use App\Http\Controllers\Auth\Admin\LoginController;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [LoginController::class, 'submitForgotPassword'])->name('forgot-password');
Route::get('/reset-password/{token}', [LoginController::class, 'resetPassword'])->name('reset-password');
Route::post('/submit-reset-password', [LoginController::class, 'submitResetPassword'])->name('submit-reset-password');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['admin'])->group(function () {
    //Dashboard Route
    Route::get('/', [HomeController::class, 'dashboard'])->name('index');
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    //Profile Route
    Route::post('/upload-profile-image', [HomeController::class, 'uploadProfileImage'])->name('upload-profile-image');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profile', [HomeController::class, 'updateProfile'])->name('profile');
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('update-password');

    Route::prefix('settings')->group(function () {
        Route::name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::get('/create', [SettingController::class, 'create'])->name('create');
            Route::post('/store', [SettingController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SettingController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SettingController::class, 'destroy'])->name('destroy');
            Route::get('/group/{group}', [SettingController::class, 'settingsGroup'])->name('group');
        });
    });

    Route::prefix('modules')->group(function () {
        Route::name('modules.')->group(function () {
            Route::get('/', [ModuleController::class, 'index'])->name('index');
            Route::get('/create', [ModuleController::class, 'create'])->name('create');
            Route::post('/store', [ModuleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ModuleController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ModuleController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ModuleController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('categories')->group(function () {
        Route::name('categories.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('brands')->group(function () {
        Route::name('brands.')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('/store', [BrandController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [BrandController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [BrandController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('employee')->group(function () {
        Route::name('employee.')->group(function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('index');
            Route::get('/create', [EmployeeController::class, 'create'])->name('create');
            Route::post('/store', [EmployeeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('discounts')->group(function () {
        Route::name('discounts.')->group(function () {
            Route::get('/', [DiscountController::class, 'index'])->name('index');
            Route::get('/create', [DiscountController::class, 'create'])->name('create');
            Route::post('/store', [DiscountController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DiscountController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DiscountController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [DiscountController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('products')->group(function () {
        Route::name('products.')->group(function () {
            Route::get('/', [ProductsController::class, 'index'])->name('index');
            Route::get('/create', [ProductsController::class, 'create'])->name('create');
            Route::post('/store', [ProductsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ProductsController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ProductsController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('purchases')->group(function () {
        Route::name('purchases.')->group(function () {
            Route::get('/', [PurchaseController::class, 'index'])->name('index');
            Route::get('/create', [PurchaseController::class, 'create'])->name('create');
            Route::post('/store', [PurchaseController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PurchaseController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [PurchaseController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [PurchaseController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('sales')->group(function () {
        Route::name('sales.')->group(function () {
            Route::get('/', [SalesController::class, 'index'])->name('index');
            Route::get('/create', [SalesController::class, 'create'])->name('create');
            Route::post('/store', [SalesController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SalesController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SalesController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SalesController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('salaries')->group(function () {
        Route::name('salaries.')->group(function () {
            Route::get('/', [SalaryController::class, 'index'])->name('index');
            Route::get('/create', [SalaryController::class, 'create'])->name('create');
            Route::post('/store', [SalaryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SalaryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SalaryController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SalaryController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('customer')->group(function () {
        Route::name('customer.')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            // Route::get('/create', [CustomerController::class, 'create'])->name('create');
            // Route::post('/store', [CustomerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CustomerController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CustomerController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('suppliers')->group(function () {
        Route::name('suppliers.')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('index');
            Route::get('/create', [SupplierController::class, 'create'])->name('create');
            Route::post('/store', [SupplierController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SupplierController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SupplierController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('purchase_order_returns')->group(function () {
        Route::name('purchase_order_returns.')->group(function () {
            Route::get('/', [PurchaseOrderReturnController::class, 'index'])->name('index');
            Route::get('/create', [PurchaseOrderReturnController::class, 'create'])->name('create');
            Route::post('/store', [PurchaseOrderReturnController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PurchaseOrderReturnController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [PurchaseOrderReturnController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [PurchaseOrderReturnController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('payment_terms')->group(function () {
        Route::name('payment_terms.')->group(function () {
            Route::get('/', [PaymentTermsController::class, 'index'])->name('index');
            Route::get('/create', [PaymentTermsController::class, 'create'])->name('create');
            Route::post('/store', [PaymentTermsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PaymentTermsController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [PaymentTermsController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [PaymentTermsController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('packaging_types')->group(function () {
        Route::name('packaging_types.')->group(function () {
            Route::get('/', [PackagingTypeController::class, 'index'])->name('index');
            Route::get('/create', [PackagingTypeController::class, 'create'])->name('create');
            Route::post('/store', [PackagingTypeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PackagingTypeController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [PackagingTypeController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [PackagingTypeController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('delivery_methods')->group(function () {
        Route::name('delivery_methods.')->group(function () {
            Route::get('/', [DeliveryMethodController::class, 'index'])->name('index');
            Route::get('/create', [DeliveryMethodController::class, 'create'])->name('create');
            Route::post('/store', [DeliveryMethodController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DeliveryMethodController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DeliveryMethodController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [DeliveryMethodController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('expense_categories')->group(function () {
        Route::name('expense_categories.')->group(function () {
            Route::get('/', [ExpenseCategoriesController::class, 'index'])->name('index');
            Route::get('/create', [ExpenseCategoriesController::class, 'create'])->name('create');
            Route::post('/store', [ExpenseCategoriesController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ExpenseCategoriesController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ExpenseCategoriesController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ExpenseCategoriesController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('expenses')->group(function () {
        Route::name('expenses.')->group(function () {
            Route::get('/', [ExpenseController::class, 'index'])->name('index');
            Route::get('/create', [ExpenseController::class, 'create'])->name('create');
            Route::post('/store', [ExpenseController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ExpenseController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ExpenseController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [ExpenseController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('warehouses')->group(function () {
        Route::name('warehouses.')->group(function () {
            Route::get('/', [WarehousesController::class, 'index'])->name('index');
            Route::get('/create', [WarehousesController::class, 'create'])->name('create');
            Route::post('/store', [WarehousesController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [WarehousesController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [WarehousesController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [WarehousesController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('sales_order_returns')->group(function () {
        Route::name('sales_order_returns.')->group(function () {
            Route::get('/', [SalesOrderReturnController::class, 'index'])->name('index');
            Route::get('/create', [SalesOrderReturnController::class, 'create'])->name('create');
            Route::post('/store', [SalesOrderReturnController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SalesOrderReturnController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SalesOrderReturnController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SalesOrderReturnController::class, 'destroy'])->name('destroy');
        });
    });
    Route::prefix('transfer_stocks')->group(function () {
        Route::name('transfer_stocks.')->group(function () {
            Route::get('/', [TransferStockController::class, 'index'])->name('index');
            Route::get('/create', [TransferStockController::class, 'create'])->name('create');
            Route::post('/store', [TransferStockController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TransferStockController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [TransferStockController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [TransferStockController::class, 'destroy'])->name('destroy');
        });
    });
});

