<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategorieController;

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

Route::get('/confidentialite', [PolicyController::class, 'confidentialite'])->name('confidentialite');


// Routes for cart
Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::get('/remove_form_session/{productId}', [CartController::class, 'deleteProduct'])->name('remove_form_session');
Route::get('/clearCart', [CartController::class, 'clearCart'])->name('clearCart');

Route::get('/basket', [CartController::class, 'addToBasket'])->name('basket'); //add
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/product-details', [PageController::class, 'productDetails'])->name('product-details');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');




Route::get('/index', [PageController::class, 'index'])->name('home');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');


// Route::resource('user', PageController::class);

//Auth routes

Route::group(['prefix' => '/'], function () {
    Route::get('register', [PageController::class, 'register'])->name('register');
    Route::get('login', [PageController::class, 'login'])->name('login');
    Route::post('register', [UserController::class, 'register'])->name('register');
    Route::post('login', [UserController::class, 'login'])->name('login')->middleware('guest');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
    });
});

//Protected routes

Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
});

// ***************************start Categorie routes******************************************

//Public route
// Route::resource('cat', CategorieController::class);
// Route::get('/categories', [CategorieController::class, 'index']);
Route::get('/categories/{id}', [CategorieController::class, 'show']);
Route::get('/categories/search/{name}', [CategorieController::class, 'search']);

// Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search'])->name('search');

//Protected routes
Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {

    // CATEGORIES
    Route::get('/categories/{id}', [CategorieController::class, 'edit']);
    Route::post('/categories', [CategorieController::class, 'store']);
    Route::put('/categories/{id}', [CategorieController::class, 'update']);
    Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);


    // PRODUCTS
    Route::get('/products/{id}', [ProductController::class, 'edit']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});
