var path = require('path');

module.exports = {
  entry: './wp-content/themes/thedocs-child/src/js/app.js',
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, './wp-content/themes/thedocs-child/public')
  }
};