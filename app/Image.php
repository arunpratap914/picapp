<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
