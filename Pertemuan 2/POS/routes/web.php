<?php

use App\Http\Controllers\CategoryController;
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

Route::get('/pos', function () {
    return view('pos');
});


Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [CategoryController::class, 'food'])->name('category.food');
    Route::get('/beauty-health', [CategoryController::class, 'beauty'])->name('category.beauty');
    Route::get('/home-care', [CategoryController::class, 'homecare'])->name('category.homecare');
    Route::get('/baby-kid', [CategoryController::class, 'babykid'])->name('category.babykid');
    // Tambahkan rute lainnya di sini
});
    

Route::get('/user/{id}/name/{name}', function 
($Id, $Name) {
 return 'ID Pengguna '.$Id." Nama: ".$Name;
});
