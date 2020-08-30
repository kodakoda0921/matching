        {{-- ここからヘッダー --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/top') }}" class="nav-link">HOME</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        {{ __('ログアウト') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link" id="RealtimeClockArea"></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>
                        @if ($count != "0")
                        <span class="badge badge-warning navbar-badge">{{ $count }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{ $count }} Notifications</span>
                        <div class="dropdown-divider"></div>
                        @if ($count != "0")
                        <a href="{{ url('/meeting') }}" class="dropdown-item">
                            <i class="nav-icon fa fa-book mr-2"></i> {{ $count }} 件の参加申請
                        </a>
                        @endif
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <p class="brand-link">
                勉強会をマッチングする
            </p>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    @if ($picture != null)
                    <div class="image">
                        <img src="{{ asset('storage/img/'.$picture) }}"
                            class="profile-user-img img-fluid img-thumbnail rounded" alt="User Image">
                    </div>
                    @endif

                    <div class="info">
                        <a href="#" class="d-block">{{$name}}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ url('/top') }}" class="nav-link">
                                <i class="nav-icon fa fa-home"></i>
                                <p>
                                    HOME
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/index') }}" class="nav-link">
                                <i class="nav-icon fa fa-search"></i>
                                <p>
                                    検索
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/userProfile') }}" class="nav-link">
                                <i class="nav-icon fa fa-id-badge"></i>
                                <p>
                                    プロフィール
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/meeting') }}" class="nav-link">
                                <i class="nav-icon fa fa-book"></i>
                                <p>
                                    勉強会
                                </p>
                                @if ($count!="0")
                                <span class="badge badge-primary float-right"><i
                                        class="fas fa-clock"></i>{{ $count }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="nav-link">
                                <i class="nav-icon fa fa-sign-out"></i>
                                <p>
                                    ログアウト
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>


        <div class="content-wrapper">
        {{-- ここまでヘッダー --}}