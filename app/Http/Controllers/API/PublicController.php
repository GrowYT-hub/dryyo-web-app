<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\AddCartRequest;
use App\Http\Requests\API\User\RemoveCartRequest;
use App\Http\Requests\StoreLaundryRequest;
use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\SubCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected $categoryService;
    protected $subCategoryService;
    protected $cartService;
    function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->subCategoryService = new SubCategoryService();
        $this->cartService = new CartService();
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
            "status" => 1,
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
    public function subCategories(Request $request): ?JsonResponse
    {
        $category_id = $request->category_id ?? null;
        $subCategories = $this->subCategoryService->list($category_id);

        return response()->json([
            "status" => 1,
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
        $cart = $this->cartService->list();

        return Helper::success('Cart List', ['cart' => $cart]);
    }

    public function addToCart(AddCartRequest $request)
    {
        return $this->cartService->addToCart($request->all());
    }

    public function removeFromCart(RemoveCartRequest $request)
    {
        return $this->cartService->removeFromCart($request->cart_id);
    }
}
