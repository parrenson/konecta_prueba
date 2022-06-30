const mix = require('laravel-mix');
var path = require('path');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
 mix.alias({
    'store': path.join(__dirname, 'resources/js/store')
});



mix.js('resources/js/app.js', 'public/js').vue()
 .postCss('resources/css/app.css', 'public/css');
    
mix.copy('resources/assets', 'public/assets');
