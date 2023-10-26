<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\SettingService;

class SettingController extends Controller
{
    protected $SettingService;
    function __construct()
    {
        $this->SettingService = new SettingService();
    }

    public function types()
    {
        $types = $this->SettingService->types()?->toArray() ?? [];

        return response()->json([
            "status" => true,
            "data" => $types
        ], 200);
    }

    public function categories()
    {
        $categories = $this->SettingService->categories()?->toArray() ?? [];

        return response()->json([
            "status" => true,
            "data" => $categories
        ], 200);
    }

    public function subCategories()
    {
        $categories = $this->SettingService->subCategories()?->toArray() ?? [];

        return response()->json([
            "status" => true,
            "data" => $categories
        ], 200);
    }
}
