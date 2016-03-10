<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        @yield('styles')
    </head>
    
    <nav>
        @yield('nav')
    </nav>
    
    
    <body>
        <div class="main">
            @yield('content')
        </div>
    </body>
</html>