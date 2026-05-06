import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Work Sans"', 'system-ui', '-apple-system', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                sena: {
                    /* Manual / identidad SENA 2024 */
                    green: '#39A900',
                    darkgreen: '#007832',
                    navy: '#00304D',
                    violet: '#71277A',
                    sky: '#50E5F9',
                    yellow: '#FDC300',
                    graybg: '#F6F6F6',
                    colbg: '#F3F4F6',
                    /* Compatibilidad vistas existentes */
                    greenHover: '#007832',
                    greenLight: '#EDF7E6',
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
                xl: '0.75rem',
            },
            boxShadow: {
                card: '0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06)',
                drag: '0 4px 12px rgba(57, 169, 0, 0.25)',
                sidebar: '4px 0 24px rgba(0, 48, 77, 0.12)',
            },
            spacing: {
                sidebar: '256px',
                sidebarCollapsed: '64px',
            },
        },
    },

    plugins: [forms],
};
