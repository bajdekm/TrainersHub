<nav class="navbar navbar-expand-md navbar-light fixed-top navbar-laravel">
    <div class="container" id="app">

        <a class="navbar-brand" href="/" style="color: #EFFFE9;">PaintballHub</a>

        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" style="color: #EFFFE9;"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon" style="color: #EFFFE9; "></span>
        </button>
{{--        <button class="navbar-toggler ml-auto custom-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar4">
            <span class="navbar-toggler-icon"></span>
        </button>--}}

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" >
                <router-link class="nav-item" to="/search-trainer">
                    <a class="nav-link" style="color: #EFFFE9;" >Znajdz paintball</a>
                </router-link>
                @can('isUser')
                    <router-link to="/user-panel/profile" class="nav-link">
                        <a style="color: #EFFFE9;">
                            Twój profil
                        </a>
                    </router-link>
                @endcan
                <router-link class="nav-item" to="/contact">
                    <a class="nav-link" style="color: #EFFFE9;" >Kontakt</a>
                </router-link>
                @can('isTrainer')
                    <li class="nav-item" >
                        <router-link to="/trainer-panel/profile-setup" class="nav-link">
                            <a style="color: #EFFFE9;">Twój profil</a>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/trainer-panel/my-reservations" class="nav-link">
                            <a style="color: #EFFFE9;">Rezerwacje</a>
                        </router-link>
                        {{--<a class="nav-link" style="color: #EFFFE9;" disabled="true" data-toggle="tooltip" data-placement="right" title="Dostępne w krótce!">Rezerwacje</a>--}}
                    </li>
                @endcan
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" style="color: #EFFFE9;" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #EFFFE9;" href="http://localhost:8000/register-role" >Rejestracja</a>

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
