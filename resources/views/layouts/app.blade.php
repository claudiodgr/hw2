<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
        @stack('scripts')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <nav class="navbar">
                <div class="logo">
                    tuneshare | <span class="user-nav">{{ Auth::user()->username }}</span>
                </div>
                <!-- Add the hamburger menu icon -->
                <div class="hamburger-menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>

                <!-- Add the navigation drawer container -->
                <div id="navigation-drawer" class="navigation-drawer">
                    <ul class="drawer-menus">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('search')}}">Search</a></li>
                        <li><a href="{{route('people')}}">Contacts</a></li>
                        <li><a href="{{route('library')}}">My Library</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Add the backdrop container -->
                <div id="backdrop" class="backdrop"></div>

                <ul class="menus">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('search')}}">Search</a></li>
                    <li><a href="{{route('people')}}">Contacts</a></li>
                    <li><a href="{{route('library')}}">My Library</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
