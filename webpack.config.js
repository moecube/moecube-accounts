var path = require('path')

var BUILD_DIR = path.resolve(__dirname, 'public/assets')
var APP_DIR = path.resolve(__dirname, 'public/src')

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
        include : APP_DIR,
        loader: "babel-loader"
      }
    ]
  }
}