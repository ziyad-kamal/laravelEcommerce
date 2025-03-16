<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('users.includes.header')
{{--  defaultLang(),lang_rtl() autoload from app\helpers\general    --}}
<body class="{{in_array(defaultLang(),lang_rtl())? 'rtl' : '' }}" >
    <div id="app">
        @include('admins.includes.adminNavbar') 

            <div class="container">
                <main class="py-4">
                    @yield('content')
                </main>

            </div>

        @include('users.includes.footer')
        
        @yield('script')
        
        
</body>

</html>
