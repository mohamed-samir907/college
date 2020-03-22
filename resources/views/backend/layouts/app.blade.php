<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pinoffer @yield('page-title') </title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('backend/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/application.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <style>
    .be-left-sidebar .sidebar-elements>li ul {
        padding: 0;
    }

    li a.router-link-exact-active {
        color: #4285f4 !important;
        /* background-color: #4285f4; */
    }

    li a.router-link-exact-active i{
        color: #4285f4 !important;
    }

    li a.router-link-exact-active:hover {
        color: #4285f4 !important;
    }

    li a.router-link-exact-active:hover span {
        color: #4285f4 !important;
    }

    .invalid-feedback {
        font-size: 90%;
    }

    /* Dashboard - Courses */

    #inputSmall {
      width: 360px;
    }
    </style>
    @stack('style')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <div id="app">
        <div class="be-wrapper be-fixed-sidebar be-collapsible-sidebar" id="beWrapper">

            @include('backend.layouts.navbar')

            @include('backend.layouts.sidebar')

            <div class="be-content" id="beContent">
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> --}}
    <script src="{{ url('backend/js/app.js') }}"></script>
    @stack('script')
    <script src="{{ asset('backend/js/perfect-scrollbar.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('backend/js/application.js') }}"></script>
    <script>
        $(document).ready(function(){
          //initialize the javascript
          App.init();
        });
    </script>
</body>
</html>
