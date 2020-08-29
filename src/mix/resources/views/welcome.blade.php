<!DOCTYPE html>
<html>

@component('components.index.head')
@endcomponent

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-purple-light layout-top-nav">
    <div class="wrapper">

        @component('components.welcome.header')
        @endcomponent

        <!-- Full Width Column -->
        <div class="content-wrapper">
            <!--<div class="container">-->
            <!-- Content Header (Page header) -->

            <section class="content-header container">
                <h4> </h4>

            </section>
            <section class="content container-fluid">
                <div class="row"></div>
                <h3>
                    welcome
                </h3>
                <p>以下のボタンから簡単ログインを行えます</p>
                <div class="row justify-content-md-left">
                    <div class="col col-lg-2">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input id="email" type="hidden" value="11111111@gmail.com" name="email"
                                placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
                            <input id="password" type="hidden" value="11111111" name="password"
                                placeholder="{{ __('Password') }}" required autocomplete="current-password">
                            <!-- /.col -->
                            <div class="col">
                                <label>ユーザ１
                                <button type="submit" class="btn btn-success">簡単(ゲスト)ログイン</button>
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="col col-lg-2">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input id="email" type="hidden" value="22222222@gmail.com" name="email"
                                placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
                            <input id="password" type="hidden" value="22222222" name="password"
                                placeholder="{{ __('Password') }}" required autocomplete="current-password">
                            <!-- /.col -->
                            <div class="col">
                                <label>ユーザ２
                                <button type="submit" class="btn btn-primary">簡単(ゲスト)ログイン</button>
                                </label>
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
    <script src="{{ asset('/js/top/top.js') }}"></script>
</body>

</html>