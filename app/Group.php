<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public function images()
    {
        return $this->belongsToMany('App\Image');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
