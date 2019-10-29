const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
       plugins: [
       ],
       resolve: {
         alias: {
           "desktop": path.resolve(__dirname, './resources/assets/js'),
           "common": path.resolve(__dirname, './resources/assets/js/common'),
           "config": path.resolve(__dirname, './resources/assets/js/configs'),
           "requestfactory": path.resolve(__dirname, './resources/assets/js/requests/RequestFactory.js'),
         }
       },
   });
