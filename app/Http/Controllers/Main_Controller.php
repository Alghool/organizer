<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use App\Task;

class Main_Controller extends Controller
{
    //

    function homePage(){
//        return phpinfo();
        $data['active'] = 0;
        $data['groups'] = Group::all();
        $data['tasks'] = Task::all();
        return view('homepage', $data);
    }
}
