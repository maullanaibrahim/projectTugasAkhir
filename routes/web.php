<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PPBJeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;

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

// Route Login
Route::get('/', [LoginController::class, 'index'])
   ->middleware('guest')->name('login.index');
Route::post('/login', [LoginController::class, 'authenticate'])
   ->name('login.auth');
Route::post('/logout', [LoginController::class, 'logout'])
   ->name('logout');

// Route Register
Route::get('/register', [RegisterController::class, 'index'])
   ->middleware('auth')->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])
   ->name('register.store');

// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
   ->middleware('auth')->name('dashboard');

// Route PPBJe
Route::get('/ppbje-asset', [PPBJeController::class, 'asset'])
   ->middleware('auth')->name('ppbje-asset');
Route::get('/ppbje-nonAsset', [PPBJeController::class, 'nonAsset'])
   ->middleware('auth')->name('ppbje-nonAsset');
Route::get('/ppbje-asset/create', [PPBJeController::class, 'createAsset'])
   ->middleware('auth')->name('ppbje-createAsset');
Route::get('/ppbje-nonAsset/create', [PPBJeController::class, 'createNonAsset'])
   ->middleware('auth')->name('ppbje-createNonAsset');
Route::post('/ppbje-store', [PPBJeController::class, 'store'])
   ->middleware('auth')->name('ppbje-store');
   
// Get on Create PPBJe
Route::get('/ppbje-create/{id}', [PPBJeController::class, 'getCost'])
   ->middleware('auth')->name('getCost');
Route::get('/ppbje-create2/{id}', [PPBJeController::class, 'getApplicant'])
   ->middleware('auth')->name('getApplicant');
Route::get('/ppbje-create3/{id}', [PPBJeController::class, 'getItem'])
   ->middleware('auth')->name('getItem');

// Route User
Route::resource('/users', UserController::class)
   ->middleware('auth');

// Route Employee
Route::resource('/employees', EmployeeController::class)
   ->middleware('auth');

// Route Branch
Route::resource('/branches', BranchController::class)
   ->middleware('auth');

// Route Division
Route::resource('/divisions', DivisionController::class)
   ->middleware('auth');

// Route Item
Route::resource('/items', ItemController::class)
   ->middleware('auth');

// Route Supplier
Route::resource('/suppliers', SupplierController::class)
   ->middleware('auth');