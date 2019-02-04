<!DOCTYPE html>
<html>
<head>
    <title>Organizer| @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @section('sidebar')
                This is the master sidebar.
            @show
        </div>
        <div class="col-md-8">
            @section('content')
                This is the main content.
            @show
        </div>
    </div>
</div>
</body>
</html>