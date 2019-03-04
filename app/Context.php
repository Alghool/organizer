<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Context extends Model
{

    public function setSmartContext($value){
        $contexts = explode('/', $value);
        $lastContext = 0;
        foreach ($contexts as $context){
            $contextName = str_replace(' ', '/' ,$context);
            $inDB = Context::where('title', $contextName)->where('context_id', $lastContext)->get();

            if(count($inDB)){
                $lastContext = $inDB->id;
            }else{
                $newContext = new Context;
                $newContext->title = $context;
                $newContext->context_id = $lastContext->id;
                $newContext->save();
                $lastContext = $newContext->id;
            }
        }
        return $lastContext;
    }

    public function parent(){
        return $this->belongsTo('App\context');
    }

    public function child(){
        return $this->hasOne('App\context');
    }

    public function groups(){
        return $this->morphedByMany('App\group', 'contextable');
    }

    public function tasks(){
        return $this->morphedByMany('App\task', 'contextable');
    }
}
