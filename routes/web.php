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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/{anypath}', [App\Http\Controllers\HomeController::class, 'index'])->where('path', '.*');

// Route::get('posts',[PostController::class, 'index']);
Route::get('get-categories',[CategoryController::class, 'index']);


Route::post('/add-category',[CategoryController::class, 'store'])->name('add-category');
Route::get('remove-category/{slug}',[CategoryController::class, 'destroy']);
Route::get('show-category/{slug}',[CategoryController::class, 'show']);
