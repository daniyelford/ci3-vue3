<template>
  <div class="nav-top">
    <TopNav :is-wallet="false"/>
  </div>
  <div class="content">
    <NewsCards/>
  </div>
  <div class="nav-bottom">
    <BottomNav :search="true" :list="true" :add="true"/>
  </div>
</template>
<script setup>
  import TopNav from '@/components/dashboard/menus/TopNav.vue';
  import BottomNav from '@/components/dashboard/menus/BottomNav.vue';
  import NewsCards from '@/components/dashboard/pagesContent/NewsCards.vue';
</script>
<style scoped>
  .nav-top,.nav-bottom,.content{
    position: fixed;
    box-shadow: 0 0 10px grey;
    left: 0;
    right: 0;
  }
  .nav-top{
    height: 60px;
    top: 0;
  }
  .content{
    top: 60px;
    bottom: 60px;
    height: auto;
  }
  .nav-bottom{
    height: 60px;
    bottom: 0;
  }
</style>