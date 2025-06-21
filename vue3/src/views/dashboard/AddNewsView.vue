<template>
    <div class="nav-top">
        <TopNav :is-wallet="false"/>
    </div>
    <div class="content">
        <AddNewsForm/>
    </div>
    <div class="nav-bottom">
        <BottomNav :search="false" :add="false" :list="true"/>
    </div>
</template>
<script setup>
    import TopNav from '@/components/dashboard/menus/TopNav.vue';
    import BottomNav from '@/components/dashboard/menus/BottomNav.vue';
    import AddNewsForm from '@/components/dashboard/pagesContent/AddNewsForm.vue';
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