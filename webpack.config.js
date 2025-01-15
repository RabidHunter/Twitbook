const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    mode: 'production',
    entry: {
        script_twitter: './src/script_twitter.js',
        style: './src/sass/style.scss',
        style_twitter: './src/sass/style_twitter.scss',
        redirect:  './src/sass/redirect.scss'
    },
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: '[name].js'
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [MiniCssExtractPlugin.loader,'css-loader', 'sass-loader']
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css'
        }),
    ]
};
