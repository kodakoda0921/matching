<!DOCTYPE html>
<html>

@component('components.index.head')
@endcomponent

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @component('components.index.header',[
            'count' => $count,
            'picture' => $profile->picture,
            'name' => $login_user->name 
        ])
        @endcomponent
            <section class="content">
                {{-- ボックス --}}
                <div class="container-fluid">
                    <section class="content-header container">
                        <button type="button" onclick="location.href='{{ url('/meeting') }}'"
                        class="btn btn-primary pull-right ml-1">戻る</button>
                        <h3>
                            勉強会登録
                        </h3>
                    </section>   
                    <div class="card bg-light">
                        <div class="card-header">
                            <h3 class="card-title">{{ $login_user->name }}さんの新規勉強会登録</h3>
                        </div>
                        <form action="{{ url("/meeting_regist") }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="title" class="control-sidebar-subheading">タイトル
                                            {{ Form::text('title' , "",  ['class' => 'form-control'])}}
                                            @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="row col">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="language" class="control-sidebar-subheading">言語
                                                {{ Form::select('language', $languagesList, "",  ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="area" class="control-sidebar-subheading">場所
                                                {{ Form::select('area', $areasList, "",  ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="event_date" class="control-sidebar-subheading">日付
                                                {{ Form::date('event_date', "", ['class' => 'form-control']) }}
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
                                            {{ Form::textarea('overview', "",  ['class' => 'form-control']) }}
                                            @error('overview')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="file" class="control-sidebar-subheading">画像のアップロード(2MBまで)
                                            {{ Form::file('meeting_image', ['class' => 'form-control', 'accept' =>'.jpg,.jpeg,.png','id' => 'file']) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input class="btn btn-success" id = "updateButton" type="submit" value="登録">
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