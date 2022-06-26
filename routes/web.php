<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

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
    return view('frontend.layout');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/{anypath}', [App\Http\Controllers\HomeController::class, 'index'])->where('path', '.*');

// Route::get('posts',[PostController::class, 'index']);


//Category Rotues
Route::get('get-categories',[CategoryController::class, 'index']);
Route::post('/add-category',[CategoryController::class, 'store'])->name('add-category');
Route::get('remove-category/{slug}',[CategoryController::class, 'destroy']);
Route::get('/show-category/{slug}',[CategoryController::class, 'show']);
Route::post('update-category',[CategoryController::class, 'update']);
Route::post('categories/remove-items',[CategoryController::class, 'removeItems']);
Route::post('categories/change-status',[CategoryController::class, 'changeStatus']);
Route::get('categories/get-active-categories',[CategoryController::class, 'activeCategories']);


//Posts Rotues
Route::get('get-posts',[PostController::class, 'index']);
Route::post('/add-post',[PostController::class, 'store'])->name('add-post');
Route::get('remove-post/{id}',[PostController::class, 'destroy']);
Route::get('/show-post/{id}',[PostController::class, 'show']);
Route::post('update-post',[PostController::class, 'update']);
Route::post('posts/remove-items',[PostController::class, 'removeItems']);
Route::post('posts/change-status',[PostController::class, 'changeStatus']);
