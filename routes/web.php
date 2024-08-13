<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpenditureController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin/item-group/create', [AdminController::class, 'createItemGroupForm'])->name('admin.itemGroups.create');
    Route::post('/admin/item-group/create', [AdminController::class, 'createItemGroup'])->name('admin.itemGroups.store');
    
    Route::get('admin/item/create', [AdminController::class, 'createItemForm'])->name('admin.items.create');
    Route::post('admin/item/create', [AdminController::class, 'createItem'])->name('admin.items.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('expenditures', [ExpenditureController::class, 'viewExpenditures'])->name('expenditures.index'); 
    Route::post('expenditures', [ExpenditureController::class, 'addExpenditure'])->name('expenditures.store');
    Route::get('items/{categoryId}', [ExpenditureController::class, 'getItemsByCategory'])->name('items.byCategory');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
