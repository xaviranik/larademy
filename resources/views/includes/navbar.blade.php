<nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg navbar-transparent" color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="/">Larademy </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('welcome') }}" class="nav-link">
                        <i class="material-icons">apps</i> All Courses
                    </a>
                </li>
                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="material-icons">account_circle</i> {{ auth()->user()->name }}
                    </a>
                </li>

                @admin
                    <li class="nav-item">
                        <a href="{{ route('series.index') }}" class="nav-link">
                            <i class="material-icons">dashboard</i>Manage Courses
                        </a>
                    </li>
                @endadmin

                <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="material-icons">power_settings_new</i>Logout
                        </a>
                    </li>
                @endauth

                @guest
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#signupModal">
                        <i class="material-icons">account_circle</i> Login
                    </a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
