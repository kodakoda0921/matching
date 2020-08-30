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
            {{-- ボックス --}}
            <div class="container-fluid">
                <section class="content-header container">
                    <button type="button" onclick="history.back()" class="btn btn-primary pull-right ml-1">戻る</button>
                    <h3>
                        プロフィール
                    </h3>
                </section>
                <div class="card bg-light">
                    <div class="card-header">
                        <h3 class="card-title">{{ $user->name }}</h3>
                    </div>
                    <div class="card-body">

                        <div class="card-body box-profile">
                            @if ($user_profile->picture != null)
                            <img class="profile-user-img img-fluid img-thumbnail rounded float-right"
                                alt="profile_image" src="{{ asset('storage/img/'.$user_profile->picture) }}">
                            @endif
                            <strong><i class="fa fa-book mr-1"></i> 所在地</strong>
                            <p class="text-muted">
                                {{ $area->area }}
                            </p>
                            <strong><i class="fa fa-file mr-1"></i> 性別</strong>
                            <p class="text-muted">
                                @if ($user_profile->sex ==0 )
                                その他
                                @elseif($user_profile->sex == 1 )
                                男性
                                @else
                                女性
                                @endif
                            </p>
                            <strong><i class="fa fa-map-marker mr-1"></i> 言語</strong>
                            <p class="text-muted">
                                {{ $language->language }}
                            </p>
                            <strong><i class="fa fa-file mr-1"></i> 自己紹介</strong>
                            <p class="text-muted">
                                {{ $user_profile->introduction }}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if ($user->id == $login_user->id)
                        <a href="{{ url('/userProfile') }}" class="btn bg-success btn-flat pull-right">編集</a>
                        @endif
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