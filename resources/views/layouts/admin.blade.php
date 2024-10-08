<!DOCTYPE html>
<html lang="en">

@include('admin.inc.head')

<body class="g-sidenav-show  bg-gray-100" id="app">
    @include('admin.inc.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        @section('navbar')
            <x-admin.navbar :pageName="$page_name"></x-admin.navbar>
        @show
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    @include('admin.inc.status')
                </div>
            </div>
            @yield('content')

            <!-- Footer -->
            @include('admin.inc.footer')
            <!-- End Footer -->
        </div>
        <!--   Modals   -->
        @include('admin.inc.modals')
        <x-admin.social-links></x-admin.social-links>
    </main>


    <!--   UI Config   -->
    @include('admin.inc.config')
</body>

</html>
