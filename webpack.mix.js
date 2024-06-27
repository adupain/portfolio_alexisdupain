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
//  mix.webpackConfig({
//     output: {
//         filename:'[name].js',
//         chunkFilename: 'js/chunks/[name].js',
//     },
// });
mix.js('resources/js/app.js', 'public/js')
    // .js('resources/js/custom_functions.js', 'public/js')
    //.js('resources/js/modal-confirmation.js', 'public/js')
    // .js('resources/js/network.js', 'public/js')
    .vue({ version: 2 })
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

