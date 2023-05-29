const path = require('path');

const MiniCssExtractPlugin = require("mini-css-extract-plugin")

module.exports = {
  entry: ['./www/js/proj-form.js','./www/js/button.js','./www/js/header.js','./www/js/skills.js','./www/js/main-naja.js',
        './www/css/button.css','./www/css/contact.css','./www/css/general.css','./www/css/header.css','./www/css/portfolio.css','./www/css/responsive.css','./www/css/skills.css','./www/css/slider.css'],



  mode: (process.env.NODE_ENV === 'production') ? 'production' : 'development',
  resolve: {
    extensions: ['*', '.js', '.jsx']
  },
  output: {
    filename: 'bundle.js',
    path: path.join(__dirname, 'www', 'assets'),
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "style.css",
    }),
  ],
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader
          },
          "css-loader",
        ]
      }
    ]
  }
};

