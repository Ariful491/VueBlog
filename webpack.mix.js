const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/frontend.js', 'public/js/frontend.js')
    .sass('resources/sass/frontend/app.scss', 'public/css/frontend.css');
