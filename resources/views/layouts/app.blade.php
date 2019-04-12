<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Instructor Dashboard</title>

    <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
    <meta name="robots" content="noindex">

    @include('parts.app.head.index')

</head>

<body class="layout-fluid">

    <div class="preloader">
        <div class="sk-double-bounce">
            <div class="sk-child sk-double-bounce1"></div>
            <div class="sk-child sk-double-bounce2"></div>
        </div>
    </div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">


        @include('parts.app.header.index')

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">
            <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">

                <div class="mdk-drawer-layout__content page ">
                    <div class="container-fluid">

                        @yield('breadcrumb')
                        {{-- @include('parts.app.body.breadcrumb') --}}

                        @include('parts.app.body.headline')
                        @yield('content')
                    </div>
                </div>

                @include('parts.app.navigation.navbar')
            </div>
        </div>
    </div>

    @include('parts.app.footer.index')

    @stack('footer-html')
</body>

</html>
