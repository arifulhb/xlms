<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>


    <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
    <meta name="robots" content="noindex">

    @include('parts.guest.head')


</head>

<body class="login">
    <div class="d-flex align-items-center" style="min-height: 100vh">
        <div class="col-sm-8 col-md-6 col-lg-4 mx-auto" style="min-width: 300px;">
            <div class="text-center mt-5 mb-1">
                <div class="avatar avatar-lg">
                <img src="{{ asset('template/assets/images/logo/primary.svg')}}" class="avatar-img rounded-circle" alt="LearnPlus" />
                </div>
            </div>
            <div class="d-flex justify-content-center mb-5 navbar-light">
            <a href="student-dashboard.html" class="navbar-brand m-0">{{ env('APP_NAME') }}</a>
            </div>
            <div class="card navbar-shadow">
                @yield('content')
            </div>
        </div>
    </div>
    @include('parts.guest.footer')
</body>
</html>
