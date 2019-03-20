<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Category
{

    public static function setSmartGroup($value){
        $groups = explode('/', $value);
        $lastGroup = collect();
        $lastGroup->id = 0;
        foreach ($groups as $group){
            $groupName = str_replace('_', ' ' ,$group);
            $inDB = Group::where('title', $groupName)->where('group_id', $lastGroup->id)->first();

            if(count($inDB)){
                $lastGroup = $inDB;
            }else{
                $newGroup = new Group;
                $newGroup->title = $groupName;
                $newGroup->group_id = $lastGroup->id;
                $newGroup->save();
                $lastGroup = $newGroup;
            }
        }
        return $lastGroup;
    }






    public function tasks(){
       return $this->hasMany('App\task');
    }

    public function parent(){
        return $this->belongsTo('App\group', 'group_id');
    }

    public function children(){
        return $this->hasMany('App\group');
    }

    public function familyRoot(){
        $parent = $this->belongsTo('App\group', 'group_id');
        $parent->with('familyRoot');
        return $parent;
    }

    public function myFamily(){
        $children = $this->hasMany('App\group', 'group_id');
        $children->with('myFamily');
        return $children;
    }

    public function contexts(){
        return $this->morphToMany('App\context', 'contextable');
    }
}
