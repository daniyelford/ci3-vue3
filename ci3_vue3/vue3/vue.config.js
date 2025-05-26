const { defineConfig } = require('@vue/cli-service')
const { BASE_PATH } = require('./src/config')
module.exports = defineConfig({
  publicPath: BASE_PATH,
  transpileDependencies: true
})