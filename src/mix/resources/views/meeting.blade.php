<!DOCTYPE html>
<html>

@component('components.index.head')
@endcomponent

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-purple-light layout-top-nav">
    <div class="wrapper">

        @component('components.index.header')
        @endcomponent

        <!-- Full Width Column -->
        <div class="content-wrapper">
            <!--<div class="container">-->
            <!-- Content Header (Page header) -->
            <section class="content">
                {{-- ボックス --}}
                <div class="container-fluid">
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <button type="button" onclick="history.back()"
                                class="btn btn-primary pull-right ml-1">戻る</button>
                            <button type="button" onclick="location.href='{{ url('/meeting_regist') }}'"
                                class="btn btn-primary pull-right">新規</button>
                            <h3 class="card-title">{{ $login_user->name }}さんの主催勉強会</h3>
                        </div>

                        <div class="card-body">
                            <div class="col-md-4">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">ruby勉強会</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        rubyの基礎について
                                        <a href="{{ url('/index') }}" class="btn bg-olive btn-flat margin pull-right ml-1">More info
                                            {{-- <i class="fa fa-arrow-circle-o-right"></i> --}}</a>
                                    </div><!-- /.box-body -->



                                </div><!-- /.box -->
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
    <script src="{{ asset('/js/userProfile/update.js') }}"></script>
</body>

</html>