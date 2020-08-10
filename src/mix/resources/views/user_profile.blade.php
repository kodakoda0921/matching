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
            <h4>
                {{ $login_user->name }}さんのプロフィール
            </h4>
            <form action="{{ url("/userProfile") }}" method="post">
                @csrf
                <input type="hidden" name="mixer" value="0">
                <label for="mixer">MIX師
                    <input type="checkbox" name="mixer" id="mixer" value="1" @if($profile->mixer === 1)checked="checked" @else @endif>
                </label>
                <input type="hidden" name="singer" value="0">
                <label for="singer">歌い手
                    <input type="checkbox" name="singer" id="singer" value="1" @if($profile->singer === 1)checked="checked" @else @endif>
                </label>
                </p>
                <p>
                    <input type="submit" value="送信する">
                </p>
            </form>


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
