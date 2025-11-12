<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    BannerController,
    CategoryController,
    CouponController,
    ServiceController,
    MediaController,
    SubCategoryController,
    PublicController
};

// Public endpoint
Route::get('/data', [PublicController::class, 'index']);

// CRUD endpoints
Route::apiResource('banners', BannerController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('coupons', CouponController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('media', MediaController::class);

// Subcategory nested route
Route::get('/categories/{parentId}/subcategories', [SubCategoryController::class, 'index']);
Route::post('/categories/{parentId}/subcategories', [SubCategoryController::class, 'store']);

