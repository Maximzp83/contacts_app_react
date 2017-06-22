/**
 * Created by maxim on 09.06.17.
 */

const ExtractTextPlugin = require("extract-text-webpack-plugin");

var path = require('path');

module.exports = {
    target: "web",
    entry: ['./resources/assets/js/index.js'],

    output: {
        path: './public/build',
        filename: "main.js"
    },


    resolve: {
        extensions: ["", ".web.js", ".js", ".jsx", '.css', '.less'],
        root: path.resolve(__dirname, "resources/assets/js"),
        modulesDirectories: ["node_modules"],
    },

    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: "babel-loader?stage=0",
                exclude: [path.resolve(__dirname, 'node_modules')],
                include: [path.resolve(__dirname, 'resources/assets/js')],
                presets: ['react', 'es2015'],
            },

            {
                test: /\.jsx$/,
                loader: "babel-loader?stage=0",
                exclude: [path.resolve(__dirname, 'node_modules')],
                include: [path.resolve(__dirname, 'resources/assets/js')],
                presets: ['react', 'es2015'],
            },

            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract('style-loader', 'css'),
            },

            {
                test: /\.ttf|eot$/,
                loader: "file-loader",
            },

            {
                test: /\.png|jpg|jpeg|gif|svg|ico$/,
                loader: "url-loader?limit=5000",
            }
        ]

    },

    plugins: [new ExtractTextPlugin("[name].css")]
};
