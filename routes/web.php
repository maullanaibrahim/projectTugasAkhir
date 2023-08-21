<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PpbjeController;
use App\Http\Controllers\PurchaseController;
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
Route::get('/dashboard{div}-{pos}', [DashboardController::class, 'index'])
   ->middleware('auth')->name('dashboard');

// Route PPBJe Asset
Route::get('/ppbje-asset{div}-{pos}', [PPBJeController::class, 'asset'])
    ->middleware('auth')->name('ppbje-asset');
Route::get('/ppbje-asset/{div}-{pos}/create', [PPBJeController::class, 'createAsset'])
    ->middleware('auth')->name('ppbje-createAsset');
Route::get('/ppbje-asset{div}-{pos}/{ppbje}', [PPBJeController::class, 'show'])
   ->middleware('auth')->name('ppbje-assetDetail');
Route::get('/ppbje-asset/progress{id}-{type}', [PPBJeController::class, 'progress'])
    ->middleware('auth')->name('ppbje-progress');
Route::get('/ppbje-asset/stock{ppbje}', [PPBJeController::class, 'stock'])
    ->middleware('asset')->name('ppbje-assetStock');
Route::post('/ppbje-asset/{detail}/update-stock', [PPBJeController::class, 'updateStock'])
    ->middleware('asset')->name('ppbje-assetUpdateStock');
Route::post('/ppbje-asset{div}-{pos}/{ppbje}/update', [PPBJeController::class, 'update'])
    ->middleware('auth')->name('ppbje-assetUpdate');
Route::delete('/ppbje-asset{div}-{pos}/{ppbje}', [PPBJeController::class, 'destroy'])
    ->middleware('auth')->name('ppbje-assetDelete');

// Route PPBJe NonAsset
Route::get('/ppbje-nonAsset{div}-{pos}', [PPBJeController::class, 'nonAsset'])
    ->middleware('auth')->name('ppbje-nonAsset');
Route::get('/ppbje-nonAsset/{div}-{pos}/create', [PPBJeController::class, 'createNonAsset'])
    ->middleware('auth')->name('ppbje-createNonAsset');
Route::get('/ppbje-nonAsset{div}-{pos}/{ppbje}', [PPBJeController::class, 'show'])
    ->middleware('auth')->name('ppbje-nonAssetDetail');
Route::get('/ppbje-nonAsset/progress{id}-{type}', [PPBJeController::class, 'progress'])
    ->middleware('auth')->name('ppbje-progress');
Route::post('/ppbje-nonAsset{div}-{pos}/{ppbje}/update', [PPBJeController::class, 'update'])
    ->middleware('auth')->name('ppbje-nonAssetUpdate');
Route::delete('/ppbje-nonAsset{div}-{pos}/{ppbje}', [PPBJeController::class, 'destroy'])
    ->middleware('auth')->name('ppbje-nonAssetDelete');

Route::post('/ppbje-store{id}', [PPBJeController::class, 'store'])
    ->middleware('auth')->name('ppbje-store');

   
// Get on Create PPBJe
Route::get('/ppbje-create/{id}', [PPBJeController::class, 'getCost'])
   ->middleware('auth')->name('getCost');
Route::get('/ppbje-create2/{id}', [PPBJeController::class, 'getApplicant'])
   ->middleware('auth')->name('getApplicant');
Route::get('/ppbje-create3/{id}', [PPBJeController::class, 'getPosition'])
   ->middleware('auth')->name('getPosition');
Route::get('/ppbje-create4/{id}', [PPBJeController::class, 'getDivision'])
   ->middleware('auth')->name('getDivision');
Route::get('/ppbje-create5/{id}', [PPBJeController::class, 'getItem'])
   ->middleware('auth')->name('getItem');
Route::get('/ppbje-create6/{id}', [PPBJeController::class, 'getChief'])
   ->middleware('auth')->name('getChief');
Route::get('/ppbje-create7/{id}', [PPBJeController::class, 'getManager'])
   ->middleware('auth')->name('getManager');
Route::get('/ppbje-create8/{id}', [PPBJeController::class, 'getSeniorManager'])
   ->middleware('auth')->name('getSeniorManager');
Route::get('/ppbje-create9/{id}', [PPBJeController::class, 'getDirector'])
   ->middleware('auth')->name('getDirector');

// Route Purchase Order
Route::get('/purchases{pos}', [PurchaseController::class, 'index'])
   ->middleware('auth')->name('purchase.index');
Route::get('/purchases/create{ppbje}-{supplier}', [PurchaseController::class, 'create'])
   ->middleware('procurement')->name('purchase.create');
Route::post('/purchases{pos}', [PurchaseController::class, 'store'])
   ->middleware('procurement')->name('purchase.store');
Route::get('/purchases/{id}-{purchase}', [PurchaseController::class, 'show'])
   ->middleware('auth')->name('purchase.detail');
Route::get('/purchases/{purchase}/edit{id}', [PurchaseController::class, 'edit'])
   ->middleware('procurement')->name('purchase.edit');
Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])
   ->middleware('procurement')->name('purchase.update');
Route::post('/purchases/{purchase}', [PurchaseController::class, 'approval'])
   ->middleware('procurement')->name('purchase.update');

// Route User
Route::resource('/users', UserController::class)
   ->middleware('it');

// Route Employee
Route::resource('/employees', EmployeeController::class)
   ->middleware('it');

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
   ->middleware('procurement');