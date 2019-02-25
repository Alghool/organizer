<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

    public function tasks(){
       return $this->hasMany('App\task');
    }

    public function parent(){
        return $this->hasOne('App/group');
    }

    public function contexts(){
        return $this->morphToMany('App\context', 'contextable');
    }
}
