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
        <section class="content">
            <div class="row"></div>

            {{-- ボックス --}}
            <div class="container-fluid">
                <section class="content-header container">
                    <button type="button" onclick="location.href='{{ url('/top') }}'"
                        class="btn btn-primary pull-right ml-1">戻る</button>
                    <p>プロフィールを充実させて勉強会への参加申請をしてみましょう</p>
                </section>
                <div class="card bg-light">
                    <div class="card-header">
                        <h3 class="card-title">{{ $login_user->name }}さんのプロフィール</h3>
                    </div>
                    <div class="col-sm-2">
                        @if ($profile->picture != null)
                        <div class="card-body box-profile">
                            <label for="picture" class="control-sidebar-subheading">プロフィール画像

                                <img class="profile-user-img img-fluid img-thumbnail rounded"
                                    alt="profile_image" src="{{ asset('storage/img/'.$profile->picture) }}">

                            </label>
                        </div>
                        @endif
                    </div>
                    <form action="{{ url("/userProfile") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row col">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="sex" class="control-sidebar-subheading">性別
                                            {{ Form::select('sex', ["その他","男性","女性"], $profile->sex, ['class' => 'form-control']) }}
                                            @error('sex')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="language" class="control-sidebar-subheading">言語
                                            {{ Form::select('language', $languagesList, $profile->language, ['class' => 'form-control']) }}
                                            @error('language')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="area" class="control-sidebar-subheading">所在地
                                            {{ Form::select('area', $areasList, $profile->area, ['class' => 'form-control']) }}
                                            @error('area')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="introduction" class="control-sidebar-subheading">自己紹介
                                        {{ Form::textarea('introduction', $profile->introduction, ['class' => 'form-control']) }}
                                        @error('introduction')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label for="file" class="control-sidebar-subheading">画像のアップロード(2MBまで)
                                        {{ Form::file('profile_image', ['class' => 'form-control', 'accept' =>'.jpg,.jpeg,.png', 'id' => 'file']) }}
                                        @error('profile_image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-success" type="submit" id="updateButton" value="更新">
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
    <script src="{{ asset('/js/userProfile/update.js') }}"></script>
</body>

</html>