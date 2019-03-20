<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('test/{id}', function($id){

});


Route::group(['middleware' => ['web']], function () {
    Route::auth();
});

Route::group(['middleware' => ['userArea']], function () {


    Route::get('/', ['as'=>'homepage', 'uses'=>'Task_Controller@homePage']);
    Route::get('/allTasks/', ['as'=>'allTasks', 'uses'=>'Task_Controller@homePage']);
    Route::post('/addTask/', ['as'=>'addTask', 'uses'=>'Task_Controller@add']);
    Route::get('/deleteTask/', ['as'=>'deleteTask', 'uses'=>'Task_Controller@delete']);
    Route::get('/doneTask/', ['as'=>'doneTask', 'uses'=>'Task_Controller@setDone']);
    Route::get('/group/', ['as'=>'openGroup', 'uses'=>'Group_Controller@openGroup']);
    Route::post('/addGroup/', ['as'=>'addGroup', 'uses'=>'Group_Controller@add']);

});


//route::any('/{controller}/{method?}/{params?}',function($controller, $methed = 'index', $params = null){
//    if(isset($params)){
//        $params = explode('/', $params);
//    }else{
//        $params = array();
//    }
//    return App::call('App\\http\\controllers\\'.$controller.'@'.$methed, $params);
//})->where('params', '.*');