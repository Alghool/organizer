<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;

class Task_Controller extends Controller
{
    public function add(Request $request){
        $task = new Task();
        $task->title = $request->input('title');
        $task->group_id = $request->input('group');
        $task->save();
        return redirect()->route('homepage');
    }

    public function delete(Request $request){
        Task::destroy($request->input('id'));
        return redirect()->route('homepage');
    }
}
