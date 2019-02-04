@extends('layouts.master')

@section('title', 'Homepage')

@section('sidebar')
    @parent
    <ul>
        <li class="{{ ($active == 0)? 'active':''}}">inbox</li>
        @foreach ($groups as $group)
            <li class="{{ ($active == $group->id)? 'active':''}}">{{$group->id}}: {{ $group->title }}</li>
        @endforeach
    </ul>
@endsection

@section('content')
    <div class="adding-form">
        <form action="{{route('addTask')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="group" id="group" value="{{$active}}">
            <input type="text" name="title" id="title" value="">
            <button type="submit" class="btn">add</button>
        </form>
    </div>
    <ul>
        @foreach ($tasks as $task)
            <li>{{ $task->title }}</li>
        @endforeach
    </ul>
@endsection