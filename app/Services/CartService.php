<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Http\Controllers\TwilioService;
use App\Models\Cart;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Fluent;
use File;

class CartService
{
    protected $cartModel;
    protected $helper;
    protected $subCategoryService;

    public function __construct()
    {
        $this->cartModel = new Cart();
        $this->helper = new Helper();
        $this->subCategoryService = new SubCategoryService();
    }

    public function list()
    {
        return $this->cartModel->where([
            'user_id' => auth()->user()->id,
            'request_id' => null
        ])->get()
                ?->toArray();
    }

    public function addToCart(array $data = [])
    {
        $cart = Cart::where([
            'request_id' => null,
            'sub_categories_id' => $data['sub_category_id'],
            'user_id' => auth()->user()->id
        ])->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = auth()->user()->id;
            $cart->categories_id = $data['category_id'];
            $cart->sub_categories_id = $data['sub_category_id'];
            $cart->type_id = $data['type_id'];

            $message = "Added to the cart";
        }

        if (!@$data['is_dry_cleaning'] && !@$data['is_iron'] && !@$data['is_washing']) {
            return Helper::fail("Any service from dry cleaning, iron, washing must be selected");
        }

        if ((integer) $data['quantity'] > 0) {
            $subCategory = $this->subCategoryService->subCategory($data['sub_category_id']);

            $cart->quantity = $data['quantity'];

            if (@$data['is_dry_cleaning']) {
                $cart->dry_cleaning_price = $subCategory['dry_cleaning_price'];
            } else {
                $cart->dry_cleaning_price = 0;
            }

            if (@$data['is_iron']) {
                $cart->iron_price = $subCategory['iron_price'];
            } else {
                $cart->iron_price = 0;
            }

            if (@$data['is_washing']) {
                $cart->washing_price = $subCategory['washing_price'];
            } else {
                $cart->washing_price = 0;
            }

            $cart->save();

            return Helper::success($message ?? "Cart updated");
        } else {
            return Helper::fail("Quantity must be greater than zero");
        }
    }

    public function removeFromCart(int $id = null)
    {
        $cart = $this->cartModel->find($id);

        if (!$cart) {
            return Helper::fail("Invalid request");
        }

        $cart->delete();

        return Helper::success("Removed from cart");
    }
}