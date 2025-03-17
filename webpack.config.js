const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

module.exports = {
    mode: 'development',
    entry: {
        redirect: './src/js/redirect.js',
        style: './src/js/style.js',
        style_twitter: './src/js/style_twitter.js',
    },
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'js/[name].js',
        clean: true,
        assetModuleFilename: '[name][ext]'
    },
    devServer: {
        static: {
          directory: path.resolve(__dirname, 'dist'),
        },
        port: 8080,
        hot: true,
        open: true,
      },
    module: {
        rules: [
          {
            test: /\.scss$/,
            use: [
              'style-loader',
              'css-loader',
              'sass-loader', 
            ],
          },
          {
            test: /\.(png|jpe?g|gif)$/,
            type: "asset/resource",
            generator: {
              filename: "assets/img/[name][ext]"
            },
          },
          {
            test: /\.svg$/,
            type: "asset/resource",
            generator: {
              filename: "assets/icons/[name][ext]"
            },
          },
          {
            test: /\.html$/,
            use: 'html-loader'
          },           
        ]
    },
    plugins: [
      new CopyWebpackPlugin({
        patterns: [
          { from: 'src/uploads', to: 'uploads' },
          {
            from: path.resolve(__dirname, 'src/php'), 
            to: path.resolve(__dirname, 'dist/php')
          }
        ],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/empty.html',
        filename: 'templates/empty.html',
        chunks: ['redirect'],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/failed_login.html',
        filename: 'templates/failed_login.html',
        chunks: ['redirect'],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/failed_register.html',
        filename: 'templates/failed_register.html',
        chunks: ['redirect'],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/index.html',
        filename: 'templates/index.html',
        chunks: ['style'],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/sign_in.html',
        filename: 'templates/sign_in.html',
        chunks: ['style'],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/success.html',
        filename: 'templates/success.html',
        chunks: ['redirect'],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/home_front.html',
        filename: 'templates/home_front.html',
        chunks: ['style_twitter'],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/my_tweets_front.html',
        filename: 'templates/my_tweets_front.html',
        chunks: ['style_twitter'],
      }),
      new HtmlWebpackPlugin({
        template: './src/templates/edit_tweet_front.html',
        filename: 'templates/edit_tweet_front.html',
        chunks: ['style_twitter'],
      }),
    ]
};
