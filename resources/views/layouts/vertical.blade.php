<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => $page_title])

    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])


    <link rel="stylesheet" href="{{ URL::asset('dist/css/lightbox.min.css') }}">

    <script src="{{ URL::asset('dist/js/lightbox-plus-jquery.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>






</head>


<body class="loading"
    data-layout='{"mode": "{{ $theme ?? 'light' }}", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "{{ $theme ?? 'light' }}", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'
    @yield('body-extra')>
    <!-- Begin page -->

    <div id="preloader">
        <div id="status">
            <div class="spinner">Loading...</div>
        </div>
    </div>
    <div id="wrapper">
        @include('layouts.shared/topbar')
        {{-- 
        @include('layouts.shared/left-sidebar') --}}

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div>
            <!-- content -->

            {{-- @include('layouts.shared/footer') --}}

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    {{-- @include('layouts.shared/right-sidebar') --}}

    @include('layouts.shared/footer-script')



</body>

</html>
