<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, ProductController};

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

Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::get('add', [AdminController::class, 'create'])->name('admin.create');
Route::post('store', [AdminController::class, 'store'])->name('admin.store');
Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::post('delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

Route::group([
    'prefix' => 'product',
    'as' => 'product.'
], static function() {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('add', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
    Route::post('delete/{id}', [ProductController::class, 'delete'])->name('delete');
});
