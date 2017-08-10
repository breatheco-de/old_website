var path = require('path');
const pathToJS = path.resolve(__dirname, './wp-content/themes/thedocs-child/src/js');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
var ModernizrWebpackPlugin = require('modernizr-webpack-plugin');
const webpack = require('webpack');

// Create multiple instances 
const extractMainStyles = new ExtractTextPlugin('../style.css');
//var  includeMainStylesPath = [ path.resolve(__dirname, "./wp-content/themes/thedocs-child/src/style.scss") ];


module.exports = {
  entry: {
    app: pathToJS+'/app.js',
    vendor: [
      pathToJS+"/vendor/mfb"
    ]
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, './wp-content/themes/thedocs-child/public'),
    publicPath: '/wp-content/themes/thedocs-child/public/'
  },
  module: {
    rules: [
      { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" },
      { test: /\.scss$/,
        use: extractMainStyles.extract({
          fallback: "style-loader",
          use: ['css-loader', 'sass-loader']
        })
      }, //css only files
      
      { test: /\.(png|svg|jpg|gif)$/, use: ['file-loader'] }, //for images
      { test: /\.woff($|\?)|\.woff2($|\?)|\.ttf($|\?)|\.eot($|\?)|\.svg($|\?)/, use: ['file-loader'] } //for fonts
    ]
  },
  plugins: [
    extractMainStyles,
    new ModernizrWebpackPlugin(),
    new webpack.optimize.CommonsChunkPlugin({ name: "vendor", filename: "vendor.js" })
  ]
};