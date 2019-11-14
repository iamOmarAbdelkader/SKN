<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Item as ItemResource;
class ItemController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'       =>'required',
            'name'          =>'required|string|min:4',
            'price'         =>'required|numeric',
            'available_from' =>"required|date|before:available_to",
            'available_to'   =>"required|date|after:available_from",
            'phone'         =>'required|numeric|min:11|regex:/(0)([0-9]{10})/',
            'images'        =>'required|array|max:4',
            'images.*'      =>'required|mimes:jpg,jpeg,png,bmp|max:2000000,'
        ]);

        if ($validator->fails())
            return response()->json(['errors'=>$validator->errors()]);
        
        // create the item
        $item = Item::create($request->except('images'));
        foreach($request->images as $image){
            $item->images()->create(['location'=>$image]);
        }

        return response()->json(['msg'=>'new item added successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
        return new ItemResource($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
