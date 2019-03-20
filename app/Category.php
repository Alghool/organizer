<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $appends = ['show_lvl' => 0];

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



}
