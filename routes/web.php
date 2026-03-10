<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [MainFrontendController::class, 'index'])->name('index');
Route::get('/about', [MainFrontendController::class, 'about'])->name('about');
Route::get('/contact-us', [MainFrontendController::class, 'contact'])->name('contact');
Route::get('/shop', [MainFrontendController::class, 'shop'])->name('shop');
Route::get('/shop-single', [MainFrontendController::class, 'productDetail'])->name('shop.single');

// require __DIR__ . '/auth.php';
