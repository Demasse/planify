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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Ajout de tes 3 couleurs exclusives ici
            colors: {
                'plan-bg': '#FFFFFF',     // Couleur 1 : Fond (Blanc)
                'plan-main': '#000000',   // Couleur 2 : Texte/Bordures (Noir)
                'plan-accent': '#3B82F6', // Couleur 3 : Action (Bleu - on peut changer le code HEX)
            },
        },
    },
    plugins: [forms],
};
