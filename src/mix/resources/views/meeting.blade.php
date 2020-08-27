<!DOCTYPE html>
<html>

@component('components.index.head')
@endcomponent

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-purple-light layout-top-nav">
    <div class="wrapper">

        @component('components.index.header')
        @endcomponent
        <section class="content-header container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                {{ session('success') }}
            </div>
            @endif
        </section>

        <div class="content-wrapper">

            <section class="content">

                <div class="container-fluid">
                    <div class="card bg-light mb-3">
                        <div class="card-header">
                            <button type="button" onclick="location.href='{{ url('/top') }}'"
                                class="btn btn-primary pull-right ml-1">戻る</button>
                            <button type="button" onclick="location.href='{{ url('/meeting_regist') }}'"
                                class="btn btn-primary pull-right">新規</button>
                            <h3 class="card-title">{{ $login_user->name }}さんの主催勉強会</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($meetings as $meeting)
                                <div class="col-md-3">
                                    <div class="box box-success">
                                        <div class="box-header with-border">
                                            <a　id={{'aaa'.$meeting->id}}>
                                                <span class="badge bg-success float-right"><i class="fas fa-clock"></i>{{ $count }}</span>
                                            </a>
                                            <h3 class="box-title">{{ mb_strimwidth($meeting->title,0,34,"...") }}</h3>

                                        </div>
                                        <div class="box-body">
                                            @if ($meeting->picture == null)
                                            <img class="profile-user-img img-responsive img-circle img-fluid pull-right"
                                                alt="no_profile_image"
                                                src="{{ asset('storage/img/'.'no_picture.jpeg') }}">
                                            @else
                                            <img class="profile-user-img img-responsive img-circle img-fluid pull-right"
                                                alt="profile_image" src="{{ asset('storage/img/'.$meeting->picture) }}">
                                            @endif
                                            {{ mb_strimwidth($meeting->overview,0,100,"...") }}
                                        </div>
                                        <div class="box-footer">
                                            <div class="col-md-4 pull-left">
                                                <div class="d-block">{{ $meeting->event_date }}</div>
                                            </div>
                                            <a href="{{ url('/meeting/view/'.$meeting->id.'/') }}"
                                                class="btn bg-olive btn-flat pull-right ml-1">詳細</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>

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