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
        'name' => $login_user->name,
        'meeting_chat_unread_count' => $meeting_chat_unread_count
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

            <div class="container-fluid">
                <section class="content-header container">
                    <button type="button" onclick="location.href='{{ url('/top') }}'"
                        class="btn btn-primary pull-right ml-1">戻る</button>
                    <button type="button" onclick="location.href='{{ url('/meeting_regist') }}'"
                        class="btn btn-primary pull-right">新規</button>
                    <h3>
                        勉強会一覧
                    </h3>
                </section>


                <div class="card bg-light">
                    <div class="card-header">
                        <h3 class="card-title">{{ $login_user->name }}さんが主催</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            @php ($i = 0)
                            @foreach ($meetings[0] as $meeting)

                            <div class="col-md-4">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        @if ($meetings[1][$i] != 0 || $meetings[2][$i] != 0)
                                        <a>
                                            <span class="badge bg-success float-right"><i
                                                    class="fa fa-bell"></i>{{ $meetings[2][$i] + $meetings[1][$i] }}</span>
                                        </a>
                                        @endif
                                        <h4 class="box-title">{{ mb_strimwidth($meeting->title,0,34,"...") }}</h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($meeting->picture != null)
                                        <img class="profile-user-img img-fluid img-thumbnail pull-right"
                                            alt="profile_image" src="{{ asset('storage/img/'.$meeting->picture) }}">
                                        @endif
                                        {{ mb_strimwidth($meeting->overview,0,100,"...") }}
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-md-4 pull-left">
                                            <div class="d-block">{{ $meeting->event_date }}</div>
                                        </div>
                                        <a href="{{ url('/meeting/view/'.$meeting->id.'/') }}"
                                            class="btn bg-success btn-flat pull-right ml-1">詳細</a>
                                    </div>
                                </div>
                            </div>
                            @php ($i = $i + 1)
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>

                </div>

                <div class="card bg-light">
                    <div class="card-header">
                        <h3 class="card-title">参加承認済一覧</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php ($i = 0)
                            @foreach ($meetings_joined[0] as $meeting_joined)
                            @if($meeting_joined->meetings->user_id != Auth::id())
                            <div class="col-md-4">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        @if ($meetings_joined[1][$i] != 0)
                                        <a>
                                            <span class="badge bg-success float-right"><i
                                                    class="fa fa-bell"></i>{{ $meetings_joined[1][$i] }}</span>
                                        </a>
                                        @endif
                                        <h4 class="box-title">
                                            {{ mb_strimwidth($meeting_joined->meetings->title,0,34,"...") }}
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($meeting_joined->meetings->picture != null)
                                        <img class="profile-user-img img-fluid img-thumbnail pull-right"
                                            alt="profile_image"
                                            src="{{ asset('storage/img/'.$meeting_joined->meetings->picture) }}">
                                        @endif
                                        {{ mb_strimwidth($meeting_joined->meetings->overview,0,100,"...") }}
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-md-4 pull-left">
                                            <div class="d-block">{{ $meeting_joined->meetings->event_date }}</div>
                                        </div>
                                        <a href="{{ url('/meeting/view/'.$meeting_joined->meetings->id.'/') }}"
                                            class="btn bg-success btn-flat pull-right ml-1">詳細</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @php ($i = $i + 1)
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
    <script src="{{ asset('/js/meeting/meeting.js') }}"></script>
</body>

</html>