<template>
    <div class="nav-top">
        <TopNav />
    </div>
    <div class="content">
        <NewsCards v-if="props.view === 'dashboard'" />
        <AddNewsForm v-else-if="props.view === 'add-news'"/>
        <WalletCards v-else-if="props.view === 'wallet'"/>
        <ReportList v-else-if="props.view === 'report-list'" />
        <ManageNews v-else-if="props.view === 'manage-news'" />
        <UserSetting v-else-if="props.view === 'user-setting'" />
        <AllCartables v-else-if="props.view === 'cartable'" />
        <ShowCartable v-else-if="props.view === 'show-cartable'" :id="props.id" />
        <p v-else>نمایش مشخصی یافت نشد</p>
    </div>
    <div class="nav-bottom">
        <BottomNav v-if="props.view === 'dashboard'" :Wallet="true" :list="true" :add="true" :manage="true" :setting="true"/>
        <BottomNav v-else-if="props.view === 'add-news'" :Wallet="true" :list="true" :add="false" :manage="true" :setting="true"/>
        <BottomNav v-else-if="props.view === 'wallet'" :Wallet="false" :list="true" :add="true" :manage="true" :setting="true"/>
        <BottomNav v-else-if="props.view === 'report-list'" :Wallet="true" :list="false" :add="true" :manage="true" :setting="true"/>
        <BottomNav v-else-if="props.view === 'manage-news'" :Wallet="true" :list="true" :add="true" :manage="false" :setting="true"/>
        <BottomNav v-else-if="props.view === 'user-setting'" :Wallet="true" :list="true" :add="true" :manage="true" :setting="false"/>
        <BottomNav v-else-if="props.view === 'cartable'" :Wallet="false" :list="true" :add="true" :manage="true" :setting="true"/>
        <BottomNav v-else-if="props.view === 'show-cartable'" :Wallet="true" :list="true" :add="true" :manage="true" :setting="true"/>
        <p v-else>نمایش مشخصی یافت نشد</p>
    </div>
</template>
<script setup>
    import TopNav from '@/components/dashboard/menus/TopNav.vue';
    import BottomNav from '@/components/dashboard/menus/BottomNav.vue';
    import AddNewsForm from '@/components/dashboard/pagesContent/AddNewsForm.vue';
    import AllCartables from '@/components/dashboard/pagesContent/AllCartables.vue';
    import NewsCards from '@/components/dashboard/pagesContent/NewsCards.vue';
    import ManageNews from '@/components/dashboard/pagesContent/ManageNews.vue';
    import ReportList from '@/components/dashboard/pagesContent/ReportList.vue';
    import ShowCartable from '@/components/dashboard/pagesContent/ShowCartable.vue';
    import UserSetting from '@/components/dashboard/pagesContent/UserSetting.vue';
    import WalletCards from '@/components/dashboard/pagesContent/WalletCards.vue';
    import { defineProps } from 'vue'
    const props = defineProps({
        view: String,
        id: [String, Number]
    })
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
        padding: 10px;
        height: auto;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .nav-bottom{
        height: 60px;
        bottom: 0;
    }
</style>