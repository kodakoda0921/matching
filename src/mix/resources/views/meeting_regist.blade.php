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
                            <h3 class="card-title">{{ $login_user->name }}さんの新規勉強会登録</h3>
                        </div>
                        {{-- <div class="col-sm-2">
                            <div class="card-body box-profile">
                                <label for="picture" class="control-sidebar-subheading">プロフィール画像
                                    @if ($profile->picture == null)
                                    <img class="profile-user-img img-fluid img-thumbnail" alt="no_profile_image"
                                        src="{{ asset('storage/img/'.'no_picture.jpeg') }}">
                                    @else
                                    <img class="profile-user-img img-fluid img-thumbnail" alt="profile_image"
                                        src="{{ asset('storage/img/'.$profile->picture) }}">
                                    @endif
                                </label>
                            </div>
                        </div> --}}
                        <form action="{{ url("/userProfile") }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="language" class="control-sidebar-subheading">言語
                                                {{ Form::select('language', $languagesList,  ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="area" class="control-sidebar-subheading">開催地
                                                {{ Form::select('area', $areasList,  ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="introduction" class="control-sidebar-subheading">自己紹介
                                            {{ Form::textarea('introduction', $profile->introduction, ['class' => 'form-control']) }}
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="file" class="control-sidebar-subheading">アイコン画像のアップロード
                                            {{ Form::file('meeting_image', ['class' => 'form-control', 'accept' =>'.jpg,.jpeg,.png']) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input class="btn btn-primary" type="submit" value="登録">
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