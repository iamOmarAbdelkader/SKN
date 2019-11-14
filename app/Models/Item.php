<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Storage;
use File;
class Item extends Model
{
    //
    protected $fillable = ['name','price','user_id','phone',
    'available_from','available_to'];
    
    protected $dates = ['available_from','available_to'];

    protected static function boot() {
        parent::boot();
        static::deleting(function(Item $item) {
            \Log::info('in deleting item');
            foreach ($item->images as $image)
            {
                \Log::info(Storage::delete($image->attributes['location'])); 
                \Log::info($image->attributes['location']);
            }
        });
    }

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
