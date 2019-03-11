<?php

namespace App\Http\Controllers;

use App\Group;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\groupRequest;

class Group_Controller extends Controller
{
    //
    public function openGroup(Request $request){
        $group = Group::with('myFamily')->find($request->input('id'));
        $data['active'] = $request->input('id');
        if($group){
            $subGroups = collect();
            $group->childrenList($subGroups);
            $groupsIDs = array();
            foreach ($subGroups as $group){
                $groupsIDs[] = $group['id'];


            }
            $data['tasks'] = Task::whereIn('group_id', $groupsIDs)->get();
        }else{
            $data['tasks'] = Task::all();
        }
        return view('homepage', $data);
    }

    public function add(GroupRequest $request){
        $group = new Group();
        $group->title = $request->input('title');
        $group->save();
        return redirect()->route('openGroup', ['id' => $group->id]);
    }


}
