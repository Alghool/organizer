<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

    public function tasks(){
       return $this->hasMany('App\task');
    }
}
