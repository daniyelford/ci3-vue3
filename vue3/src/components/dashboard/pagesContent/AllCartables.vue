<template>
    <div v-if="store.loading" class="loading">در حال بارگذاری...</div>
    <div v-else class="cartable-inner">
        <div v-for="(item, index) in paginatedItems" :key="index" class="cartable">
            <div class="user-info" ref="scrollContainer">
                <div>
                    <img v-if="item.user?.image" :src="item.user.image" alt="User Image" class="user-avatar"/>
                    <svg v-else class="user-avatar" xmlns="http://www.w3.org/2000/svg" fill="#000000" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><g><rect fill="none" height="24" width="24"/></g><g><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm0 14c-2.03 0-4.43-.82-6.14-2.88C7.55 15.8 9.68 15 12 15s4.45.8 6.14 2.12C16.43 19.18 14.03 20 12 20z"/></g></svg>
                    <strong>{{ item.user?.name }} {{ item.user?.family }}</strong>
                </div>
                <a v-if="item.user?.phone" :href="`tel:${item.user.phone}`">
                    <svg version="1.1" class="tooles" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" data-v-ac41ac96=""><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode:normal;" data-v-ac41ac96=""><g transform="scale(4,4)" data-v-ac41ac96=""><path d="M1,32c0,-17.1 13.9,-31 31,-31c17.1,0 31,13.9 31,31c0,17.1 -13.9,31 -31,31c-17.1,0 -31,-13.9 -31,-31z" fill="#3ec81c" data-v-ac41ac96=""></path><path d="M43.1,51.4c-0.7,0 -1.3,-0.1 -1.9,-0.4c-3.6,-1.6 -10.6,-5.1 -16.8,-11.3c-6.2,-6.2 -9.8,-13.3 -11.4,-16.9c-0.8,-1.8 -0.4,-3.9 1.1,-5.4l3.8,-3.8c0.5,-0.5 1.1,-0.9 1.8,-1c1,-0.2 2,0.2 2.7,0.9l4.9,4.9c1.3,1.3 1.3,3.4 0,4.8l-3.9,3.9c-0.4,0.4 -0.5,1 -0.3,1.5c0.7,1.5 2.3,4.6 5,7.3c2.7,2.7 5.8,4.3 7.3,5c0.5,0.2 1.1,0.1 1.5,-0.3l4,-4c0.5,-0.5 1,-0.8 1.7,-0.9c1,-0.2 2,0.1 2.8,0.9l5.1,5.1c1.2,1.2 1.2,3.2 0,4.4l-3.9,3.9c-0.9,0.9 -2.2,1.4 -3.5,1.4z" fill="#54e6eb" data-v-ac41ac96=""></path></g></g></svg>
                </a>
            </div>
            <MediaSlider v-if="item.news?.media?.length" :medias="item.news.media" />
            <p class="news-description">{{ item.news?.description }}</p>
            <div v-if="item.news?.address?.address" class="address">
                موقعیت: {{ item.news.address.address }}
            </div>
            <RouterLink class="send" v-if="item.id" :to="{ path: `/show-cartable/${item.id}` }">
                گزارش
            </RouterLink>
        </div>
        <button v-if="hasMore" @click="loadMore">موارد بیشتر</button>
    </div>
</template>
<script setup>
    import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'
    import { useCartableStore } from '@/stores/cartable'
    import MediaSlider from '@/components/tooles/media/MediaSlider.vue'
    const store = useCartableStore()
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
    .loading {
        text-align: center;
        font-size: 1.1rem;
        padding: 2rem;
        color: #555;
    }
    .cartable-inner {
        direction: rtl;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    .cartable {
        background-color: #ffffff;
        padding: 1rem 1.2rem;
        border-radius: 10px;
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.1);
    }
    .user-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .user-info div {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ccc;
    }
    .user-info svg {
        width: 20px;
        height: 20px;
    }
    .user-info strong {
        font-weight: bold;
        font-size: 1rem;
        color: #333;
    }
    .user-info small {
        color: #666;
        font-size: 0.9rem;
    }
    .news-description {
        font-size: 1rem;
        margin: 0.5rem 0;
        color: #444;
    }
    .address {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 0.5rem;
    }
    button {
        display: block;
        margin: 1rem auto 0;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 0.6rem 1.4rem;
        font-size: 0.95rem;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    button:hover {
        background-color: #0056b3;
    }
    .send {
        display: inline-block;
        width: 100%;
        margin-top: .5rem;
        padding: 10px;
        text-decoration: none;
        background: #007bff;
        font-weight: 500;
        border-radius: 10px;
        text-align: center;
        color: white;
    }
    .send:hover {
        opacity: 0.6;
    }
</style>