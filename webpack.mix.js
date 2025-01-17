// Substitua o import por require
const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

// Configurações de compilação
mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
      tailwindcss,
   ]);
