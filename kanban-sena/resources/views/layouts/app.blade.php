<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-sena-graybg">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SenaKan') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        @php($kanbanFlash = ['success' => session('success'), 'error' => session('error'), 'errors' => $errors->any() ? $errors->all() : []])
        <script type="application/json" id="kanban-flash">@json($kanbanFlash)</script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full font-sans text-sena-gray900 antialiased">
        <div class="app-layout-shell">
            @include('layouts.navigation')

            <div class="flex min-h-0 min-w-0 flex-1 flex-col overflow-hidden bg-sena-graybg">
                <header class="flex h-16 shrink-0 items-center justify-between gap-4 border-b border-sena-gray200 bg-white px-4 sm:px-8 shadow-sm">
                    <div class="min-w-0 flex-1 flex items-center gap-3">
                        <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-baseline gap-2 shrink-0">
                            <span class="text-lg font-bold text-sena-navy tracking-tight">SenaKan</span>
                            <span class="text-sena-gray400 font-normal text-sm">|</span>
                        </a>
                        <div class="min-w-0 flex-1">
                            @isset($header)
                                {{ $header }}
                            @else
                                <h2 class="text-xl font-semibold text-sena-navy leading-snug">
                                    {{ config('app.name') }}
                                </h2>
                            @endisset
                        </div>
                    </div>

                    <div class="flex shrink-0 items-center space-x-3 sm:space-x-4">
                        <x-notification-bell />
                        <div class="text-right hidden sm:block">
                            <div id="live-clock" class="text-sm font-semibold text-sena-navy tracking-tight tabular-nums">00:00:00</div>
                            <div id="live-date" class="text-[10px] text-sena-gray400 font-medium uppercase tracking-wide">{{ now()->format('d M, Y') }}</div>
                        </div>
                        <div class="h-8 w-px bg-sena-gray200 mx-1 hidden sm:block"></div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto p-6 sm:p-8 bg-sena-graybg">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
