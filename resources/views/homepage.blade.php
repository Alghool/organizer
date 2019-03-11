@extends('layouts.master')

@section('title', 'Homepage')


@section('content')
    @parent

    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="{{($task->done)? 'done': ''}} list-group-item">
                <div class="task-tags">
                    {{$task->group->root}}
                    @foreach($task->contexts as $context)
                        <span class="pull-right badge">{{ $context->title }}</span>
                    @endforeach
                </div>
                <p class="task-title">{{ $task->title }}</p>
                <div class="task-actions">
                    <a href="{{route('doneTask', ['id' => $task->id])}}" class="check-icon"><i class="fas fa-check" ></i></a>
                    <a href="{{route('deleteTask', ['id' => $task->id])}}" class="delete-icon"><i class="fas fa-trash-alt" ></i> </a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection