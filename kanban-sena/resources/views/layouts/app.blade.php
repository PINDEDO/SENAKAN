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

                    <!-- Digital Clock -->
                    <div class="flex items-center space-x-4">
                        <div class="text-right hidden sm:block">
                            <div id="live-clock" class="text-sm font-bold text-sena-navy tracking-tight">00:00:00</div>
                            <div id="live-date" class="text-[10px] text-sena-gray400 font-medium uppercase">{{ now()->format('d M, Y') }}</div>
                        </div>
                        <div class="h-8 w-px bg-sena-gray100 mx-2"></div>
                    </div>
                </header>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    function updateClock() {
                        const now = new Date();
                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');
                        
                        const clockElement = document.getElementById('live-clock');
                        if (clockElement) {
                            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
                        }
                    }
                    setInterval(updateClock, 1000);
                    updateClock();

                    // SweetAlert Universal Notifications
                    document.addEventListener('DOMContentLoaded', function() {
                        @if(session('success'))
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: "{{ session('success') }}",
                                timer: 3000,
                                showConfirmButton: false,
                                background: '#FFFFFF',
                                color: '#1A2533',
                                iconColor: '#39A900'
                            });
                        @endif

                        @if(session('error'))
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "{{ session('error') }}",
                                background: '#FFFFFF',
                                color: '#1A2533',
                                iconColor: '#DC2626'
                            });
                        @endif

                        @if($errors->any())
                            Swal.fire({
                                icon: 'warning',
                                title: 'Atención',
                                html: '<ul class="text-left text-sm">@foreach($errors->all() as $error)<li><i class="bi bi-exclamation-circle mr-1"></i> {{ $error }}</li>@endforeach</ul>',
                                background: '#FFFFFF',
                                color: '#1A2533',
                                iconColor: '#F59E0B'
                            });
                        @endif
                    });
                </script>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
