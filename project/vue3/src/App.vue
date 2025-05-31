<template>
  <div id="app">
    <nav>
      <router-link to="/">خانه</router-link> |
      <router-link to="/about">درباره</router-link> |
      <router-link to="/upload" v-if="isLoggedIn">آپلود</router-link> 
      <router-link to="/login" v-if="!isLoggedIn">ورود</router-link> |
      <a href="#" v-if="isLoggedIn" @click.prevent="logout">خروج</a>
    </nav>
    <router-view />
  </div>
</template>

<script>
import { sendApi } from './utils/api'
export default {
  name: "App",
  data() {
    return {
      isLoggedIn: false,
    }
  },
  mounted() {
    this.checkLogin()
    window.addEventListener("storage", this.checkLogin)
  },
  beforeUnmount() {
    window.removeEventListener("storage", this.checkLogin)
  },
  methods: {
    checkLogin() {
      this.isLoggedIn = !!localStorage.getItem("isLogin")
    },
    async logout() {
      localStorage.removeItem("isLogin")
      this.isLoggedIn = false
      const res = await sendApi(JSON.stringify({ action: 'logout' }));
      if (res.status === 'success') {
        this.$router.push("/login")
      } else {
        alert('خطا در خروج از حساب');
      }
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
