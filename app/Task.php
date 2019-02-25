<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function group(){
        return $this->hasOne('app/group');
    }

    public function contexts(){
        return $this->morphToMany('App\context', 'contextable');
    }
}
