<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @php($kanbanFlash = ['success' => session('success'), 'error' => session('error'), 'errors' => $errors->any() ? $errors->all() : []])
        <script type="application/json" id="kanban-flash">@json($kanbanFlash)</script>

        @vite(['resources/css/app.css', 'resources/js/guest.js'])
    </head>
    <body class="bg-sena-gray50 text-sena-gray900 antialiased">
        {{ $slot }}
    </body>
</html>
