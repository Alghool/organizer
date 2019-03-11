<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $appends = ['show_lvl'=>0];

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


    public function getRootAttribute(){
        $currentObj = $this;
        $root = array();
        $root[] = $currentObj->title;
        $currentObj = $currentObj->familyRoot;
        while($currentObj){
            $root[] = $currentObj->title;
            $currentObj = $currentObj->familyRoot;
        }
        $root = implode('\\',array_reverse($root));

        return $root;
    }

    function childrenList(&$list, $parent = null){
        $parent = ($parent)? $parent : $this;
        $list->push($parent);
        $children = $parent->myFamily;
        foreach ($children as $child){
            $child->show_lvl = $parent->show_lvl + 1;
            $this->childrenList($list,$child );
        }
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
