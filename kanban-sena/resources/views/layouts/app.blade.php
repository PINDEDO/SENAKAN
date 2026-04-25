<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @php($kanbanFlash = ['success' => session('success'), 'error' => session('error'), 'errors' => $errors->any() ? $errors->all() : []])
        <script type="application/json" id="kanban-flash">@json($kanbanFlash)</script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-sena-gray50 text-sena-gray900 antialiased">
        <div class="min-h-screen flex">
            @include('layouts.navigation')

            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="h-16 bg-white border-b border-sena-gray100 flex items-center justify-between px-8 shrink-0">
                    <div>
                        @isset($header)
                            {{ $header }}
                        @else
                            <h2 class="text-xl font-bold text-sena-gray900">
                                 {{ config('app.name') }}
                            </h2>
                        @endisset
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="text-right hidden sm:block">
                            <div id="live-clock" class="text-sm font-bold text-sena-navy tracking-tight">00:00:00</div>
                            <div id="live-date" class="text-[10px] text-sena-gray400 font-medium uppercase">{{ now()->format('d M, Y') }}</div>
                        </div>
                        <div class="h-8 w-px bg-sena-gray100 mx-2"></div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
