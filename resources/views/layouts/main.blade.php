<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">

            @include('layouts.navbar')

            <!-- Main Content -->
            @yield('konten')

            @include('layouts.footer')

        </div>
    </div>

    <!-- General JS Scripts -->
    @include('layouts.script')
</body>

</html>
