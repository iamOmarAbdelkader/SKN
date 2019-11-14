<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Item as ItemResource;
use App\Repositories\ItemsRepositoryInterface;
use App\Repositories\ImagesRepositoryInterface;
use DB;

class ItemController extends Controller
{

    private $itemsRepo;
    private $imagesRepo;

    public function __construct(ItemsRepositoryInterface $itemsRepository ,
                                ImagesRepositoryInterface $imagesRepository )
    {
        $this->itemsRepo  =     $itemsRepository;
        $this->imagesRepo =     $imagesRepository;

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // to ensure that all data saved together
        DB::beginTransaction();
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails())
            return response()->json(['errors'=>$validator->errors()]);
        
        // create the item
        $item = $this->itemsRepo->create($request->except('images'));
        // add item`s images
        $this->imagesRepo->createMany($request->images , $item);

        DB::commit();
        return response()->json(['msg'=>'new item added successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get the item
        $item = $this->itemsRepo->findById($id);
        // check if item is found
        if(!$item)
            return response()->json([
                'msg'=>'item not found'
            ],404);
        // return the item as in the template of item resource
        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find the item by id
        $item = $this->itemsRepo->findById($id);
        // check if the is found
        if(!$item)
            return response()->json([
                'msg'=>'item not found'
            ],404);
        // delete the item
        $this->itemsRepo->delete($id);
        // return the response with msg specified 
        return response()->json(['msg'=>'item deleted successfully']);
    }

    /**
     * rules of the item validation.
     * 
     * @return Array
     */
    private function rules()
    {
        return [
            'user_id'       =>'required',
            'name'          =>'required|string|min:4',
            'price'         =>'required|numeric',
            'available_from' =>"required|date|before:available_to",
            'available_to'   =>"required|date|after:available_from",
            'phone'         =>'required|numeric|min:11|regex:/(0)([0-9]{10})/',
            'images'        =>'required|array|max:4',
            'images.*'      =>'required|mimes:jpg,jpeg,png,bmp|max:2000000,'
        ];
    }
}
