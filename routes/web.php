<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TagController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PhotoController::class)->middleware(['auth'])->group(function(){
	//Route::get('/', 'home')->name('home');
	Route::post('/posts', 'store')->name('store'); //投稿保存処理
	Route::get('/posts/create', 'create')->name('create'); //投稿画面
	Route::get('/posts/home', 'home')->name('home'); //投稿画面
	Route::get('/posts/{photo}', 'show')->name('show');
	//Route::put('/posts/{photo}', 'update')->name('update');//付ける予定あんまなし
	//Route::delete('/posts/{photo}', 'delete')->name('delete'); //後で付ける
	//Route::get('/posts/{photo}/edit', 'edit')->name('edit');//付ける予定あんまなし
});

Route::get('/tags/{tag}', [TagController::class,'index'])->middleware("auth");

require __DIR__.'/auth.php';
