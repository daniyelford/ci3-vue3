const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  publicPath: process.env.VUE_APP_API_BASE_PATH,
  transpileDependencies: true
})