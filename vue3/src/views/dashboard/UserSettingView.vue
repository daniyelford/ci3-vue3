<template>
  <div class="nav-top">
    <TopNav :is-wallet="false"/>
  </div>
  <div class="content">
    <UserSetting/>
  </div>
  <div class="nav-bottom">
    <BottomNav :Wallet="true" :list="true" :add="true" :manage="true" :setting="false"/>
  </div>
</template>
<script setup>
  import TopNav from '@/components/dashboard/menus/TopNav.vue';
  import BottomNav from '@/components/dashboard/menus/BottomNav.vue';
  import UserSetting from '@/components/dashboard/pagesContent/UserSetting.vue';
</script>
<style scoped>
  .nav-top,.nav-bottom,.content{
    position: fixed;
    box-shadow: 0 0 6px grey;
    left: 0;
    right: 0;
    box-sizing: border-box;
    border: 1px solid #9b7ca9c4;
  }
  .nav-top{
    height: 60px;
    z-index: 9;
    top: 0;
  }
  .content{
    top: 60px;
    bottom: 60px;
    height: auto;
    padding: 10px;
    overflow-y: auto;
    overflow-x: hidden;
  }
  .nav-bottom{
    height: 60px;
    bottom: 0;
  }
</style>