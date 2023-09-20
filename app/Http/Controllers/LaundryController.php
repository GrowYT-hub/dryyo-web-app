<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaundryRequest;
use App\Http\Requests\UpdateLaundryRequest;
use App\Models\Laundry;
use App\Models\Types;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laundry = Laundry::with('types')->orderBy('id','desc')->get();
        $types = Types::all();
        return view('laundry.index', compact('laundry','types'));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLaundryRequest $request)
    {
        $laudry = new Laundry();
        $laudry->name = $request->name;
        $laudry->type_id = $request->type_id;
        if ($laudry->save()){
            return response()->json([
                'status'=> true,
                'message'=> 'New Category Added Successfully',
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Laundry $laundry, $id)
    {
        $laundry = Laundry::with('types')->find($id);
        return response()->json([
            'status'=> true,
            'message'=> 'Get The Laundry detail',
            'data'=> $laundry
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaundryRequest  $request
     * @param  \App\Models\Laundry  $laundry
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateLaundryRequest $request)
    {
        $laundry = Laundry::with('types')->find($request->input('category_id'));
        if ($laundry){
            $laundry->name = $request->name;
            $laundry->type_id = $request->type_id;
            $laundry->save();
            return response()->json([
                'status'=> true,
                'message'=> 'Update the Laundry detail',
                'data'=> $laundry
            ],200);
        }
        return response()->json([
            'status'=> true,
            'message'=> 'Something Went Wrong!',
            'data'=> $laundry
        ],422);
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
