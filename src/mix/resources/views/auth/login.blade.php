<!DOCTYPE html>
<html>

@component('components.index.head')
@endcomponent

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>{{ __('Login') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">ログインしてください</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group has-feedback">

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required
                        autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-check text-left">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <!-- /.col -->
                <div class="col text-right">
                    <button type="submit" class="btn align-self-end">{{ __('Login') }}</button>
                </div>

            </form>
            <!-- /.social-auth-links -->

            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
            <a href="{{ route('register') }}" class="btn btn-link">{{ __('Register') }}</a>

        </div>
        <!-- /.login-box-body -->

    </div>
    <!-- /.login-box -->

    @component('components.index.js_read')
    @endcomponent

</body>

</html>
