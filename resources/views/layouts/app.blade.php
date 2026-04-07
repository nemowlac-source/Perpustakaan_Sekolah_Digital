<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Perpustakaan') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .sidebar-transition {
            transition: margin-left 0.3s ease-in-out;
        }
    </style>
</head>

<body class="font-sans antialiased min-h-screen">

    <div class="min-h-screen relative">
        {{-- Logika Switch Navbar --}}
        @auth
            @if (Auth::user()->role === 'admin')
                @include('layouts.nav-admin')
            @else
                @include('layouts.nav-siswa')
            @endif
        @endauth

        <!-- Page Content -->
        <main
            class="py-8 mx-auto px-4 lg:px-8 sidebar-transition @auth @if (Auth::user()->role === 'admin') ml-64 w-[calc(100%-16rem)] @else w-full @endif @else w-full @endauth min-h-screen flex flex-col min-w-0 overflow-x-hidden">
            {{-- Alert Flash Message --}}
            @if (session('success'))
                <div class="alert alert-success mb-6 shadow-lg border-l-4 border-success animate-fade-in">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error mb-6 shadow-lg border-l-4 border-error animate-fade-in">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-error-content" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        <span class="text-error-content">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    <!-- Custom CSS for animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>

</body>

</html>
