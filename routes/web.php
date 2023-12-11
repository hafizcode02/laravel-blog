<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

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

Route::get('/larapage', function () {
    return view('welcome');
});

Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('category/{slug}', [WebsiteController::class, 'category'])->name('category');
Route::get('post/{slug}', [WebsiteController::class, 'post'])->name('post');
Route::get('page/{slug}', [WebsiteController::class, 'page'])->name('page');
Route::get('contact', [WebsiteController::class, 'showContactForm'])->name('contact.show');
Route::post('contact', [WebsiteController::class, 'submitContactForm'])->name('contact.submit');

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    Route::middleware(['auth'])->group(function () {
        Route::get('home', [HomeController::class, 'index']);
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('pages', PageController::class);
        Route::resource('galeries', GaleryController::class);
    });
});
