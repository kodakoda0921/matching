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
                    <h4>
                        {{ $login_user->name }}さんのプロフィール
                    </h4>
                    <form action="{{ url("/userProfile") }}" method="post">
                        @csrf
                        {{-- <input type="hidden" name="sex" value="0"> --}}
                        <label for="sex">性別
                            {{ Form::select('sex', ["その他","男性","女性"], $profile->sex, ['class' => 'sex']) }}
                        </label>
                        <label for="language">言語
                            {{ Form::select('language', $list, $profile->language, ['class' => 'language']) }}
                        </label>
                        <p>
                            <input type="submit" value="更新">
                        </p>
                    </form>
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