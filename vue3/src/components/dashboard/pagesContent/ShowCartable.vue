<template>
    <div>
        <div v-if="!item">
            در حال بارگذاری یا موردی یافت نشد
        </div>
        <div v-else>
            <h2>شرح خبر: {{ item.description }}</h2>
            <p>وضعیت: {{ item.status }}</p>
            <p>آدرس: {{ item.address?.city || 'نامشخص' }}</p>
            <div v-if="item.media?.length">
                <h3>رسانه‌ها:</h3>
                <ul>
                    <!-- <li v-for="m in item.media" :key="m.id">
                        <template v-if="m.type === 'video'">
                        <video controls :src="m.url" width="320"></video>
                        </template>
                        <template v-else>
                        <img :src="m.url" alt="media" style="max-width: 320px;" />
                        </template>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { onMounted , onUnmounted , defineProps , watch , computed } from 'vue'
    import { cartableStore } from '@/stores/cartableStore'
    const props = defineProps({
        id: Number
    })
    const store = cartableStore()
    const item = computed(() => store.getCartableById(props.id))
    onMounted(async () => {
        if (!store.allItems.length) {
            await store.fetchCartables()
        }
        store.startPolling()
    })
    onUnmounted(() => {
        store.stopPolling()
    })
    watch(props.id, async (newId, oldId) => {
        if (newId !== oldId) {
            if (!store.allItems.length) {
                await store.fetchCartables()
            }
        }
    })
</script>