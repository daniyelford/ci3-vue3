<script setup>
  import { onMounted } from 'vue'
  import { useUserStore } from '@/stores/user'
  import NotificationMenu from '@/components/tooles/nav/NotificationMenu.vue'
  import { BASE_URL } from '@/config'
  const logo = BASE_URL + '/assets/images/logo.png'
  const user = useUserStore()
  onMounted(() => {
    user.fetchUserInfo()
  })
  function formatPrice(price) {
    if (!price && price !== 0) return '-'
    return new Intl.NumberFormat('fa-IR').format(price) + ' تومان'
  }
</script>
<template>
  <div class="nav">
    <div class="user-info">
      <div v-if="user.image" class="img">
        <img :src="user.image" alt="user image" />
      </div>
      <div v-else class="img">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><g><rect fill="none" height="24" width="24"/></g><g><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm0 14c-2.03 0-4.43-.82-6.14-2.88C7.55 15.8 9.68 15 12 15s4.45.8 6.14 2.12C16.43 19.18 14.03 20 12 20z"/></g></svg>
      </div>
      <div class="other-info">
        <span>{{ user.name }}</span>
        <br />
        <span style="font-size: 10px;">{{ formatPrice(user.wallet) }}</span>
      </div>
      <NotificationMenu v-if="user.isLoggedIn" />
    </div>
    <div class="logo">
      <img :src="logo" alt="logo" />
    </div>
  </div>
</template>
<style scoped>
  .nav,.logo,
  .user-info{
    direction: rtl;
    display: flex;
    flex-direction: row-reverse;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: stretch;
    gap: 7px;
    padding: 4px 5px 0 5px;
    box-sizing: border-box;
  }
  img,svg{
    height: 100%;
    width: 100%;
  }
  .img{
    height: 40px;
    width: 40px;
  }
  .img img,.img svg{
    border-radius: 50px;
  }
  .logo {
    height: 45px;
    width: auto;
  }
  span {
    margin: 3px;
    display: inline-block;
  }
  .other-info{
    margin-left: 5px;
  }
</style>