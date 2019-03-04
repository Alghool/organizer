<div id="main-list">
    <div class="adding-form">
        {!! Form::open(['url' => 'addGroup']) !!}
        {!! Form::text('title',null, ['placeholder' => 'new root list']); !!}
        {!! Form::submit('add') !!}
        {!! Form::close() !!}
    </div>
    <ul>
        <a href="{{route('homepage')}}">
            <li class="{{ ($active == 'inbox')? 'active':''}}">Inbox</li>
        </a>
        <a href="{{route('allTasks')}}">
            <li class="{{ ($active == 'all')? 'active':''}}">All</li>
        </a>
    </ul>
    <h3>lists:</h3>
    <ul>
        @foreach ($groups as $group)
            <li style="margin-left: {{$group->show_lvl * 10}}px" class="{{ ($active == $group->id)? 'active':''}}">
                <a href="{{route('openGroup',['id' =>$group->id ])}}">
                    {{$group->id}}: {{ $group->root }}
                </a>
            </li>
        @endforeach
    </ul>
    <h3>contexts:</h3>
    <ul>
        @foreach ($contexts as $context)
            <li class="{{ ($active == $group->id)? 'active':''}}">
                <a href="{{route('openGroup',['id' =>$group->id ])}}">
                    {{$group->id}}: {{ $group->title }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="btn-group" role="group" aria-label="...">
        <a  class="btn btn-sm btn-default" title="manage lists"><i class="fas fa-tasks"></i></a>
        <a  class="btn btn-sm btn-default" title="manage contexts"><i class="fas fa-tags"></i></a>
        <a  class="btn btn-sm btn-default" title="settings"><i class="fas fa-cog"></i></a>
    </div>
</div>