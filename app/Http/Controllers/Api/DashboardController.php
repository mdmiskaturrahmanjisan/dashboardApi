<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Banner;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_categories'     => Category::count(),
            'total_sub_categories' => SubCategory::count(),
            'total_banners'        => Banner::count(),
            'total_services'       => Service::count(),
            'total_service_amount' => Service::sum('price'),

            // optional
            'total_users'          => User::count(),
        ]);
    }
}
