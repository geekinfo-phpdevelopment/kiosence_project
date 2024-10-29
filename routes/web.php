<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\HeadQuartersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicineCategoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login_request'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::middleware(['userAuth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/role/disable/{id}', [RoleController::class, 'disable'])->name('role.disable');
    Route::get('/role/enable/{id}', [RoleController::class, 'enable'])->name('role.enable');
    Route::resource('/role', RoleController::class);
    Route::get('/module/disable/{id}', [ModuleController::class, 'disable'])->name('module.disable');
    Route::get('/module/enable/{id}', [ModuleController::class, 'enable'])->name('module.enable');
    Route::resource('/module', ModuleController::class);
    Route::resource('/permission', PermissionController::class);
    Route::get('/users/disable/{id}', [UserController::class, 'disable'])->name('users.disable');
    Route::get('/users/enable/{id}', [UserController::class, 'enable'])->name('users.enable');
    Route::resource('/users', UserController::class);
    Route::get('/clients/disable/{id}', [ClientController::class, 'disable'])->name('clients.disable');
    Route::get('/clients/enable/{id}', [ClientController::class, 'enable'])->name('clients.enable');
    Route::resource('/clients', ClientController::class);
    Route::get('/category/disable/{id}', [MedicineCategoryController::class, 'disable'])->name('category.disable');
    Route::get('/category/enable/{id}', [MedicineCategoryController::class, 'enable'])->name('category.enable');
    Route::resource('/category', MedicineCategoryController::class);
    Route::get('/medicines/disable/{id}', [MedicineController::class, 'disable'])->name('medicines.disable');
    Route::get('/medicines/enable/{id}', [MedicineController::class, 'enable'])->name('medicines.enable');
    Route::resource('/medicines', MedicineController::class);
    Route::get('/doctors/disable/{id}', [DoctorsController::class, 'disable'])->name('doctors.disable');
    Route::get('/doctors/enable/{id}', [DoctorsController::class, 'enable'])->name('doctors.enable');
    Route::resource('/doctors', DoctorsController::class);
    Route::get('/hq/disable/{id}', [HeadQuartersController::class, 'disable'])->name('hq.disable');
    Route::get('/hq/enable/{id}', [HeadQuartersController::class, 'enable'])->name('hq.enable');
    Route::resource('/hq', HeadQuartersController::class);
    Route::get('/suppliers/disable/{id}', [SupplierController::class, 'disable'])->name('suppliers.disable');
    Route::get('/suppliers/enable/{id}', [SupplierController::class, 'enable'])->name('suppliers.enable');
    Route::resource('/suppliers', SupplierController::class);
    Route::get('/stocks/disable/{id}', [StockController::class, 'disable'])->name('stocks.disable');
    Route::get('/stocks/enable/{id}', [StockController::class, 'enable'])->name('stocks.enable');
    Route::resource('/stocks', StockController::class);
    Route::get('/supplies/unpaid/{id}', [SupplyController::class, 'unpaid'])->name('supplies.unpaid');
    Route::get('/supplies/paid/{id}', [SupplyController::class, 'paid'])->name('supplies.paid');
    Route::resource('/supplies', SupplyController::class);
    Route::get('/settings', function () {
        return 'welcome';
    })->name('settings');

});

