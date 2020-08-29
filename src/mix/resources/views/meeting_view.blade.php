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
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <!--<div class="container">-->
            <!-- Content Header (Page header) -->
            <section class="content">
                {{-- ボックス --}}
                <div class="container-fluid">
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <button type="button" onclick="location.href='{{ url('/meeting') }}'"
                                class="btn btn-primary pull-right ml-1">戻る</button>
                            <h3 class="card-title">{{ $meeting->title }}</h3>
                        </div>
                        <div class="card-body">

                            <div class="card-body box-profile">
                                @if ($meeting->picture == null)
                                <img class="profile-user-img img-fluid img-thumbnail rounded float-right"
                                    alt="no_profile_image" src="{{ asset('storage/img/'.'no_picture.jpeg') }}">
                                @else
                                <img class="profile-user-img img-fluid img-thumbnail rounded float-right"
                                    alt="profile_image" src="{{ asset('storage/img/'.$meeting->picture) }}">
                                @endif
                                <strong><i class="fa fa-user mr-1"></i> 主催者</strong>
                                <p class="text-muted">
                                    {{ $login_user->name }}
                                </p>
                                <strong><i class="fa fa-book mr-1"></i> 開催地</strong>
                                <p class="text-muted">
                                    {{ $area->area }}
                                </p>
                                <strong><i class="fa fa-map-marker mr-1"></i> 言語</strong>
                                <p class="text-muted">
                                    {{ $language->language }}
                                </p>
                                <strong><i class="fa fa-file mr-1"></i> 概要</strong>
                                <p class="text-muted">
                                    {{ $meeting->overview }}
                                </p>
                                <strong><i class="fa fa-calendar mr-1"></i> 開催日付</strong>
                                <p class="text-muted">
                                    {{ $meeting->event_date }}
                                </p>
                                <strong><i class="fa fa-user mr-1"></i> 参加人数</strong>
                                <p class="text-muted">
                                    <a href="#" data-toggle="modal" data-target="#modal-join">{{ $join_count }}名</a>
                                </p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn bg-olive btn-flat pull-right ml-1" data-toggle="modal"
                                data-target="#modal-destroy">削除</button>
                            <a href="{{ url('/meeting/edit/'.$meeting->id.'/') }}"
                                class="btn bg-olive btn-flat pull-right">編集</a>
                            @if ($unapprovedList->isNotEmpty())
                            <button type="button" class="btn btn-primary btn-flat pull-left" data-toggle="modal"
                                data-target="#modal-approval">申請が来ています</button>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- modal -->
        <div class="modal fade" id="modal-destroy">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">削除確認</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $meeting->title }}を削除します</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                        <a class="btn btn-danger" href="{{ url('/meeting/delete/'.$meeting->id.'/') }}">削除</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <!-- modal -->
        <div class="modal fade" id="modal-join">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">参加者確認</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $meeting->title }}参加者の一覧</p>
                        @foreach ($list as $item)
                        <li>{{$item->users->name}}</li>
                        @endforeach
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <!-- modal -->
        <div class="modal fade" id="modal-approval">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">参加申請が来ています</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $meeting->title }}への参加申請が届きました</p>
                        <table class="table table-hover">
                            <tr>
                                <th>名前</th>
                                <th>承認
                                <th>
                            </tr>
                            @foreach ($unapprovedList as $item)
                            <tr>
                                <th>{{$item->users->name}}</th>
                                <th>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ url('/meeting/approval/'.$item->id.'/') }}">承認</a>
                                    <a class="btn btn-danger btn-sm"
                                        href="{{ url('/meeting/unapproval/'.$item->id.'/') }}">否認</a>
                                </th>
                            </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

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
    <script src="{{ asset('/js/meeting/clock.js') }}"></script>

</body>

</html>