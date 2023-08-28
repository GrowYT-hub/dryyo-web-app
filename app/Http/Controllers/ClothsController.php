<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClothsRequest;
use App\Http\Requests\UpdateClothsRequest;
use App\Models\Cloths;

class ClothsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laundry = Cloths::get();
        return view('cloths.index',compact('laundry'));
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
     * @param  \App\Http\Requests\StoreClothsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClothsRequest $request)
    {
        $cloths = new Cloths();
        $cloths->name = $request->name;
        $cloths->price = $request->price;
        if ($cloths->save()){
            return response()->json([
                'status'=> true,
                'message'=> 'New Cloths Added Successfully',
                'data'=> $cloths
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
     * @param  \App\Models\Cloths  $cloths
     * @return \Illuminate\Http\Response
     */
    public function show(Cloths $cloths)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cloths  $cloths
     * @return \Illuminate\Http\Response
     */
    public function edit(Cloths $cloths)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClothsRequest  $request
     * @param  \App\Models\Cloths  $cloths
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClothsRequest $request, Cloths $cloths)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cloths  $cloths
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cloths $cloths)
    {
        if ($cloths){
            $cloths->delete();

        }
        return redirect()->route(   'cloths.index')->with('success', 'Cloth deleted successfully.');
    }
}
