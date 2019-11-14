<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;
class Image extends Model
{
    //
    protected $fillable = ['location'];
    public function setLocationAttribute($file)
    {
        if(isset($this->attributes['location']))
        {
         Storage::delete($this->attributes['location']);            
        }
        $path = $file->store('public/clients');
        $this->attributes['location'] =$path;
    }

    public function getLocationAttribute()
    {
        if($this->attributes['location'])
        {
            $src = asset(Storage::url($this->attributes['location']));
        }
        else
        {
            $src = asset(Storage::url('default/default.jpg'));
        }
        return $src;
    }
}
