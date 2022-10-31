const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix.setPublicPath('public');
mix.setResourceRoot('../');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/css/app.scss', 'public/css')
    .purgeCss();