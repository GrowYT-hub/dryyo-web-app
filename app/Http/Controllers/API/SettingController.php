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
            "status" => 1,
            "data" => $types
        ], 200);
    }

    public function subCategories()
    {
        $categories = $this->SettingService->subCategories()?->toArray() ?? [];

        return response()->json([
            "status" => 1,
            "data" => $categories
        ], 200);
    }
}
