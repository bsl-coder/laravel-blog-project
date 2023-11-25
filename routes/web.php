<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
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

// profile route
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/name/update/{id}', [ProfileController::class, 'name_update'])->name('profile.name');
Route::post('/profile/image/update/{id}', [ProfileController::class, 'image_update'])->name('profile.image');
Route::post('/profile/email/update/{id}', [ProfileController::class, 'email_update'])->name('profile.email');
Route::post('/profile/password/update/{id}', [ProfileController::class, 'password_update'])->name('profile.password');

// category route
Route::get('/category',[CategoryController::class,'index'])->name('category');
Route::post('/category/insert',[CategoryController::class,'insert'])->name('category.insert');
Route::post('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
Route::post('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::post('/category/status_change/{id}',[CategoryController::class,'status_change'])->name('category.status.change');

// tag route
Route::get('/tag',[TagController::class,'index'])->name('tag');
Route::post('/tag/insert',[TagController::class,'insert'])->name('tag.insert');
Route::post('/tag/delete/{id}',[TagController::class,'delete'])->name('tag.delete');
Route::post('/tag/edit/{id}',[TagController::class,'edit'])->name('tag.edit');
Route::post('/tag/status_change/{id}',[TagController::class,'status_change'])->name('tag.status.change');
Route::post('/tag/restore/{id}',[TagController::class,'restore'])->name('tag.restore');
Route::post('/tag/forced_delete/{id}',[TagController::class,'forced_delete'])->name('tag.forced.delete');

// blog route
Route::get('/blog',[BlogController::class,'index'])->name('blog');
Route::get('/blog/create',[BlogController::class,'view_create'])->name('blog.view.create');
Route::post('/blog/create/post',[BlogController::class,'create'])->name('blog.create');


