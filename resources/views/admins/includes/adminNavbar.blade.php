<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('titles.languages') }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link home" href="{{ url('/') }}">{{ __('titles.home') }}</a>
            </ul>

            <!-- middle Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link mid-link" href="{{ route('profile.get') }}">
                            {{ __('titles.profile') }}
                        </a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link mid-link" href="{{ route('item.get') }}">
                        {{ __('titles.items') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mid-link"
                        href="{{ url( 'admins/category/show') }}">
                        {{ __('titles.categories') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mid-link" href="{{ url('admins/language/show') }}">
                        {{ __('titles.languages') }}
                    </a>
                        
                </li>
            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </li>
                @else

                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ ucfirst(substr(Auth::user()->name, 0, 1)) }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ url('admins/logout') }}">logout</a>
                        </div>
                    </li>

                @endguest
            </ul>
        </div>

    </div>



</nav>
