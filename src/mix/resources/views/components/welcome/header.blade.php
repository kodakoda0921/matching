<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="{{ url('/') }}" class="navbar-brand"><b>勉強会をマッチングする</b></a>

            </div>

            <div class="navbar-custom-menu">
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav mr-auto">
                        {{-- <li class="nav-item"><a class="nav-link" id="RealtimeClockArea"></a></li> --}}
                        @if (Route::has('login'))
                        @auth

                        <li class="nav-item"><a class="nav-link" href="{{ url('/top') }}">Home</a></li>
                        @else

                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">ログイン</a>
                            <ion-icon name="log-in"></ion-icon>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">登録</a></li>
                        @endif
                        @endauth
                        @endif
                    </ul>
                </div>
            </div>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </nav>
</header>
