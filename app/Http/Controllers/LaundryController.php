<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaundryRequest;
use App\Http\Requests\UpdateLaundryRequest;
use App\Models\Laundry;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laundry = Laundry::all();
        return view('laundry.index', compact('laundry'));
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
     * @param  \App\Http\Requests\StoreLaundryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaundryRequest $request)
    {
        $laudry = new Laundry();
        $laudry->name = $request->name;
        $laudry->price = $request->price;
        if ($laudry->save()){
            return response()->json([
                'status'=> true,
                'message'=> 'New Laudry Added Successfully',
                'data'=> $laudry
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
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function show(Laundry $laundry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function edit(Laundry $laundry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaundryRequest  $request
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaundryRequest $request, Laundry $laundry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laundry $laundry)
    {
        $laundry->delete();

        return redirect()->route(   'laundry.index')->with('success', 'Laundry deleted successfully.');
    }
}
