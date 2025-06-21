<template>
    <div class="nav">
        <div v-if="props.search" class="search">
            <a v-if="!showSearch" @click.prevent="showSearchFunc" class="search-show">
                <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 -960 960 960"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
            </a>
            <a class="hide-search" v-if="showSearch" @click.prevent="hideSearchFunc">
                x
            </a>
            <input v-if="showSearch" type="search" name="" id="">
        </div>
        <RouterLink v-else to="dashboard">
            home
        </RouterLink>
        <RouterLink v-if="!showSearch && props.add" to="add-news">
            +
        </RouterLink>
        <RouterLink v-if="!showSearch && props.list" to="report-list">
            list
        </RouterLink>
    </div>
</template>
<script setup>
    import { ref,defineProps } from 'vue';
    const props=defineProps({
        search:Boolean,
        add:Boolean,
        list:Boolean
    })    
    const showSearch=ref(false)
    const showSearchFunc=()=>{
        showSearch.value=true
    }
    const hideSearchFunc=()=>{
        showSearch.value=false
    }
</script>
<style scoped>
    .nav {
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row-reverse;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }
    a{
        width: 40px;
        height: 40px;
        text-decoration: none;
        color: black;
        display: inline-block;
    }
    svg{
        width: 100%;
        height: 100%;
    }
    .hide-search{
        position: fixed;
        right: 10px;
        bottom: 10px;
    }
    input{
        position: fixed;
        bottom: 10px;
        height: 40px;
        left: 10px;
        right: 60px;
        box-shadow: 0 0 10px grey;
        border-radius: 10px;

    }
</style>