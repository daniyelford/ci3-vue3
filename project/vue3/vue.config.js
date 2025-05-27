const { defineConfig } = require('@vue/cli-service');
module.exports = defineConfig({
  publicPath: process.env.VUE_APP_API_BASE_PATH,
  transpileDependencies: true,
  configureWebpack: {
    output: {
      filename: 'assets/js/[name].[contenthash].js',
      chunkFilename: 'assets/js/[name].[contenthash].js',
    }
  },
  css: {
    extract: {
      filename: 'assets/css/[name].[contenthash].css',
      chunkFilename: 'assets/css/[name].[contenthash].css',
    }
  }
});
