<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('users.includes.header')

<body>
    <div id="app">
        
        @include('users.includes.navbar')

            
        <div class="container content">
            @yield('content')
        </div>
            
        @include('users.includes.footer')

        @yield('script')
        @yield('script_notify')
        
        

</body>

</html>
