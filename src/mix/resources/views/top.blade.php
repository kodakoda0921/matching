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
        <div class="content-wrapper">

            <!--<div class="container">-->
            <!-- Content Header (Page header) -->

            <section class="content-header container-fluid">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
                @endif
            </section>
            <section class="content">

                {{-- ボックス --}}
                <div class="container-fluid">

                    <h3 class="box-title">
                        ようこそ！
                    </h3>

                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h4>検索</h4>

                                    <p>勉強会を検索する</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="{{ url('/index') }}" class="small-box-footer">More info
                                    <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h4>プロフィール</h4>

                                    <p>ユーザ情報を更新する</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document"></i>
                                </div>
                                <a href="{{ url('/userProfile') }}" class="small-box-footer">More info
                                    <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-purple">

                                <div class="inner">
                                    @if ($count!=0)
                                    <span class="badge badge-primary float-right"><i
                                            class="fas fa-clock"></i>{{ $count }}</span>
                                    @endif
                                    <h4>勉強会</h4>
                                    <p>勉強会の作成や主催した勉強会の閲覧</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-book"></i>
                                </div>
                                <a href="{{ url('/meeting') }}" class="small-box-footer">More info
                                    <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col">

                    <!-- START ACCORDION & CAROUSEL-->
                    <h5 class="mt-4 mb-2">あなたにおすすめの勉強会</h5>

                    <div class="row">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">勉強会一覧</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="accordion">
                                        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                        href="#collapseOne">
                                                        Ruby勉強会
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="card-body">
                                                    楽しい勉強会ですよ！！！
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                    <!-- /.row -->
                    <!-- END ACCORDION & CAROUSEL-->
                </div>
            </section>


        </div>
        {{-- ここからフッター --}}
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->
    {{-- ここまでフッター --}}

    @component('components.top.js_read')
    @endcomponent

    {{-- JavaScript処理の呼び出し --}}
    <script src="{{ asset('/js/top/top.js') }}"></script>
</body>

</html>