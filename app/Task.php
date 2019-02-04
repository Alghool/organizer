<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

    public function group(){
        $this->hasOne('app/group');
    }
}
