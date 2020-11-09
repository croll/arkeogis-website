const path = require("path");
require("babel-register");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const webpack = require('webpack');
const config = {
  mode: "development",
  watch: true,
  devtool: "inline-cheap-source-map",
  watchOptions: {
    ignored: ["node_modules/**"],
  },
  entry: { bundle: "./app/index.js", style: "./sass/style.scss"},
  plugins: [
    new MiniCssExtractPlugin({
      // filename: "style.min.css",
      filename: "[name].css",
      chunkFilename: '[id].css'
    }),
  ],
  output: {
    filename: "[name].js",
    path: path.resolve(__dirname, "../assets"),
    libraryTarget: "var",
    library: "Beve",
  },
  // optimization: {
  //   splitChunks: {
  //     chunks: "all",
  //   },
  // },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: ["babel-loader"],
      },
      {
        test: /\.css$/,
        use: [MiniCssExtractPlugin.loader , "css-loader"],
      },
      {
        test: /\.s[a|c]ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: { url: false, sourceMap: true },
          },
          // 'postcss-loader',
          "sass-loader",
        ],
      },
    ],
  },
};

module.exports = config;
