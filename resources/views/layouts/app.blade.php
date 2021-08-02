<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('users.includes.header')

<body>
    <div id="app">
        
        @include('users.includes.navbar')


       <div class="row" style="margin: 0">
            <div class="col-  col-md-3 col-lg-2 side_display" style="padding-left: 0">
                <div class=" sidebar_wrapper">
                    @include('users.includes.sidebar')
                </div>
            </div>

            <div class="col-  col-md-9  col-lg-10 all" style="padding: 0; ">
                <div class="container content">
                    @yield('content')
                </div>
            </div>
        </div>

        @include('users.includes.footer')

        @yield('script')
        @yield('script_notify')
        @yield('sidebar_script')
        

</body>

</html>
