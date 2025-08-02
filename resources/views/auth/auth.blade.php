<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-wide customizer-hide"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, user-scalable=no, minimum-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (request()->routeIs('laradmin.register'))
            Register
        @elseif (request()->routeIs('laradmin.force-password.*'))
            Change Password
        @else
            Login
        @endif
        · {{ config('app.name') }}
    </title>

    {{-- Favicon (optional) --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('vendor/laradmin/assets/img/favicon/favicon.ico') }}" />

    {{-- Google font (optional) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    {{-- Package CSS --}}
    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/css/demo.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('vendor/laradmin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/laradmin/assets/vendor/css/pages/page-auth.css') }}" />

    {{-- Helpers / config --}}
    <script src="{{ asset('vendor/laradmin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/js/config.js') }}"></script>

    <style>
        .error {
            color: #b91c1c;
            font-size: .9rem;
            margin-top: .25rem;
        }

        .flash {
            margin-bottom: 1rem;
            padding: .75rem 1rem;
            border-radius: .5rem;
            background: #ecfdf5;
            color: #065f46;
        }
    </style>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        {{-- Brand --}}
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo"><span class="text-primary"></span></span>
                                <span class="app-brand-text demo text-heading fw-bold">{{ config('app.name') }}</span>
                            </a>
                        </div>

                        {{-- Flash message --}}
                        @if (session('status'))
                            <div class="flash">{{ session('status') }}</div>
                        @endif

                        {{-- =========================
                         REGISTER FORM (route: laradmin.register)
                       ========================= --}}
                        @if (request()->routeIs('laradmin.register'))
                            <h4 class="mb-1">Create your account</h4>
                            <p class="mb-6">Public registration creates a <strong>user</strong> account.</p>

                            <form id="formRegister" class="mb-6" method="POST"
                                action="{{ route('laradmin.register') }}">
                                @csrf
                                <div class="mb-6">
                                    <label for="name" class="form-label">Full name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="Full name" required />
                                </div>

                                <div class="mb-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Enter your email" required />
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-password-toggle mb-6">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="••••••••••••" required />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="icon-base bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <div class="form-password-toggle mb-6">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password_confirmation" class="form-control"
                                            name="password_confirmation" placeholder="••••••••••••" required />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="icon-base bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <div class="my-7">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="terms-conditions"
                                            name="terms" />
                                        <label class="form-check-label" for="terms-conditions">
                                            I agree to <a href="javascript:void(0);">privacy policy & terms</a>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
                            </form>

                            <p class="text-center">
                                <span>Already have an account?</span>
                                <a href="{{ route('laradmin.login') }}"><span>Sign in instead</span></a>
                            </p>
                        @endif

                        {{-- =========================
                         LOGIN FORM (route: laradmin.login)
                       ========================= --}}
                        @if (request()->routeIs('laradmin.login'))
                            <h4 class="mb-1">Welcome back</h4>
                            <p class="mb-6">Sign in to continue.</p>

                            <form id="formLogin" method="POST" action="{{ route('laradmin.login') }}">
                                @csrf
                                <div class="mb-6">
                                    <label for="login-email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="login-email" name="email"
                                        value="{{ old('email') }}" placeholder="Email" required />
                                    @error('email')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-password-toggle mb-6">
                                    <label class="form-label" for="login-password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="login-password" class="form-control"
                                            name="password" placeholder="••••••••••••" required />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="icon-base bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="remember"> Remember me
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary d-grid w-100">Login</button>
                            </form>

                            <p class="text-center">
                                <span>New here?</span>
                                <a href="{{ route('laradmin.register') }}"><span>Create an account</span></a>
                            </p>
                        @endif

                        {{-- ======================================
                         FORCE PASSWORD FORM (route: laradmin.force-password.show)
                       ====================================== --}}
                        @if (request()->routeIs('laradmin.force-password.*'))
                            <h4 class="mb-1">Set a new password</h4>
                            <p class="mb-6">For security, please update your password.</p>

                            <form id="formForcePassword" method="POST"
                                action="{{ route('laradmin.force-password.update') }}">
                                @csrf
                                <div class="form-password-toggle mb-6">
                                    <label class="form-label" for="new-password">New password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="new-password" class="form-control"
                                            name="password" placeholder="••••••••••••" required />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="icon-base bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <div class="form-password-toggle mb-6">
                                    <label class="form-label" for="new-password-confirm">Confirm password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="new-password-confirm" class="form-control"
                                            name="password_confirmation" placeholder="••••••••••••" required />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="icon-base bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary d-grid w-100">Update password</button>
                            </form>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Package JS --}}
    <script src="{{ asset('vendor/laradmin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('vendor/laradmin/assets/js/main.js') }}"></script>
</body>

</html>
