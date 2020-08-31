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
                    <button type="button" onclick="history.back()"
                        class="btn btn-primary pull-right ml-1">戻る</button>
                    <h3>
                        ダイレクトチャット
                    </h3>
                </section>
                <!-- DIRECT CHAT -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-8 connectedSortable pull-left">
                        <div class="card direct-chat direct-chat-success" id="direct_chat">
                            <div class="card-header">
                                <h3 class="card-title">Direct Chat</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                                        data-widget="chat-pane-toggle">
                                        <i class="fa fa-comments"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="card_body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages" id="comment_data">
                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                                            <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            You better believe it!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    {{-- <!-- Contacts are loaded here -->
                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="dist/img/user1-128x128.jpg">

                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Count Dracula
                                                            <small
                                                                class="contacts-list-date float-right">2/28/2015</small>
                                                        </span>
                                                        <span class="contacts-list-msg">How have you been? I
                                                            was...</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                        </ul>
                                        <!-- /.contacts-list -->
                                    </div>
                                    <!-- /.direct-chat-pane --> --}}
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
    <script>const meeting_id = {{ $id }};</script>
    <script src="{{ asset('/js/chat.js') }}"></script>
</body>

</html>