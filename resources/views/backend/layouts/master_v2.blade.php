<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    @include('backend.layouts.partials.v2.styles_v2_default')
    <script type="text/javascript">
        const baseUrl = "<?php echo URL::to('/') ?>";
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="fixed-left">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            @include('backend.layouts.partials.v2.topbar_v2')
        </div>
        <!-- Top Bar End -->

        <!-- Left Sidebar Start -->
        <div class="left side-menu">
            @include('backend.layouts.partials.v2.left_side_bar_v2')
        </div>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                @yield('content')
            </div> <!-- content -->
            <!-- modal for alert -->
            {{-- <div class="modal-wrapper-all">
                @include('backend.layouts.partials.v2.modal_v2')
            </div> --}}
            <!-- model for alert end -->
        </div>
        <!-- End content-page -->
        <footer class="footer text-right">
            Copyright © 2020 <a href="#">vioresume</a> | All Rights Reserved
        </footer>
    </div>
    <!-- END wrapper -->



    <!-- dataTables js  -->
    <script src="{{ asset('public/backend/assets_v2/js/dataTables.js') }}"></script>
    <script src="{{ asset('public/backend/assets_v2/js/datatables.button.js') }}"></script>


    <!-- chart js  -->
    {{-- <script src="{{ asset('backend/assets_v2/js/core.js') }}"></script>
    <script src="{{ asset('backend/assets_v2/js/charts.js') }}"></script>
    <script src="{{ asset('backend/assets_v2/js/animated.js') }}"></script>
    <script src="{{ asset('backend/assets_v2/js/chart-custom.js') }}"></script> --}}
    <!--  js -->
    <script src="{{ asset('public/backend/assets_v2/js/waves.js') }}"></script>
    <script src="{{ asset('public/backend/assets_v2/js/jquery.app.js') }}"></script>
    <script src="{{ asset('public/backend/assets_v2/js/functions.js') }}"></script>

    <script src="{{ asset('public/backend/assets_v2/js/common-script.js') }}"></script> 

    <!-- on_demand_footer_script_if_exist is for if any script need to load on this master template. example : chart.js related script -->
    @yield('on_demand_footer_script_if_exist')
    <!-- script on ready -->
    @yield('after_domready_script')
</body>
</html>
