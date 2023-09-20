<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPaymentRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\Services;
use App\Models\Types;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Services::where('status','Completed')->get();
        return view('invoice.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrderRequest $request)
    {
        $cartData = $request->data;
        $request_id = $request->request_id;
        $services = Services::find($request_id);
        if (!$services){
            return response()->json([
                'status'=> false,
                'message'=> 'Invalid Service Request ID'
            ],422);
        }
        $totalAmount = 0;
        $totalQuantity = 0;
        foreach ($cartData as $cartDatum) {
            $quantity = (integer)$cartDatum['quantity'];
            $washing_price = (integer)isset($cartDatum['washing_price'])?$cartDatum['washing_price']:0;
            $iron_price = (integer)isset($cartDatum['iron_price'])?$cartDatum['iron_price']:0;
            $dry_cleaning_price = (integer)isset($cartDatum['dry_cleaning_price'])?$cartDatum['dry_cleaning_price']:0;
            $total = ($washing_price + $iron_price + $dry_cleaning_price) * $quantity;
            $totalAmount += $total;
            $totalQuantity += $quantity;
            $orders = Order::where('cart_id',$cartDatum['cart_id'])->first();
            if (!$orders){
                $orders = new Order();
                $orders->cart_id = $cartDatum['cart_id'];
            }
            $orders->request_id = $request_id;
            $orders->quantity = $quantity;
            $orders->washing_price = $washing_price;
            $orders->iron_price = $iron_price;
            $orders->dry_cleaning_price = $dry_cleaning_price;
            $orders->total = $total;
            $orders->save();
        }
        $services->quantity = $totalQuantity;
        $services->amount = $totalAmount;
        $services->status = 'Confirm';
        if ($services->save()){
            return response()->json([
                'status'=> true,
                'message'=> 'Order Created Successfully',
                'data'=> $services
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
            $orders = Order::where(['request_id'=>$id])->get();
            $request_id = $id;
            return view('captain.cart', compact('services','carts','request_id','orders'));
        }
        return redirect()->back()->with('error','Invalid Request ID');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $invoice = Services::with(['user','assign','carts'])->find($id);
        if ($invoice){
            return view('invoice.detail',compact('invoice'));
        }
        return redirect()->back()->with('error','Invalid Request ID');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\JsonResponse
     */
    public function payment(OrderPaymentRequest $request)
    {
        $services = Services::find($request->request_id);
        if ($services){
            $services->status = 'Completed';
            $services->save();
            return response()->json([
                'status'=> true,
                'message'=> 'Order Completed Successfully',
                'data'=> $services
            ],200);
        }
        return response()->json([
            'status'=> false,
            'message'=> 'Something Went Wrong!'
        ],422);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function reports()
    {
        $totalOrders = Services::selectRaw('MONTH(created_at) as month, DATE_FORMAT(created_at, "%b") as month_name, COUNT(*) as total')
            ->where('status', 'Completed')
            ->groupBy('month', 'month_name')
            ->get();
        $totalSalesOrders = Services::selectRaw('MONTH(created_at) as month, DATE_FORMAT(created_at, "%b") as month_name, COUNT(*) as total')
            ->groupBy('month', 'month_name')
            ->orderBy('month', 'ASC')
            ->get();
        $labels = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $orders = [];
        $totalSales = [];
        foreach ($labels as $label) {
            $exists = $totalOrders->where('month_name',$label)->pluck('total')->toArray();
            if ($exists){
                $orders[$label] = count($exists) > 0? $exists[0]:0;
            }else{
                $orders[$label] = 0;
            }
            $salesExists = $totalSalesOrders->where('month_name',$label)->pluck('total')->toArray();

            if ($salesExists){
                $totalSales[$label] = count($salesExists) > 0? $salesExists[0]:0;
            }else{
                $totalSales[$label] = 0;
            }
        }
        return view('reports.index',compact('orders','totalSales'));
    }
}
