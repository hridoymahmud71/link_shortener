const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss"); /* Add this line at the top */

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
mix.setResourceRoot(process.env.MIX_ASSET_URL);
mix.js("resources/js/app.js", "public/app.js")
    .sass("resources/css/app.scss", "public/css/app.css")
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")],
    })
