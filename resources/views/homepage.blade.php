@extends('layouts.master')

@section('title', 'Homepage')


@section('content')
    @parent

    <ul class="list-group">
        @foreach ($tasks as $task)
            <li class="{{($task->done)? 'done': ''}} list-group-item">
                <div class="task-tags">
                    @if(isset($task->group))
                    {{$task->group->root}}
                    @endif
                    @foreach($task->contexts as $context)
                        <span class="pull-right badge">{{ $context->title }}</span>
                    @endforeach
                </div>
                <p class="task-title">
                    <a href="{{route('doneTask', ['id' => $task->id])}}" class="check-icon"><i class="fas fa-check" ></i></a>
                    {{ $task->title }}
                </p>
                <div class="task-actions">
                    @if($task->estimated_time)
                        <span class=""><i class="fas fa-clock"></i>{{$task->estimated_time}}</span>
                    @endif
                    &nbsp; &nbsp;
                    @if($task->due_date != 0)
                        <span class=""><i class="fas fa-calendar-alt"></i>{{$task->due_date}}</span>
                    @endif
                    <a href="{{route('deleteTask', ['id' => $task->id])}}" class="delete-icon pull-right"><i class="fas fa-trash-alt" ></i> </a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection