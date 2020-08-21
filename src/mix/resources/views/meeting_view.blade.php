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
                            <button type="button" onclick="location.href='{{ url('/meeting') }}'"
                                class="btn btn-primary pull-right ml-1">戻る</button>
                            <h3 class="card-title">{{ $meeting->title }}</h3>
                        </div>
                        <div class="card-body">

                            <div class="card-body box-profile">
                                @if ($meeting->picture == null)
                                <img class="profile-user-img img-fluid img-thumbnail rounded float-right"
                                    alt="no_profile_image" src="{{ asset('storage/img/'.'no_picture.jpeg') }}">
                                @else
                                <img class="profile-user-img img-fluid img-thumbnail rounded float-right"
                                    alt="profile_image" src="{{ asset('storage/img/'.$meeting->picture) }}">
                                @endif
                                <strong><i class="fa fa-user mr-1"></i> 主催者:</strong>
                                <p class="text-muted">
                                    {{ $login_user->name }}
                                </p>


                                <strong><i class="fa fa-book mr-1"></i> 開催地:</strong>
                                <p class="text-muted">
                                    {{ $area->area }}
                                </p>




                                <strong><i class="fa fa-map-marker mr-1"></i> 言語:</strong>
                                <p class="text-muted">
                                    {{ $language->language }}
                                </p>



                                <strong><i class="fa fa-file mr-1"></i> 概要:</strong>
                                <p class="text-muted">
                                    {{ $meeting->overview }}
                                </p>


                                <strong><i class="fa fa-calendar mr-1"></i> 開催日付:</strong>
                                <p class="text-muted">
                                    {{ $meeting->event_date }}
                                </p>

                            </div>
                        </div>
                        <div class="card-footer">

                            <button type="button" class="btn bg-olive btn-flat pull-right ml-1" data-toggle="modal"
                                data-target="#modal-destroy">削除</button>
                            <a href="{{ url('/meeting/view/'.$meeting->id.'/') }}"
                                class="btn bg-olive btn-flat pull-right">詳細</a>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger">削除</button>
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
    <script src="{{ asset('/js/userProfile/update.js') }}"></script>

</body>

</html>