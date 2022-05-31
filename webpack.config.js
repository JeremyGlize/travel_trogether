const Encore = require('@symfony/webpack-encore');

// const MiniCssExtractPlugin = require("mini-css-extract-plugin");
// const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
// const TerserPlugin = require('terser-webpack-plugin');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.scss) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')
    // .addEntry('login', './assets/js/login.js')
    .configureFilenames({
        js: 'assets/js/[name].js',
        css: 'assets/css/[name].css'
    })

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    //enables Sass/SCSS support
    .enableSassLoader()
    .enablePostCssLoader()

    // .addPlugin(new CssMinimizerPlugin({
    //     minify: CssMinimizerPlugin.cssoMinify,
    //     parallel: true
    // }))

    // .addPlugin(new MiniCssExtractPlugin())

    // .addLoader({
    //     test: /\.(sc|sa|c)ss$/,
    //     use: [MiniCssExtractPlugin.loader,
    //         { loader: "css-loader", options: { sourceMap: true } },
    //         { loader: "postcss-loader", options: { sourceMap: true } },
    //         { loader: "sass-loader", options: { sourceMap: true } },]
    // })
    // .configureTerserPlugin((options) => {
    //     options.cache = true;
    //     options.minimize = true;
    // })
    // .addPlugin(new TerserPlugin({
    //     minify: TerserPlugin.uglifyJsMinify,
    //     terserOptions: {
    //         output: {
    //             comments: false
    //         }
    //     },
    //     extractComments: false,
    //     parallel: true
    // }))
    // .addLoader({
    //     test: /\.js(\?.*)?$/i,
    //     exclude: /node_modules/,
    //     loader: "babel-loader"
    // })

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

    .copyFiles({
        from: './assets/images',
        to: '/images/[path][name].[ext]',
        pattern: /\.(png|jpg|jpeg|gif|svg)/,
    })

    .cleanupOutputBeforeBuild();

module.exports = Encore.getWebpackConfig();
