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
        'name' => $login_user->name,
        'meeting_chat_unread_count' => $meeting_chat_unread_count
        ])
        @endcomponent
        <section class="content">
            {{-- ボックス --}}
            <div class="container-fluid">
                <section class="content-header container">
                    <button type="button" onclick="location.href='{{ url('/meeting/view/'.$meeting->id) }}'"
                        class="btn btn-primary pull-right ml-1">戻る</button>
                    <h3>
                        勉強会編集
                    </h3>
                </section>
                <div class="card bg-light">
                    <div class="card-header">
                        <h3 class="card-title">{{ $login_user->name }}さんの勉強会を更新する</h3>
                    </div>
                    <div class="col-sm-2">
                        <div class="card-body box-profile">

                            @if ($meeting->picture != null)
                            <label for="picture" class="control-sidebar-subheading">イメージ
                                <img class="profile-user-img img-fluid img-thumbnail" alt="profile_image"
                                    src="{{ asset('storage/img/'.$meeting->picture) }}">
                            </label>
                            @endif

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
                            <div class="row col">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="language" class="control-sidebar-subheading">言語
                                            {{ Form::select('language', $languagesList, $meeting->language,  ['class' => 'form-control']) }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="area" class="control-sidebar-subheading">場所
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
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="file" class="control-sidebar-subheading">画像のアップロード(2MBまで)
                                        {{ Form::file('meeting_image', ['class' => 'form-control', 'accept' =>'.jpg,.jpeg,.png', 'id' => 'file']) }}
                                        @error('meeting_image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-success" id="updateButton" type="submit" value="登録">
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