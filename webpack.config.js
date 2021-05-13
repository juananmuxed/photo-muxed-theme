const path = require('path')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CopyPlugin = require('copy-webpack-plugin')
const IgnoreEmitPlugin = require('ignore-emit-webpack-plugin');
const autoprefixer = require('autoprefixer');

const finalPath = path.resolve(__dirname, 'dist')

const fs = require('fs');

const jsFiles = fs.readdirSync('./src/js/')
let entry = {}

jsFiles.forEach(f => {
    if(!f.endsWith('.js')) return;
    const name = f.split('.')[0];
    entry[name] = './src/js/' + f;
})

entry.bundle = './src/scss/bundle.scss';

module.exports = {
    mode: 'development',
    entry: entry,
    output: {
        filename: 'js/[name].js'
    },
    module: {
        rules: [
            {
                test: /\.js$/, exclude: /node_modules/,
                use: {
                    loader: "babel-loader", 
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                }
            },
            {
                test: /\.(sass|scss)$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader','sass-loader',
                    { loader: 'postcss-loader', 
                        options: { 
                            postcssOptions: {
                                plugins: [autoprefixer()] 
                            }
                        }
                    },
                ]
            } 
        ]
    },
    plugins: [
        new CopyPlugin([
            { from: './src/fonts', to: path.join(finalPath, '/fonts'), force: true },
            { from: './src/img', to: path.join(finalPath, '/images'), force: true },
        ]),
        new BrowserSyncPlugin({
            host: 'localhost',
            port: 3000,
            proxy: "http://localhost"
        }),
        new MiniCssExtractPlugin({
            filename: './css/[name].css',
        }),
        new IgnoreEmitPlugin(['bundle.js'])

    ],

}