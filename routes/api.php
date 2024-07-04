<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductVariationController;



Route::resource('users', UserController::class);
Route::resource('addresses', AddressController::class);
Route::resource('banners', BannerController::class);
Route::resource('shops', ShopController::class);
Route::resource('categories', CategoryController::class);
Route::resource('product-images', ProductImageController::class);
Route::resource('products', ProductController::class);
Route::resource('followings', FollowingController::class);
Route::resource('attributes', AttributeController::class);
Route::resource('orders', OrderController::class);
Route::resource('order-items', OrderItemController::class);
Route::resource('product-variations', ProductVariationController::class);
