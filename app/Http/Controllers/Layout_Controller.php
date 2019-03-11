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
        $mainGroups = Group::with('myFamily')->where('group_id', 0)->get();
        $data['groups'] = collect();
        foreach ($mainGroups as $group){
            $group->childrenList($data['groups']);
        }

        $maincontexts = Context::with('myFamily')->where('context_id', 0)->get();
        $data['contexts'] = collect();
        foreach ($maincontexts as $context){
            $context->childrenList($data['contexts']);
        }
        $view->with($data);
    }
}
