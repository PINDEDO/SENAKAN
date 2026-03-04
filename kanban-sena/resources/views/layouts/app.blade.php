<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Tailwind Play CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            sena: {
                                green: '#39A900',
                                greenHover: '#2D8800',
                                greenLight: '#EDF7E6',
                                navy: '#003770',
                                navyLight: '#E0E9F5',
                                white: '#FFFFFF',
                                gray50: '#F4F6F8',
                                gray100: '#E8ECEF',
                                gray200: '#D1D8DF',
                                gray400: '#8E9BAA',
                                gray700: '#3D4F60',
                                gray900: '#1A2533',
                            },
                        },
                        fontFamily: {
                            sans: ['Inter', 'Arial', 'sans-serif'],
                        },
                        borderRadius: {
                            sm: '4px',
                            md: '8px',
                            lg: '12px',
                            xl: '16px',
                        },
                        boxShadow: {
                            card: '0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.06)',
                            sidebar: '4px 0 24px rgba(0,55,112,0.10)',
                        },
                        spacing: {
                            sidebar: '256px',
                            sidebarCollapsed: '64px',
                        }
                    }
                }
            }
        </script>

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="bg-sena-gray50 text-sena-gray900 antialiased">
        <div class="min-h-screen flex">
            @include('layouts.navigation')

            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Page Heading (Topbar placeholder for now) -->
                <header class="h-16 bg-white border-b border-sena-gray100 flex items-center px-8 shrink-0">
                    @isset($header)
                        {{ $header }}
                    @else
                        <h2 class="text-xl font-bold text-sena-gray900">
                             {{ config('app.name') }}
                        </h2>
                    @endisset
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
