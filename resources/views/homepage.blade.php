@extends('layouts.master')

@section('title', 'Homepage')

@section('sidebar')
    @parent
    <ul>
        <a href="{{route('homepage')}}">
            <li class="{{ ($active == 0)? 'active':''}}">inbox</li>
        </a>
        @foreach ($groups as $group)
            <li class="{{ ($active == $group->id)? 'active':''}}">
                <a href="{{route('openGroup',['id' =>$group->id ])}}">
                    {{$group->id}}: {{ $group->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection

@section('content')
    @parent

    <ul>
        @foreach ($tasks as $task)
            <li class="{{($task->done)? 'done': ''}}">
                <a href="{{route('doneTask', ['id' => $task->id])}}" class="check-icon"><i class="fas fa-check" ></i></a>
                {{ $task->title }}
                <a href="{{route('deleteTask', ['id' => $task->id])}}" class="delete-icon"><i class="fas fa-trash-alt" ></i>
                </a>
            </li>
        @endforeach
    </ul>
@endsection