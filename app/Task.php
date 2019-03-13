<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['estimated_time'=>0, 'due_date' => 0];
    private static $dateShortCuts = ['nd' =>'tomorrow', 'ed' => 'endOfDay', 'ew' => 'endOfWeek', 'em' => 'endOfMonth', 'ey' => 'endOfYear'];

    public function setEstimatedAttribute($value){
        if(is_int($value)){
            $this->estimated_time += $value;
        }
    }

    public function setDueAttribute($value)
    {

        $value = str_replace('_'," ",$value);
        if (strtotime($value)) {
            $this->due_date = new carbon($value);
        }else{
            if (array_key_exists($value, Task::$dateShortCuts)) {
                if (Carbon::hasRelativeKeywords(Task::$dateShortCuts[$value])) {
                    $this->due_date = new carbon(Task::$dateShortCuts[$value]);
                }else{
                    $date = new carbon();
                    $modifier = Task::$dateShortCuts[$value];
                    $this->due_date = $date->$modifier();
                }
            }
        }
    }

    public function group(){
        return $this->belongsTo('App\group');
    }
    public function contexts(){
        return $this->morphToMany('App\context', 'contextable');
    }
}
