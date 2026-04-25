import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Arial', ...defaultTheme.fontFamily.sans],
            },
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
            },
        },
    },

    plugins: [forms],
};
