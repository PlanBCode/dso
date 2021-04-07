<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    @include('snippet/favicon')
</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-200 {{ $darkPrefix }}bg-gray-900 {{ $itemsCenter ?? '' ? 'sm:items-center' : '' }} sm:pt-6">

        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ route('admin-home') }}" class="text-sm text-gray-700 underline">admin</a> |
                    <a href="{{ route('logout') }}" class="text-sm text-gray-700 underline"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
{{--                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">log in</a>--}}

{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>--}}
{{--                    @endif--}}
                @endauth
            </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @include('snippet/logo')
            @yield('content')
        </div>

    </div>

    @include('modals/assistant.create')
    @include('modals/assistant.after-create')

    <!-- Modals -->
    @yield('modals')

    <!-- Scripts -->
    @yield('scripts')
</body>
</html>
