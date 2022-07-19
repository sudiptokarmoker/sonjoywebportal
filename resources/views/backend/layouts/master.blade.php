<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Laravel Role Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.styles')
    {{-- this is basically for custom stylesheet need to be loadded in the pages --}}
    @yield('styles')
</head>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- left sidebar -->
        @include('backend.layouts.partials.sidebar')
        <!-- left sidebar end -->
        <!-- main content area start -->
        <div class="main-content">
            @include('backend.layouts.partials.header')
            {{-- messge box loading here --}}
            {{-- @include('backend.layouts.partials.messages') --}}
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            @yield('breadcrumbs')
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        @include('backend.layouts.partials.logout')
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            @yield('admin-content')
        </div>
        <!-- main content area end -->
        @include('backend.layouts.partials.footer')
    </div>
    <!-- page container area end -->
    @include('backend.layouts.partials.offsets')
    {{-- =================== all footer loading script here ==================== --}}
    {{-- common footer script --}}
    @include('backend.layouts.partials.footer_scripts')
    {{-- this is the final scirpt what need to be loadded  --}}
    {{-- @include('backend.layouts.partials.footer_custom_onload_script') --}}
    {{-- on demand script if any (like data table) --}}
    @yield('custom_script_footer_on_demand_on_page')
</body>
</html>
