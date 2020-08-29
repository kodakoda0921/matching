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

        <!-- Full Width Column -->
        <div class="content-wrapper">
            <!--<div class="container">-->
            <!-- Content Header (Page header) -->
            <section class="content">
                {{-- ボックス --}}
                <div class="container-fluid">
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <button type="button" onclick="location.href='{{ url('/meeting/view/'.$meeting->id) }}'"
                                class="btn btn-primary pull-right ml-1">戻る</button>
                            <h3 class="card-title">{{ $login_user->name }}さんの勉強会を更新する</h3>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body box-profile">
                                <label for="picture" class="control-sidebar-subheading">勉強会イメージ画像
                                    @if ($meeting->picture == null)
                                    <img class="profile-user-img img-fluid img-thumbnail" alt="no_profile_image"
                                        src="{{ asset('storage/img/'.'no_picture.jpeg') }}">
                                    @else
                                    <img class="profile-user-img img-fluid img-thumbnail" alt="profile_image"
                                        src="{{ asset('storage/img/'.$meeting->picture) }}">
                                    @endif
                                </label>
                            </div>
                        </div>
                        <form action="{{ url("/meeting/edit/".$meeting->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="title" class="control-sidebar-subheading">タイトル
                                            {{ Form::text('title' , $meeting->title,  ['class' => 'form-control'])}}
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="language" class="control-sidebar-subheading">言語
                                                {{ Form::select('language', $languagesList, $meeting->language,  ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="area" class="control-sidebar-subheading">開催地
                                                {{ Form::select('area', $areasList, $meeting->area,  ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="event_date" class="control-sidebar-subheading">日付
                                                {{ Form::date('event_date', $meeting->event_date, ['class' => 'form-control']) }}
                                                @error('event_date')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="textarea" class="control-sidebar-subheading">勉強会概要
                                            {{ Form::textarea('overview', $meeting->overview,  ['class' => 'form-control']) }}
                                            @error('overview')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="file" class="control-sidebar-subheading">アイコン画像のアップロード(2MBまで)
                                            {{ Form::file('meeting_image', ['class' => 'form-control', 'accept' =>'.jpg,.jpeg,.png', 'id' => 'file']) }}
                                            @error('meeting_image')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input class="btn btn-primary" id = "updateButton" type="submit" value="登録">
                            </div>

                        </form>
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
    <script src="{{ asset('/js/meeting/clock.js') }}"></script>
</body>

</html>