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
                <div class="row"></div>

                {{-- ボックス --}}
                <div class="container-fluid">
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <h3 class="card-title">{{ $login_user->name }}さんのプロフィール</h3>
                        </div>
                        <form action="{{ url("/userProfile") }}" method="post">
                            <div class="card-body">
                                @csrf
                                {{-- <input type="hidden" name="sex" value="0"> --}}
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="sex">性別
                                                {{ Form::select('sex', ["その他","男性","女性"], $profile->sex, ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="language">言語
                                                {{ Form::select('language', $languagesList, $profile->language, ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="area">所在地
                                                {{ Form::select('area', $areasList, $profile->area, ['class' => 'form-control']) }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="introduction">自己紹介
                                            {{ Form::textarea('introduction', $profile->introduction, ['class' => 'form-control']) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                    <input class="btn btn-primary" type="submit" value="更新">
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