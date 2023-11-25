<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaundryRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    /**
     * Category list function
     *
     * @return JsonResponse
     */
    public function index(): ?JsonResponse
    {
        $categories = $this->categoryService->list();

        return response()->json([
            "status" => 1,
            "data" => $categories
        ], 200);
    }

    public function store(StoreLaundryRequest $request): ?JsonResponse
    {
        $res = $this->categoryService->store($request->all());

        if ($res) {
            return response()->json([
                'status' => 1,
                'message' => 'New Category Added Successfully'
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Something Went Wrong!'
        ], 422);
    }
}
