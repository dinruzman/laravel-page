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

        <!-- Styles -->
        @livewireStyles

        <style>
            .bg-sidebar { background: #3d68ff; }
            .cta-btn { color: #3d68ff; }
            .upgrade-btn { background: #1947ee; }
            .upgrade-btn:hover { background: #0038fd; }
            .active-nav-link { background: #1947ee; }
            .nav-item:hover { background: #1947ee; }
            .account-link:hover { background: #3d68ff; }
        </style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="font-sans antialiased bg-gray-100 flex" x-data="{ sidebarOpen: true }">

            @include('sidebar')

            <div class="w-full flex flex-col h-screen overflow-y-scroll">

                <!-- Page Heading -->
        {{--            @if (isset($header))--}}
        {{--                <header class="bg-white shadow">--}}
        {{--                    <div class="py-6 px-4 sm:px-6 lg:px-8 text-2xl">--}}
        {{--                        {{ $header }}--}}
        {{--                    </div>--}}
        {{--                </header>--}}
        {{--            @endif--}}

                <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                    <div class="">
                        <div class="flex justify-between h-12">
                            <header class="w-full items-center bg-white py-2 px-4 hidden sm:flex">
                                <img src="{{ asset('image/icons/burger-menu.png') }}" class="h-6 w-6 cursor-pointer" @click="sidebarOpen = !sidebarOpen">
                                @if (isset($header))
                                    <div class="py-4 px-2 sm:px-6 lg:px-8 text-2xl flex justify-center">
                                        {{ $header }}
                                    </div>
                                @endif
                                <div class="w-1/2"></div>
                                <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                        <div class="ml-3 relative">
                                            <x-dropdown align="right" width="60">
                                                <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->currentTeam->name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                                </x-slot>

                                                <x-slot name="content">
                                                    <div class="w-60">
                                                        <!-- Team Management -->
                                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                                            {{ __('Manage Team') }}
                                                        </div>

                                                        <!-- Team Settings -->
                                                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                            {{ __('Team Settings') }}
                                                        </x-dropdown-link>

                                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                                {{ __('Create New Team') }}
                                                            </x-dropdown-link>
                                                        @endcan

                                                    <!-- Team Switcher -->
                                                        @if (Auth::user()->allTeams()->count() > 1)
                                                            <div class="border-t border-gray-200"></div>

                                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                                {{ __('Switch Teams') }}
                                                            </div>

                                                            @foreach (Auth::user()->allTeams() as $team)
                                                                <x-switchable-team :team="$team" />
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </x-slot>
                                            </x-dropdown>
                                        </div>
                                    @endif

                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                                </button>
                                            @else
                                                <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                            @endif
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Account') }}
                                            </div>

                                            <x-dropdown-link href="{{ route('profile.show') }}">
                                                {{ __('Profile') }}
                                            </x-dropdown-link>

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                    {{ __('API Tokens') }}
                                                </x-dropdown-link>
                                            @endif

                                            <div class="border-t border-gray-200"></div>

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf

                                                <x-dropdown-link href="{{ route('logout') }}"
                                                                    @click.prevent="$root.submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </header>

                            <!-- Mobile Header & Nav -->
                            <header x-data="{ isOpen: false }" class="w-full h-20 bg-sidebar py-5 sm:hidden z-50">
                                <div class="flex items-center justify-between px-6">
                                    <div class="text-white font-semibold uppercase hover:text-gray-300">
                                        {!! $header !!}
                                    </div>
                                    <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                                        <i x-show="!isOpen" class="fa fa-bars"></i>
                                        <i x-show="isOpen" class="fa fa-times"></i>
                                    </button>
                                </div>

                                <!-- Dropdown Nav -->
                                <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col p-6 bg-sidebar">
                                    <a href="index.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                                        Dashboard
                                    </a>
                                    <a href="blank.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                                        Blank Page
                                    </a>
                                    <a href="tables.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                                        Tables
                                    </a>
                                    <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                                        Forms
                                    </a>
                                    <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                                        Tabbed Content
                                    </a>
                                    <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                                        Calendar
                                    </a>
                                    <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                                        Support
                                    </a>
                                    <x-responsive-nav-link class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item" href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                        {{ __('Profile') }}
                                    </x-responsive-nav-link>
                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-responsive-nav-link class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item" href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                            {{ __('API Tokens') }}
                                        </x-responsive-nav-link>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-gray-200">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-responsive-nav-link class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item" href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                            {{ __('Team Settings') }}
                                        </x-responsive-nav-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-responsive-nav-link class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-6 nav-item" href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                                {{ __('Create New Team') }}
                                            </x-responsive-nav-link>
                                        @endcan

                                    <!-- Team Switcher -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-200">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                                            @endforeach
                                        @endif
                                    @endif

                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-responsive-nav-link class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item" href="{{ route('logout') }}"
                                                                @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-responsive-nav-link>
                                    </form>
                                </nav>
                            </header>
                        </div>
                    </div>
                </nav>

            <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

            @stack('modals')
        </div>

        @livewireScripts
    </body>
</html>
