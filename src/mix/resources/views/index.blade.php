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

            <section class="content-header container">
                <h4></h4>
            </section>
            <!-- Main content -->
            <section class="content container">
                <button type="button" onclick="location.href='{{ url('/top') }}'"
                class="btn btn-primary pull-right ml-1">戻る</button>
                <div class="row"></div>
                <h3>
                    勉強会一覧
                </h3>

                <div class="row">

                    <!-- general form elements -->
                    <div class="box box-header">
                        <!-- /.box-header -->
                        <!-- form start -->

                        <form role="form">
                            <div class="box-body">

                                <label>絞り込みオプション</label>
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="row">

                                            <!-- checkbox -->
                                            <div class="form-group">
                                                <label>
                                                    言語
                                                    {{ Form::select('language', $languagesList->prepend('選択してください', ''), "",  ['class' => 'form-control','id' => 'selectedLanguage']) }}
                                                </label>

                                                <label>
                                                    開催地
                                                    {{ Form::select('area', $areasList->prepend('選択してください', ''), "",  ['class' => 'form-control','id' => 'selectedArea']) }}
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button id="sendUpdateButton" type="button"
                                    class="btn btn-success pull-right">検索</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.row -->
            </section>
            <section class="content container-fluid">
                <div class="row">
                    <div id="example-table"></div>
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
    <div class="modal fade" id="modal-success">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <h4 class="modal-title" id="title"></h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel">
                            <div class="col-sm-4 pull-right">
                                <img class="profile-user-img img-fluid img-thumbnail rounded float-right"
                                    alt="profile_image" id='meeting_image' src="">
                            </div>
                            <div class="row invoice-info">

                                <div class="col-sm-4 invoice-col">
                                    <h6>ユーザー</h6>
                                    <ul id="user">
                                    </ul>
                                    <h6>言語</h6>
                                    <ul id="language">
                                    </ul>
                                    <h6>場所</h6>
                                    <ul id="area">
                                    </ul>
                                    <h6>開催日</h6>
                                    <ul id="date">
                                    </ul>
                                    <h6>概要</h6>
                                    <ul id="overview">
                                    </ul>
                                    <h6>参加人数</h6>
                                    <ul id="join">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col">
                                <button type="button" class="btn btn-default float-left"
                                    data-dismiss="modal">閉じる</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary float-right" id="join_button"
                                    value=""></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    @component('components.index.js_read')
    @endcomponent

    {{-- JavaScript処理の呼び出し --}}
    <script src="{{ asset('/js/home.js') }}"></script>
</body>

</html>