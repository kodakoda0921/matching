<!DOCTYPE html>
<html>

@component('components.index.head')
@endcomponent

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

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
                        @if ($count != 0)
                        <span class="badge badge-warning navbar-badge">{{ $count }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{ $count }} Notifications</span>
                        <div class="dropdown-divider"></div>
                        @if ($count != 0)
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
                    <div class="image">
                        <img src="{{ asset('storage/img/'.$profile->picture) }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{$login_user->name}}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ url('/index') }}" class="nav-link">
                                <i class="nav-icon fa fa-book"></i>
                                <p>
                                    検索
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/userProfile') }}" class="nav-link">
                                <i class="nav-icon fa fa-image"></i>
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
                                @if ($count!=0)
                                <span class="badge badge-primary float-right"><i
                                        class="fas fa-clock"></i>{{ $count }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        {{-- ここまでヘッダー --}}
        <section class="content-header container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                {{ session('success') }}
            </div>
            @endif
        </section>

        <div class="content-wrapper">

            <section class="content">

                <div class="container-fluid">
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <button type="button" onclick="location.href='{{ url('/top') }}'"
                                class="btn btn-primary pull-right ml-1">戻る</button>
                            <button type="button" onclick="location.href='{{ url('/meeting_regist') }}'"
                                class="btn btn-primary pull-right">新規</button>
                            <h3 class="card-title">{{ $login_user->name }}さんの主催勉強会</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php ($i = 0)
                                @foreach ($meetings[0] as $meeting)

                                <div class="col-md-3">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            @if ($meetings[1][$i] != 0)
                                            <a>
                                                <span class="badge bg-success float-right"><i
                                                        class="fas fa-clock"></i>{{ $meetings[1][$i] }}</span>
                                            </a>
                                            @endif
                                            <h3 class="box-title">{{ mb_strimwidth($meeting->title,0,34,"...") }}</h3>
                                        </div>
                                        <div class="box-body">
                                            @if ($meeting->picture == null)
                                            <img class="profile-user-img img-responsive img-circle img-fluid pull-right"
                                                alt="no_profile_image"
                                                src="{{ asset('storage/img/'.'no_picture.jpeg') }}">
                                            @else
                                            <img class="profile-user-img img-responsive img-circle img-fluid pull-right"
                                                alt="profile_image" src="{{ asset('storage/img/'.$meeting->picture) }}">
                                            @endif
                                            {{ mb_strimwidth($meeting->overview,0,100,"...") }}
                                        </div>
                                        <div class="box-footer">
                                            <div class="col-md-4 pull-left">
                                                <div class="d-block">{{ $meeting->event_date }}</div>
                                            </div>
                                            <a href="{{ url('/meeting/view/'.$meeting->id.'/') }}"
                                                class="btn bg-olive btn-flat pull-right ml-1">詳細</a>
                                        </div>
                                    </div>
                                </div>
                                @php ($i = $i + 1)
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>

                    </div>
                </div>
            </section>
        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

    @component('components.welcome.js_read')
    @endcomponent

    {{-- JavaScript処理の呼び出し --}}
    <script src="{{ asset('/js/meeting/meeting.js') }}"></script>
</body>

</html>