const mix = require('laravel-mix');

mix.js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/customer.js', 'public/js')
    .js('resources/js/product.js', 'public/js')
    .js('resources/js/alert.js', 'public/js')
    .postCss('resources/css/styles.css', 'public/css', [
        require('tailwindcss'),
    ])
    .babelConfig({
        presets: ['@babel/preset-env'],
    })
    .sourceMaps();
