<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GraphicCardController;
use App\Http\Controllers\HardwareCategoryController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\HardwareModelController;
use App\Http\Controllers\HardwareTypeController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\itemStockController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\ProcessorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SoftwareCategoryController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\SupplierController;
use App\Models\itemStock;

// use App\Models\Hardware;

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

Route::resource('/department', DepartmentController::class);
Route::resource('/graphicCard', GraphicCardController::class);
Route::resource('/hardwareCategory', HardwareCategoryController::class);
Route::get('/hardware/json', [HardwareController::class, 'hardware_ajax'])->name('hardware_ajax');
Route::get('/itemStock/json', [itemStockController::class, 'itemStockAjax']);
Route::resource('/', HardwareController::class);
Route::get('/hardware/hardware_ajax_select', [HardwareController::class, 'hardware_ajax_select'])->name('hardware_ajax_select');
Route::get('/hardware/hardware_by_id/{id}', [HardwareController::class, 'hardware_by_id'])->name('hardware_by_id');
Route::resource('/hardwareModel', HardwareModelController::class);
Route::resource('/hardwareType', HardwareTypeController::class);
Route::get('/inventory/inventoryDetailJson/{id}', [InventoryController::class, 'inventoryDetailAjax'])->name('inventoryDetailAjax');
Route::get('/inventory/inventoryDetailJsonByHardwareId/{id}', [InventoryController::class, 'inventoryDetailAjaxByHardwareId'])->name('inventoryDetailAjaxByHardwareId');
Route::get('/inventory/json', [InventoryController::class, 'inventory_ajax'])->name('inventory_ajax');
// Route::get('/inventory/inventoryDetailJson', [InventoryController::class, 'inventoryDetailAjax'])->name('inventoryDetailAjax');
Route::resource('/inventory', InventoryController::class);
Route::resource('/itemStock', itemStockController::class);
Route::resource('/manufacturer', ManufacturerController::class);
Route::resource('/memory', MemoryController::class);
Route::resource('/processor', ProcessorController::class);
Route::resource('/project', ProjectController::class);
Route::resource('/softwareCategory', SoftwareCategoryController::class);
Route::resource('/storage', storageController::class);
Route::resource('/supplier', SupplierController::class);