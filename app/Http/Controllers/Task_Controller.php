<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\taskRequest;
use App\Task;

class Task_Controller extends Controller
{
    public function add(TaskRequest $request){
        $task = new Task();
        $task->title = $request->input('title');
        $task->group_id = $request->input('group');
        $task->save();
        return redirect()->route('openGroup', ['id' => $task->group_id]);
    }

    public function delete(Request $request){
        $task = Task::findOrFail($request->input('id'));
        $groupID = $task->group_id;
        $task->delete();
        return redirect()->route('openGroup', ['id' => $groupID]);
    }

    public function setDone(Request $request){
        $task = Task::findOrFail($request->input('id'));
        $task->done = 1;
        $task->save();
        return redirect()->route('openGroup', ['id' => $task->group_id]);
    }

}
