<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{

    public function parent(){
        return $this->hasOne('App\context');
    }

    public function groups(){
        return $this->morphedByMany('App\group', 'contextable');
    }

    public function tasks(){
        return $this->morphedByMany('App\task', 'contextable');
    }
}
