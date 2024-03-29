const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/chart.js", "public/js/chart.js")
    .js("resources/js/alpine.js", "public/js/alpine.js")
    .js("resources/js/mathlive.js", "public/js/mathlive.js")
    .postCss(
        "node_modules/mathlive/dist/mathlive-fonts.css",
        "public/css/mathlive-fonts.css"
    )
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")]);

