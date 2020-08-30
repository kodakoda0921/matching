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
        <section class="content-header container-fluid">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                {{ session('success') }}
            </div>
            @endif
        </section>
        <section class="content">
            {{-- ボックス --}}
            <div class="container-fluid">
                <section class="content-header container">
                    <button type="button" onclick="location.href='{{ url('/meeting') }}'"
                        class="btn btn-primary pull-right ml-1">戻る</button>
                    <h3>
                        勉強会詳細
                    </h3>
                </section>
                <div class="card bg-light">
                    <div class="card-header">
                        <h3 class="card-title">{{ $meeting->title }}</h3>
                    </div>
                    <div class="card-body">

                        <div class="card-body box-profile">
                            @if ($meeting->picture != null)
                            <img class="profile-user-img img-fluid img-thumbnail rounded float-right"
                                alt="profile_image" src="{{ asset('storage/img/'.$meeting->picture) }}">
                            @endif
                            <strong><i class="fa fa-user mr-1"></i> 主催者</strong>
                            <p class="text-muted">
                                <a href="{{ url('profile/'.$meeting->user_id) }}">{{ $user->name }}</a>
                            </p>
                            <strong><i class="fa fa-book mr-1"></i> 場所</strong>
                            <p class="text-muted">
                                {{ $area->area }}
                            </p>
                            <strong><i class="fa fa-map-marker mr-1"></i> 言語</strong>
                            <p class="text-muted">
                                {{ $language->language }}
                            </p>
                            <strong><i class="fa fa-file mr-1"></i> 概要</strong>
                            <p class="text-muted">
                                {{ $meeting->overview }}
                            </p>
                            <strong><i class="fa fa-calendar mr-1"></i> 開催日付</strong>
                            <p class="text-muted">
                                {{ $meeting->event_date }}
                            </p>
                            <strong><i class="fa fa-user mr-1"></i> 参加人数</strong>
                            <p class="text-muted">
                                <a href="#" data-toggle="modal" data-target="#modal-join">{{ $join_count }}名</a>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if($meeting->user_id == $login_user->id)
                        <button type="button" class="btn bg-success btn-flat pull-right ml-1" data-toggle="modal"
                            data-target="#modal-destroy">削除</button>
                        <a href="{{ url('/meeting/edit/'.$meeting->id.'/') }}"
                            class="btn bg-success btn-flat pull-right">編集</a>
                        @if ($unapprovedList->isNotEmpty())
                        <button type="button" class="btn btn-primary btn-flat pull-left" data-toggle="modal"
                            data-target="#modal-approval">申請が来ています</button>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal-destroy">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">削除確認</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ $meeting->title }}を削除します</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    <a class="btn btn-danger" href="{{ url('/meeting/delete/'.$meeting->id.'/') }}">削除</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <!-- modal -->
    <div class="modal fade" id="modal-join">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">参加者確認</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ $meeting->title }}参加者の一覧</p>
                    @foreach ($list as $item)
                    <li>{{$item->users->name}}</li>
                    @endforeach
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <!-- modal -->
    <div class="modal fade" id="modal-approval">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">参加申請が来ています</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ $meeting->title }}への参加申請が届きました</p>
                    <table class="table table-hover">
                        <tr>
                            <th>名前</th>
                            <th>承認
                            <th>
                        </tr>
                        @foreach ($unapprovedList as $item)
                        <tr>
                            <th>{{$item->users->name}}</th>
                            <th>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ url('/meeting/approval/'.$item->id.'/') }}">承認</a>
                                <a class="btn btn-danger btn-sm"
                                    href="{{ url('/meeting/unapproval/'.$item->id.'/') }}">否認</a>
                            </th>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

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