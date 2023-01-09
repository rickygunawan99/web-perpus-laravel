<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/book/detail/{id}', [\App\Http\Controllers\HomeController::class, 'detailBook'])
->name('book.detail');
Route::get('/login', [\App\Http\Controllers\HomeController::class, 'login'])
    ->name('member.login');
Route::post('/login', [\App\Http\Controllers\HomeController::class, 'doLogin']);
Route::post('/member/logout/{id}', [\App\Http\Controllers\MemberController::class, 'doLogout'])->name('member.logout');
Route::get('/cart', [\App\Http\Controllers\MemberController::class, 'editCart']);
Route::get('/cart/detail', [\App\Http\Controllers\MemberController::class, 'cartDetail']);

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);
Route::get('/admin/add/book', [\App\Http\Controllers\AdminController::class, 'addBook'])->name('admin.add-book');
Route::post('/admin/add/book', [\App\Http\Controllers\AdminController::class, 'doAddBook'])->name('admin.do-add-book');
Route::post('/admin/logout', [\App\Http\Controllers\AdminController::class, 'doLogout'])->name('admin.logout');

Route::post('/book/destroy', [\App\Http\Controllers\AdminController::class, 'destroyBook'])->name('book.destroy');
Route::get('/book/update/{id}', [\App\Http\Controllers\AdminController::class, 'updateBook'])->name('book.update');
Route::post('/book/update/{id}', [\App\Http\Controllers\AdminController::class, 'updateBook'])->name('book.update.store');
