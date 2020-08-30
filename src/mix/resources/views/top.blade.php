<!DOCTYPE html>
<html>

@component('components.index.head')
@endcomponent

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @component('components.index.header',[
        'count' => $count,
        'picture' => $profile->picture,
        'name' => $login_user->name
        ])
        @endcomponent

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
            <div class="container">

                <h3 class="box-title">
                    ようこそ！
                </h3>

                <div class="row col">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h4>検索</h4>

                                <p>検索する</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ url('/index') }}" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-blue">

                            <div class="inner">
                                @if ($count!=0)
                                <span class="badge badge-success float-right"><i
                                        class="fas fa-clock"></i>{{ $count }}</span>
                                @endif
                                <h4>勉強会</h4>
                                <p>作成・参加履歴の閲覧</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-book"></i>
                            </div>
                            <a href="{{ url('/meeting') }}" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-o-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col">

                    <!-- START ACCORDION & CAROUSEL-->
                    <h5 class="mt-4 mb-2">参加してみませんか？</h5>

                    <div class="row col">

                        <div class="card bg-light">
                            <div class="card-header">
                                <h3 class="card-title">あなたへのおすすめ</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="accordion">
                                    <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
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


                    </div>
                    <!-- /.row -->
                    <!-- END ACCORDION & CAROUSEL-->
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

    @component('components.top.js_read')
    @endcomponent

    {{-- JavaScript処理の呼び出し --}}
    <script src="{{ asset('/js/top/top.js') }}"></script>
</body>

</html>