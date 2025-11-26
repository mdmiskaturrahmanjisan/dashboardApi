<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    BannerController,
    CategoryController,
    CouponController,
    ServiceController,
    MediaController,
    SubCategoryController,
    PublicController,
    DashboardController,
    AssignmentController,
};

// Public endpoint
Route::get('/data', [PublicController::class, 'index']);

Route::apiResource('banners', BannerController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('coupons', CouponController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('sub-categories', SubCategoryController::class);
Route::get('/media', [MediaController::class, 'index']);
Route::post('/media', [MediaController::class, 'store']);
Route::post('/media/attach', [MediaController::class, 'attach']);
Route::post('/media/detach', [MediaController::class, 'detach']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/assign-customers', [AssignmentController::class, 'assign']);





