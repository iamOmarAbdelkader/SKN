<?php
namespace App\Repositories;

use App\Models\Item;


class ImagesRepository implements ImagesRepositoryInterface{

    /**
     * create images .
     *
     * @param  array  $images
     * @param  \App\Models\Item $item
     * @return boolean
     */
    public function createMany($images , $item)
    {
        foreach($images as $image){
            $item->images()->create(['location'=>$image]);
        }
        return true;
    }
}