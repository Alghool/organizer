<?php

namespace App\Http\Controllers;

use App\Context;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use App\Task;

class Main_Controller extends Controller
{
    //

    function homePage(){
//        return phpinfo();
        $data['active'] = 2;
        $data['tasks'] = Task::all();
        return view('homepage', $data);
    }
}
