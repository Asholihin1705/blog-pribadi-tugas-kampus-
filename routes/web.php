<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('category', [CategoryController::class, 'index']);

//Route Admin
Route::get('register', [AdminController::class, 'register']);
Route::post('register', [AdminController::class, 'postRegister']);
Route::get('login', [AdminController::class, 'login']);
Route::post('login', [AdminController::class, 'postLogin']);
Route::post('logout', [AdminController::class, 'logout']);

//Route Menu Admin
Route::middleware('checkAdmin')->group(function(){
	Route::prefix('admin')->group(function(){
		Route::get('/', [AdminController::class, 'index']);

        //Menu Category
		Route::prefix('category')->group(function(){
			Route::get('/', [CategoryController::class, 'index']);
			Route::get('create', [CategoryController::class, 'create']);
			Route::post('create', [CategoryController::class, 'insert']);
			Route::get('edit/{id}', [CategoryController::class, 'edit']);
			Route::post('edit/{id}', [CategoryController::class, 'update']);
			Route::get('delete/{id}', [CategoryController::class, 'delete']);
		});

        //Menu Post
		Route::prefix('post')->group(function(){
			Route::get('/', [PostController::class, 'index']);
			Route::get('create', [PostController::class, 'create']);
			Route::post('create', [PostController::class, 'insert']);
			Route::get('edit/{id}', [PostController::class, 'edit']);
			Route::post('edit/{id}', [PostController::class, 'update']);
			Route::get('delete/{id}', [PostController::class, 'delete']);
		});

        //Menu Slider
		Route::prefix('slider')->group(function(){
			Route::get('/', [SliderController::class, 'index']);
			Route::get('create', [SliderController::class, 'create']);
			Route::post('create', [SliderController::class, 'insert']);
			Route::get('edit/{id}', [SliderController::class, 'edit']);
			Route::post('edit/{id}', [SliderController::class, 'update']);
			Route::get('delete/{id}', [SliderController::class, 'delete']);
		});

        //Menu Mainmenu
		Route::prefix('mainmenu')->group(function(){
			Route::get('/', [MainmenuController::class, 'index']);
			Route::get('create', [MainmenuController::class, 'create']);
			Route::post('create', [MainmenuController::class, 'insert']);
			Route::get('edit/{id}', [MainmenuController::class, 'edit']);
			Route::post('edit/{id}', [MainmenuController::class, 'update']);
			Route::get('delete/{id}', [MainmenuController::class, 'delete']);
		});

        //Menu Message
		Route::prefix('message')->group(function(){
			Route::get('/', [MessageController::class, 'index']);
			Route::get('create', [MessageController::class, 'create']);
			Route::get('delete/{id}', [MessageController::class, 'delete']);
		});

		Route::prefix('profile')->group(function(){
			Route::get('{id}', [AdminController::class, 'edit']);
			Route::post('{id}', [AdminController::class, 'update']);
		});
	});
});
