const { defineConfig } = require('@vue/cli-service')
const path = require('path')
const basePath = path.basename(path.dirname(__dirname))
module.exports = defineConfig({
  publicPath: `/codeigniter/${basePath}/`,
  transpileDependencies: true
})
