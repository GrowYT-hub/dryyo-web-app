<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Services;
use App\Models\Types;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCartRequest $request)
    {
        $subCategories = json_decode($request->subCategories);
        $cart = Cart::where(['request_id'=>$request->request_id,'sub_categories_id'=>$subCategories->id])->first();
        if (!$cart){
            $cart = new Cart();
        }
        $cart->user_id = Auth::user()->id;
        $cart->request_id = $request->request_id;
        $cart->categories_id = $request->categories_id;
        $cart->sub_categories_id = $subCategories->id;
        $cart->type_id = $request->type_id;
        $cart->quantity = $request->quantity;
        $cart->dry_cleaning_price = $subCategories->dry_cleaning_price;
        $cart->iron_price = $subCategories->iron_price;
        $cart->washing_price = $subCategories->washing_price;
        if ($cart->save()){
            return response()->json([
                'status'=> true,
                'message'=> 'Cart Add or Updated Successfully',
                'data'=> $cart
            ],200);
        }
        return response()->json([
            'status'=> false,
            'message'=> 'Something Went Wrong!'
        ],422);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $services = Services::find($id);
        if ($services){
            $carts = Types::with('categories')->get();
            $orders = Cart::where(['request_id'=>$id])->get();
            $request_id = $id;
            if ($services->status === "Pending"){
                $services->status = 'Processing';
                $services->save();
            }
            return view('captain.cart', compact('services','carts','request_id','orders'));
        }
        return redirect()->back()->with('error','Invalid Request ID');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $carts = Cart::with(['types','categories','subCategories'])->where(['request_id'=>$id])->get();
        if ($carts){
            return response()->json([
                'status'=> true,
                'message'=> 'Get cart list',
                'data'=> $carts
            ],200);
        }
        return response()->json([
            'status'=> false,
            'message'=> 'Something Went Wrong!'
        ],422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
