<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UserScopeTrait;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected $appends = ['show_lvl' => 0];
    use UserScopeTrait;

    public function __construct(array $attributes = array())
    {
        if(Auth::user()){
            $this->user_id = Auth::id();
        }
        parent::__construct($attributes);
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

    public function user(){
        return $this->belongsTo('App\user');
    }

}
