<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Products\AllergenController;
use App\Http\Controllers\Products\CategoryController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Users\AddressController;
use App\Http\Controllers\Users\PostController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class, 'login']);

// Rutas API - Autenticación | User.
Route::group([
    'middleware' => ['auth:api']
], function() {
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('refresh-token', [AuthController::class,'refreshToken']);
    Route::get('logout', [AuthController::class, 'logout']);

    Route::post('/products/{id}/like', [ProductController::class, 'like']);
    Route::post('/products/{id}/unlike', [ProductController::class, 'unlike']);
    Route::get('/products/{id}/liked', [ProductController::class, 'isLiked']);
});

Route::apiResource('users', UserController::class);
Route::apiResource('address', AddressController::class);
Route::apiResource('posts', PostController::class);

// Rutas API - Productos.
Route::apiResource('allergens', AllergenController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);

// Rutas API - Contacto.
Route::post('mail', [ContactController::class, 'send']);
