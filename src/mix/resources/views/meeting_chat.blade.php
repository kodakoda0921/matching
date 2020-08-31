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
        <section class="content">
            {{-- ボックス --}}
            <div class="container-fluid">
                <section class="content-header container">
                    <button type="button" onclick="history.back()" class="btn btn-primary pull-right ml-1">戻る</button>
                    <h3>
                        チャット
                    </h3>
                </section>
                <!-- DIRECT CHAT -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-xl-6 col-14 connectedSortable pull-left">
                        <div class="card direct-chat direct-chat-success" id="direct_chat">
                            <div class="card-header">
                                <h3 class="card-title">{{ $meeting->title }}</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="reload">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="card_body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages" id="comment_data">
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="text" name="message" placeholder="Type Message ..."
                                                class="form-control" id="input_text">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" id="send">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!--/.direct-chat -->
                    </section>
                </div>
            </div>
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
    <!-- ./wrapper -->

    </section>
    </div>

    @component('components.index.js_read')
    @endcomponent
    {{-- JavaScript処理の呼び出し --}}
    <script>
        const meeting_id = {{ $id }};
        const login_user = {{Auth::user()->id}}
    </script>
    <script src="{{ asset('/js/chat.js') }}"></script>
</body>

</html>