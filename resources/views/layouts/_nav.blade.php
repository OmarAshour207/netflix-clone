<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            Netflix<span class="text-primary font-weight-bold">ify</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form action="" class="col-12 col-md-6 p-0 mt-1">
                <div class="input-group">
                    <input type="search" class="form-control bg-transparent border-0" placeholder="Search for your favourite movies" aria-label="Search for your favourite movies" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-white border-0" id="basic-addon2"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">
                @if (auth()->user())
                    <li class="nav-item">
                        <a href="{{ route('movies.index', ['favourite'    => auth()->user()->id]) }}" class="nav-link text-white" style="position: relative">
                            <i class="fa fa-heart fa-lg"></i>
                            <span class="bg-primary text-white d-flex justify-content-center align-items-center"
                            style="position: absolute; top: 0; right: -15px; width: 30px; height: 20px; border-radius: 50px;" id="nav__fav-count" data-fav-count="{{ auth()->user()->movies_count }}">
                                {{ auth()->user()->moviesCount > 9 ? '9+' : auth()->user()->movies_count }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin'))
                                <a class="dropdown-item" href="{{ route('dashboard.welcome') }}">
                                    <i class="fa fa-tachometer-alt"></i> Dashboard
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt fa-lg"></i>
                                Logout
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </li>
                @else
                    <a class="btn btn-primary mb-2 mb-md-0 mr-0 mr-md-2" href="{{ route('login') }}">Login </a>
                    <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                @endif

            </ul>
        </div>

    </div>
</nav>
