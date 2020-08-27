<header class="main-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="{{ url('/top') }}" class="navbar-brand"><b>勉強会をマッチングする</b></a>

            </div>

            <div class="navbar-custom-menu">
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link" id="RealtimeClockArea"></a></li>
                        <li class="nav-item dropdown">
                            {{-- <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>
                                <span class="badge badge-warning navbar-badge">15</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                                aria-labelledby="dropdownMenu1" role="menu">
                                <span class="dropdown-item dropdown-header">15 Notifications</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fa fa-envelope mr-2"></i> 4 new messages
                                    <span class="float-right text-muted text-sm">3 mins</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fa fa-users mr-2"></i> 8 friend requests
                                    <span class="float-right text-muted text-sm">12 hours</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fa fa-file mr-2"></i> 3 new reports
                                    <span class="float-right text-muted text-sm">2 days</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div> --}}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" 　href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('ログアウト') }}</a>
                        </li>

                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse"
                aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </nav>
</header>
