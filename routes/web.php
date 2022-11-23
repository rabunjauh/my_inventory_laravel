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
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\ProcessorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SoftwareCategoryController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\SupplierController;

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
Route::resource('/', HardwareController::class);
Route::resource('/hardwareModel', HardwareModelController::class);
Route::resource('/hardwareType', HardwareTypeController::class);
Route::resource('/inventory', InventoryController::class);
Route::resource('/manufacturer', ManufacturerController::class);
Route::resource('/memory', MemoryController::class);
Route::resource('/processor', ProcessorController::class);
Route::resource('/project', ProjectController::class);
Route::resource('/softwareCategory', SoftwareCategoryController::class);
Route::resource('/storage', storageController::class);
Route::resource('/supplier', SupplierController::class);