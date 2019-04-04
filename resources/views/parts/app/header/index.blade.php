<!-- Header -->
<div id="header" data-fixed class="mdk-header js-mdk-header mb-0">
    <div class="mdk-header__content">

        <!-- Navbar -->
        <nav id="default-navbar" class="navbar navbar-expand navbar-dark bg-primary m-0">
            <div class="container-fluid">
                <!-- Toggle sidebar -->
                <button class="navbar-toggler d-block" data-toggle="sidebar" type="button">
                    <span class="material-icons">menu</span>
                </button>

                <!-- Brand -->
                <a href="{{ url('/home') }}" class="navbar-brand">
                    <img src="{{ asset('template/assets/images/logo/white.svg') }}" class="mr-2"
                        alt="{{ env('APP_NAME')}}" />
                    <span class="d-none d-xs-md-block">{{ env('APP_NAME')}}</span>
                </a>

                <!-- Search -->
                <form class="search-form d-none d-md-flex">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn" type="button"><i class="material-icons font-size-24pt">search</i></button>
                </form>
                <!-- // END Search -->

                <div class="flex"></div>

                @include('parts.app.navigation.notifications')
            </div>
        </nav>
        <!-- // END Navbar -->

    </div>
</div>
<!-- // END Header -->
