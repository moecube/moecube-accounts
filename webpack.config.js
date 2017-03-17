const path = require('path');

const BUILD_DIR = path.resolve(__dirname, 'public');
const APP_DIR = path.resolve(__dirname, 'src');

module.exports = {
    entry: `${APP_DIR}/index`,
    output: {
        path: BUILD_DIR,
        filename: "index.js"
    },
    module: {
        loaders: [
            {
                test: /.js$/,
                include: APP_DIR,
                loader: "babel-loader"
            }
        ]
    }
};
