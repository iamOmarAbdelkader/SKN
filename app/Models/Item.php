<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = ['name','price','user_id','phone',
    'available_from','available_to'];
    
    protected $dates = ['available_from','available_to'];

    /**
     * Get the images for the item.
     */
    public function images()
    {
        return $this->hasMany('App\Models\Image','item_id');
    }

     /**
     * Get the owner of the item .
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
