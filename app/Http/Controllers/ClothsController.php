<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClothsRequest;
use App\Http\Requests\UpdateClothsRequest;
use App\Models\Cloths;
use App\Models\Laundry;

class ClothsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $laundry = Cloths::with('categories')->orderBy('id','desc')->get();
        $categories = Laundry::all();
        return view('cloths.index',compact('laundry','categories'));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreClothsRequest $request)
    {
        $cloths = new Cloths();
        $cloths->name = $request->name;
        $cloths->category_id = $request->category_id;
        $cloths->washing_price = $request->washing_price;
        $cloths->iron_price = $request->iron_price;
        $cloths->dry_cleaning_price = $request->dry_cleaning_price;
        if ($cloths->save()){
            return response()->json([
                'status'=> true,
                'message'=> 'New Sub Category Added Successfully',
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Cloths $cloths, $id)
    {
        $cloths = Cloths::with('categories')->find($id);
        return response()->json([
            'status'=> true,
            'message'=> 'Get The Cloth detail',
            'data'=> $cloths
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClothsRequest  $request
     * @param  \App\Models\Cloths  $cloths
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateClothsRequest $request, $id)
    {
        $cloths = Cloths::with('categories')->find($id);
        if ($cloths){
            $cloths->name = $request->name;
            $cloths->category_id = $request->category_id;
            $cloths->washing_price = $request->washing_price;
            $cloths->iron_price = $request->iron_price;
            $cloths->dry_cleaning_price = $request->dry_cleaning_price;
            $cloths->save();
            return response()->json([
                'status'=> true,
                'message'=> 'Update the Sub Category detail',
                'data'=> $cloths
            ],200);
        }
        return response()->json([
            'status'=> true,
            'message'=> 'Something Went Wrong!',
            'data'=> $cloths
        ],422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cloths = Cloths::find($id);
        if ($cloths){
            $cloths->delete();
        }
        return redirect()->route(   'sub-category.index')->with('success', 'Cloth deleted successfully.');
    }
}
