const path = require("path");
require("babel-register");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const config = {
  mode: "development",
  watch: true,
  devtool: "inline-cheap-source-map",
  watchOptions: {
    ignored: ["node_modules/**"],
  },
  entry: ["./app/index.js", "./sass/style.scss"],
  plugins: [
    new MiniCssExtractPlugin({
      filename: "style.min.css",
      // chunkFilename: "[name].css",
    }),
  ],
  output: {
    filename: "bundle.js",
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
        use: [MiniCssExtractPlugin.loader, "css-loader"],
      },
      {
        test: /\.s[a|c]ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: { url: false, sourceMap: true },
          },
          "sass-loader",
        ],
      },
    ],
  },
};

module.exports = config;
