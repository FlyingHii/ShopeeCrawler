<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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

Route::controller(CartController::class)->group(function (){
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart', [CartController::class, 'addProductToCart'])->name('cart.post');
})->middleware('auth');

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('registerPost');

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'list')->name('products.list');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
