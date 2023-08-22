<?php

use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;

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

// category

Route::resource('category', CategoryController::class);

// restore 
Route::get('category/restore/{id}', [categoryController::class, 'restoreCategory'])->name('category.restore');
Route::get('category/hard/delete/{id}', [categoryController::class, 'hardDelete'])->name('category.hard.delete');

// post

Route::resource('post', PostController::class);