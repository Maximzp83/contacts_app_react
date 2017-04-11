<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('partials/head')
<body>
<div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <b>Home</b>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (! Auth::guest())
                    <ul class="nav navbar-nav">
                        &nbsp;<li><a href="{{ url('/contacts') }}">My Contacts<span class="sr-only">(current)</span></a></li>
                        &nbsp;<li><a href="{{ url('/contacts/search') }}">Search Contacts<span class="sr-only">(current)</span></a></li>
                        &nbsp;<li><a href="{{ url('/contacts/write') }}">Write Contact<span class="sr-only">(current)</span></a></li>

                    </ul>
            @endif
            <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>{{--Top Navbar end --}}


    <div class="container">
        @include('partials/flash')

        @yield('content')
    </div>

</div>

<!-- Scripts -->

<script src="{{ asset('js/all.js') }}"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);
</script>
</body>
</html>
