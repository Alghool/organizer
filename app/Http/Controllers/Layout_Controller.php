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
        $data['groups'] = Group::all();
        $data['contexts'] = Context::all();
        $view->with($data);
    }
}
