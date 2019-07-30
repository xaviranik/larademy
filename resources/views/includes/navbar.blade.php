<nav class="navbar navbar-color-on-scroll fixed-top navbar-expand-lg {{ Request::path() ==  '/' ? 'navbar-transparent' : ''  }}" color-on-scroll="100">
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
                    <a href="#" class="nav-link">
                        <i class="material-icons">apps</i> Courses
                    </a>
                </li>
                <li class="nav-item">
                    @if (auth()->check())
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#signupModal">
                        <i class="material-icons">account_circle</i> {{ auth()->user()->name }}
                    </a>
                    @else
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#signupModal">
                        <i class="material-icons">account_circle</i> Login
                    </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
