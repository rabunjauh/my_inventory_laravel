<?php

use App\Http\Controllers\HardwareCategoryController;
use App\Http\Controllers\SoftwareCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HardwareController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

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

// Route::get('/', function () {
//     return view('layouts/main');
// });
// Route::get('/hardwareCategory/{edit}', [HardwareCategoryController::class, 'edit']);
Route::resource('/hardwareCategory', HardwareCategoryController::class);
Route::resource('/softwareCategory', SoftwareCategoryController::class);
Route::resource('/project', ProjectController::class);