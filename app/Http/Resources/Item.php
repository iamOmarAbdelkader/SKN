<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Item extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'item name' => $this->name,
            'item owner' => $this->user->name,
            'price' => $this->price,
            'available from' => $this->available_from,
            'available to' => $this->available_to,
            'phone number'=>$this->phone,
            'images'=>$this->images()->pluck('location')
        ];
    }
}
