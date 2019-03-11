<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\taskRequest;
use App\Task;
use App\Group;
use App\Context;

class Task_Controller extends Controller
{
    private  static $smartAssigns = ['#' => 'context', '$' => 'group', '/h' => 'hour', '/m' => 'menutes' , '/p' => 'due_date'];


    function homePage(){
        $data['active'] = 'inbox';
        $data['tasks'] = Task::all();
        return view('homepage', $data);
    }


    public function add(TaskRequest $request){
        $task = new Task();
        $smartValues = Task_Controller::smartInserting($request->input('title'));
        $task->title = $smartValues['title'];
        if(isset($smartValues['group'])){
            $myGroup = Group::setSmartGroup($smartValues['group']);
            $task->group_id = $myGroup->id;
        }else{
            $task->group_id = is_int($request->input('group'))?$request->input('group'):0;
        }
        $task->save();
        if(isset($smartValues['context'])){
            $myContext = Context::setSmartContext($smartValues['context']);
            $task->contexts()->saveMany($myContext);
        }

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

    private static function smartInserting($value){
        $smartValue = array();
        $value .= ' '; //add extra space for str position to work
        foreach (Task_Controller::$smartAssigns as $assign => $attribute){
            $startsAt = strpos($value,$assign);
            if($startsAt){
                $endsAt = strpos($value,' ', $startsAt);
                $assignValue = trim(substr($value, $startsAt, $endsAt));
                $value = str_replace($assignValue,"",$value);
                $smartValue[$attribute] = ltrim($assignValue, $assign);
            }
        }
        $smartValue['title'] = $value;
        return $smartValue;
    }

}
