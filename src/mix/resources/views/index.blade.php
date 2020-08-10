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

            @component('components.index.main')
            @endcomponent
            <section class="content container-fluid">
                <div class="row">
                    <div id="example-table"></div>
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

    @component('components.index.js_read')
    @endcomponent

    {{-- JavaScript処理の呼び出し --}}
    <script src="{{ asset('/js/home.js') }}"></script>
</body>

</html>
