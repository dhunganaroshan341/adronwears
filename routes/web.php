<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainFrontendController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [MainFrontendController::class, 'index'])->name('index');
Route::get('/about', [MainFrontendController::class, 'about'])->name('about');
Route::get('/shop', [MainFrontendController::class, 'shop'])->name('shop.index');
Route::get('/shop/categories', [MainFrontendController::class, 'shopByCategory'])->name('shop.categories');
Route::get('/shop/categories/{category:slug}', [MainFrontendController::class, 'shopByCategory'])->name('shop.category');

Route::get('/shop/product/{product:slug}', [MainFrontendController::class, 'ProductDetail'])->name('shop.product');

// require __DIR__ . '/auth.php';
// Contact routes
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
