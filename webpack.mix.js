const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .copyDirectory('resources/images', 'public/images')
    .copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce')
    
    .sass('resources/sass/vendor.scss', 'public/css/vendor.css')
    .postCss('resources/css/style.css', 'public/css/style.css')

    .js('resources/js/app.js', 'public/js')
    .js('resources/js/auth.js', 'public/js')
    .js('resources/js/register.js', 'public/js')
    .js('resources/js/newTopic.js', 'public/js')
    .js('resources/js/answerActions.js', 'public/js')


    .version();
