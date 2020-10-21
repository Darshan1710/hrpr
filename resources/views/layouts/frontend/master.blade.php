<html>
    <head>
        <title>App Name - @yield('title')</title>
        @include('layouts.frontend.head')
    </head>
    <body>
            @include('layouts.frontend.navigation')
            @yield('page-content')
            @include('layouts.frontend.footer')
            @include('layouts.frontend.script')
    </body>
</html>