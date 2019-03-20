<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Context extends Category
{

    public static function setSmartContext($value){
        $multipleContexts = explode(':', $value);
        $result = array();
        foreach ($multipleContexts as $value){
            $contexts = explode('/', $value);
            $lastContext = collect();
            $lastContext->id = 0;
            foreach ($contexts as $context){
                $contextName = str_replace('_', ' ' ,$context);
                $inDB = Context::where('title', $contextName)->where('context_id', $lastContext->id)->first();

                if(count($inDB)){
                    $lastContext = $inDB;
                }else{
                    $newContext = new Context;
                    $newContext->title = $contextName;
                    $newContext->context_id = $lastContext->id;
                    $newContext->save();
                    $lastContext = $newContext;
                }
            }
            $result[] = $lastContext;
        }
        return $result;
    }

    public function parent(){
        return $this->belongsTo('App\context');
    }

    public function children(){
        return $this->hasOne('App\context');
    }

    public function familyRoot(){
        $parent = $this->belongsTo('App\context', 'context_id');
        $parent->with('familyRoot');
        return $parent;
    }

    public function myFamily(){
        $children = $this->hasMany('App\context', 'context_id');
        $children->with('myFamily');
        return $children;
    }

    public function groups(){
        return $this->morphedByMany('App\group', 'contextable');
    }

    public function tasks(){
        return $this->morphedByMany('App\task', 'contextable');
    }
}
