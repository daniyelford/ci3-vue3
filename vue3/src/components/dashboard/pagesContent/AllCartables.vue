<template>
    <div class="cartable-container" ref="scrollContainer">
        <div v-if="store.loading">در حال بارگذاری...</div>
        <div v-else>
            <ul>
                <li v-for="item in paginatedItems" :key="item.id">
                    {{ item.description }}
                </li>
            </ul>
            <button v-if="hasMore" @click="loadMore">موارد بیشتر</button>
        </div>
    </div>
</template>
<script setup>
    import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'
    import { cartableStore } from '@/stores/cartableStore'
    const store = cartableStore()
    const scrollContainer = ref(null)
    const currentPage = ref(1)
    const perPage = 5
    const paginatedItems = computed(() =>
        store.allItems.slice(0, currentPage.value * perPage)
    )
    const hasMore = computed(() =>
        store.allItems.length > paginatedItems.value.length
    )
    const loadMore = async () => {
        currentPage.value++
        await nextTick()
        scrollContainer.value?.scrollTo({
            top: scrollContainer.value.scrollHeight,
            behavior: 'smooth'
        })
    }
    onMounted(() => {
        store.startPolling()
    })
    onUnmounted(() => {
        store.stopPolling()
    })
</script>
<style scoped>
    .cartable-container {
        max-height: 80vh;
        overflow-y: auto;
        scroll-behavior: smooth;
    }
</style>