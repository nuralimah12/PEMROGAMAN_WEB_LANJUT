<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::get('/', [PageController::class,'index']);

//use Illuminate\Support\Facades\Route;
//controller
/*Route::get('/hello', [WelcomeController::class,'hello']);
Route::get('/about', [PageController::class,'about']);
Route::get('/articles/{id}', [PageController::class,'articles']);*/

//use Illuminate\Support\Facades\Route;
Route::get('/world', function () {
 return 'World';
});

/*Route::get('/selamatdatang', function () {
    return 'Selamat Datang';
   });*/

   


/*Route::get('/about', function () {
    return 'NIM : 2141762004 NAMA : NUR ALIMAH';
   });*/

Route::get('/user/{name}', function ($name) {
    return 'Nama saya '.$name;
    });


 Route::get('/posts/{post}/comments/{comment}', function 
    ($postId, $commentId) {
     return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
    });


    Route::get('/user/{name}', function ($name) {
        return 'Nama saya '.$name;
        });
    
    /*Route::get('/articles/{id}', function ($id) {
    return 'Halaman Artikel dengan ID'.$id;
    });*/

   Route::get('/user/{name?}', function ($name='alimah') {
    return 'Nama saya '.$name;
    });

    Route::get('/user/{name?}', function ($name='John') {
        return 'Nama saya '.$name;
        });
    
   /*  Route::get('hello', function () {
    $hello = ['Hello World', 2 => ['Hello Jakarta','Hello Medan']];
    dd($hello);
    return $hello;
    });*/

   /* Route::get('hello', function () {
        $hello ='Hello World';
        var_dump($hello);
        die();
        return $hello;
    });*/


   /* Route::get('/', function () {
        return view('welcome');

    });*/

    Route::get('/dosen', function () {
        $arrDosen =["Pak Zahwa","Bu Wilda","Pak Khairy","Bu Vivin","Pak Usman"];
        return view ('polinema.dosen',['dosen' => $arrDosen]);
    });

    Route::get('/', HomeController::class);
Route::get('/about', AboutController::class);
Route::get('/articles/{id}', ArticlesController::class);
Route::resource('photos', PhotoController::class)->only([  'index', 'show' ]); 
 Route::resource('photos', PhotoController::class)->except([ 'create', 'store', 'update', 'destroy' ]); 
 //Route::get('/greeting', function () {  	return view('blog.hello', ['name' => 'Andi']); });  
 Route::get('/greeting', [WelcomeController::class,'greeting']); 
  
        


    



    
    


