<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\View\View;
use App\Group;
use App\Context;

class Layout_Controller extends Controller
{

    public function mainList(View $view){
        $mainGroups = Group::where('group_id', 0)->get();
        $data['groups'] = collect();
        foreach ($mainGroups as $group){
            $group->childrenList($data['groups']);
        }
        $data['contexts'] = Context::all();
        $view->with($data);
    }
}
