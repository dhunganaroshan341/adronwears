<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainFrontendController;
use App\Http\Controllers\Order\ShippingRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecaptchaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

Route::get('/', [MainFrontendController::class, 'index'])
    ->name('index');

Route::get('/about', [MainFrontendController::class, 'about'])
    ->name('about');

Route::get('/shop', [MainFrontendController::class, 'shop'])
    ->name('shop.index');

Route::get('/shop/categories', [MainFrontendController::class, 'shopByCategory'])
    ->name('shop.categories');

Route::get('/shop/categories/{category:slug}', [MainFrontendController::class, 'shopByCategory'])
    ->name('shop.category');

Route::get('/shop/product/{product:slug}', [MainFrontendController::class, 'ProductDetail'])
    ->name('shop.product');


/*
|--------------------------------------------------------------------------
| Contact
|--------------------------------------------------------------------------
*/

Route::get('/contact-us', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])
    ->middleware('throttle:contact')
    ->name('contact.submit');


/*
|--------------------------------------------------------------------------
| WhatsApp / Shipping Requests
|--------------------------------------------------------------------------
|
| Both endpoints intentionally use the same controller action.
|
*/

Route::post('/whatsapp-order', [ShippingRequestController::class, 'store'])
    ->middleware('throttle:shipping-requests')
    ->name('order.whatsapp');

Route::post('/shipping-requests', [ShippingRequestController::class, 'store'])
    ->middleware('throttle:shipping-requests')
    ->name('shipping-requests.store');


/*
|--------------------------------------------------------------------------
| reCAPTCHA
|--------------------------------------------------------------------------
*/

Route::post('/recaptcha/verify', [RecaptchaController::class, 'verify'])
    ->middleware('throttle:recaptcha');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// require __DIR__ . '/auth.php';
