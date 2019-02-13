<?php

namespace App\Http\Controllers;

use App\Group;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests;

class Group_Controller extends Controller
{
    //
    public function openGroup(Request $request){
        $group = Group::find($request->input('id'));
        $data['active'] = $request->input('id');
        $data['groups'] = Group::all();
        if($group){
            $data['tasks'] = $group->tasks;
        }else{
            $data['tasks'] = Task::all();
        }
        return view('homepage', $data);
    }

    public function add(Request $request){
        $group = new Group();
        $group->title = $request->input('title');
        $group->save();
        return redirect()->route('openGroup', ['id' => $group->id]);
    }
}
