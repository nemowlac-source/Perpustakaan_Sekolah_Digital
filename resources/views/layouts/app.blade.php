<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Perpustakaan') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-base-200 min-h-screen">

    <div class="min-h-screen">
        {{-- Logika Switch Navbar --}}
        @auth
            @if(Auth::user()->role === 'admin')
                @include('layouts.nav-admin')
            @else
                @include('layouts.nav-siswa')
            @endif
        @endauth

        <!-- Page Content -->
        <main class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Alert Flash Message --}}
            @if(session('success'))
                <div class="alert alert-success mb-6 shadow-lg">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error mb-6 shadow-lg text-white">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

</body>
</html>
