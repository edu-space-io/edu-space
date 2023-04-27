const Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    // Set output path and public path
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    // Add entry points
    .addEntry('app', './assets/js/app.js')
    .addStyleEntry('css/app', './assets/scss/app.scss')

    // Enable Sass loader
    .enableSassLoader()

    // Enable Autoprefixer
    .enablePostCssLoader()

    // Enable Source Maps
    .enableSourceMaps(!Encore.isProduction())

    // Enable Versioning
    .enableVersioning(Encore.isProduction())

    // Enable runtime chunk
    .enableSingleRuntimeChunk()

    // Split entry chunks
    .splitEntryChunks()

    // Configure image rule
    .configureImageRule({
        filename: 'images/[name].[hash:8].[ext]',
    })

    // Configure font rule
    .configureFontRule({
        filename: 'fonts/[name].[hash:8].[ext]',
    })

    // Configure filenames
    .configureFilenames({
        js: 'js/[name].[contenthash:8].js',
        css: 'css/[name].[contenthash:8].css',
    })

    // Copy Bootstrap assets to build directory
    .addPlugin(new CopyWebpackPlugin({
        patterns: [
            { from: './node_modules/bootstrap/dist/js/*.js', to: 'js/[name].[hash:8].[ext]' },
            { from: './node_modules/bootstrap/dist/css/*.css', to: 'css/[name].[hash:8].[ext]' },
            { from: './node_modules/@popperjs/core/dist/umd/popper.min.js', to: 'js/[name].[hash:8].[ext]' },
        ]
    }));

module.exports = Encore.getWebpackConfig();
