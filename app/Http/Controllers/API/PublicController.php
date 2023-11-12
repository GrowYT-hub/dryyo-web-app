<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaundryRequest;
use App\Services\CategoryService;
use App\Services\SubCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected $categoryService;
    protected $subCategoryService;
    function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->subCategoryService = new SubCategoryService();
    }

    /**
     * Category list function
     *
     * @return JsonResponse
     */
    public function categories(): ?JsonResponse
    {
        $categories = $this->categoryService->list();

        return response()->json([
            "success" => true,
            "data" => [
                "categories" => $categories
            ]
        ], 200);
    }

    /**
     * Sub category list function
     *
     * @return JsonResponse
     */
    public function subCategories(): ?JsonResponse
    {
        $subCategories = $this->subCategoryService->list();

        return response()->json([
            "success" => true,
            "data" => [
                "sub_categories" => $subCategories
            ]
        ], 200);
    }

    /**
     * Cart function
     *
     * @return JsonResponse
     */
    public function cart(): ?JsonResponse
    {
        $subCategories = $this->subCategoryService->list();

        return response()->json([
            "success" => true,
            "data" => [
                "sub_categories" => $subCategories
            ]
        ], 200);
    }
}
