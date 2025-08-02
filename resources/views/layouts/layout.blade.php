<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-menu-fixed layout-compact"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', 'Laradmin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">
    @php
        $assetFn = function (string $path) {
            if (function_exists('laradmin_asset')) {
                return laradmin_asset($path);
            }
            return asset('vendor/laradmin/' . $path);
        };
    @endphp
    <link rel="stylesheet" href="{{ $assetFn('css/laradmin.css') }}">
    @stack('head')
   
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/vendor/css/pages/page-icons.css') }}" />
    <script src="{{ asset('vendor/laradmin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('laradmin::layouts.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                @include('laradmin::layouts.navbar')
                <div class="content-wrapper">
                    @if (session('status'))
                        <div class="flash flash-success">{{ session('status') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="flash flash-error">
                            @foreach ($errors->all() as $err)
                                <div>{{ $err }}</div>
                            @endforeach
                        </div>
                    @endif
                    @yield('content')
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="mb-2 mb-md-0"> <small>© {{ date('Y') }}
                                        {{ config('app.name', 'Laradmin') }} · Admin ❤️</small>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('vendor/laradmin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/js/main.js') }}"></script>
</body>

</html>
