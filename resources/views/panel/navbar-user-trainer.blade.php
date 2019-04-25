<nav class="navbar navbar-expand-md navbar-light fixed-top navbar-laravel" style="background-color: #011627" >
    <div class="container" id="app">

        {{--<a class="navbar-brand" style="color: #EFFFE9;">--}}
        {{--{{ config('app.name', 'FitApp') }}--}}
        {{--<router-link to="/" class="nav-link">--}}
        <a class="navbar-brand" href="/" style="color: #052617;">FitApp</a>
        {{--<a style="color: #EFFFE9;">About</a>--}}
        {{--</router-link>--}}
        {{--</a>--}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" style="color: #052617;"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon" style="color: #EFFFE9;"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" >
                <p>Navbar-user-trainer</p>
                @can('isTrainer')
                    <li class="nav-item" >
                        <router-link to="/trainer-panel/profile-setup" class="nav-link">
                            <a style="color: #EFFFE9;">Profil</a>
                        </router-link>
                    </li>
                    <li class="nav-item" disabled="true">
                        <router-link to="/trainer-panel/my-reservations" class="nav-link">
                            <a style="color: #EFFFE9;">My reservations</a>
                        </router-link>
                    </li>

                @endcan
                @can('isUser')
                    <router-link to="/user-panel/about" class="nav-link">
                        <a style="color: #EFFFE9;">
                            About
                        </a>
                    </router-link>
                        <router-link to="/user-panel/profile" class="nav-link">
                            <a style="color: #EFFFE9;">
                                My Profile
                            </a>
                        </router-link>
                @endcan
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto" style="color: #EFFFE9;">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" style="color: #EFFFE9;" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li>
                        <router-link to="/register-role" class="nav-link">
                            <a style="color: #EFFFE9;">Register</a>
                        </router-link>
                    </li>
                @else
                    <li class="nav-item">
                        @can('isTrainer')
                            <a id="navbarDropdown" class="nav-link"  href="http://localhost:8000/trainer-panel/profile-setup" role="button" style="color: #EFFFE9;">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        @endcan
                        @can('isUser')
                            <a id="navbarDropdown" class="nav-link"  href="http://localhost:8000/user-panel/profile" role="button" style="color: #EFFFE9;">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        @endcan
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" style="color: #EFFFE9;"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
