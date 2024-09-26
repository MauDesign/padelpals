<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $metaTitle  ?? 'MC Design' }}</title>
        <link rel="stylesheet" href="{{asset('assets\vendor\css\core.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets\vendor\css\theme-semi-dark.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets\vendor\libs\flatpickr\flatpickr.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}} " />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <!-- Vendor -->
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/form-validation.css')}}" />

        <!-- Styles -->

        <script src="{{asset('assets\vendor\js\bootstrap.js')}}"></script>
        <script src="{{asset('assets\vendor\js\helpers.js')}}"></script>
        <script src="{{asset('assets\vendor\js\template-customizer.js')}}"></script>
        <script src="{{asset('assets\js/main.js')}}"></script>
        <script src="{{asset('assets\vendor\libs\flatpickr\flatpickr.js')}}"></script>
        <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

    </head>
    <body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                @include('layouts.sidebar')
            </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    @include('layouts.navigation')
                </nav>
                <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                @session('status')
                            <div>{{$value}}</div>
                        @endsession
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                {{ $slot }}
                </div>
                <footer class="content-footer footer bg-footer-theme"></footer>
            </div>
        </div>
    </div>

        </div>
    </body>
</html>
