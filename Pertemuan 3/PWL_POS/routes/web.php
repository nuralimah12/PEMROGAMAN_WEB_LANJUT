<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/level', [LevelController::class, 'index']);

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');

Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');

Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');

Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');

Route::delete('/kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

Route::post('/user', [KategoriController::class, 'index'])->name('user.index');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

Route::post('/user', [UserController::class, 'store'])->name('user.store');