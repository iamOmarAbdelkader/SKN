<?php
namespace App\Repositories;

use App\Models\Item;

class ItemsRepository implements  ItemsRepositoryInterface{

    
    /**
     * create the item by the id .
     *
     * @param  array  $data
     * @return  \App\Models\Item $item
     */
    public function create($data)
    {
       return Item::create($data);
    }

    /**
     * get the item by the id .
     *
     * @param  int  $id
     * @return  \App\Models\Item $item
     */
    public function findById($id)
    {
        return Item::find($id);
    }

    /**
     * delete the item by the id .
     *
     * @param  int  $id
     * @return  boolean
     */
    public function delete($id)
    {
        $item = $this->findById($id);
        if($item){
            return $item->delete();
        }
        return false;
    }

    
}