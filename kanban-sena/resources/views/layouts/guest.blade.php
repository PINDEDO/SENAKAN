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
                    }
                }
            }
        </script>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="bg-sena-gray50 text-sena-gray900 antialiased">
        {{ $slot }}
    </body>
</html>
