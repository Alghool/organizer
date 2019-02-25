<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <title>Organizer| @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="app-container">
    <div class="container app-wrapper">
        <div class="row">
            <div id="sidebar" class="col-md-4">
                @include('partials.main_list')
            </div>
            <div id="main-container" class="col-md-8">
                @section('content')
                    <div class="adding-form">
                        {!! Form::open(['url' => 'addTask']) !!}
                            {!! Form::hidden('group',$active); !!}
                            {!! Form::text('title',null, ['placeholder' => 'new task']); !!}
                            {!! Form::submit('add') !!}
                        {!! Form::close() !!}
                    </div>
                @show
            </div>
        </div>
        <div class="msg-wrapper">
            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }} <a class="close-icon" onclick="removeMsg(this)"><i class="fas fa-times-circle"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('js/js.js') }}" type="text/javascript"></script>
</body>
</html>