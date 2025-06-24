<template>
    <div class="loading" v-if="!newsStore.isLoaded">
        در حال بارگذاری...
    </div>
    <div class="card-inner" v-else-if="newsStore.cards.length > 0">
        <div v-for="card in newsStore.cards" :key="card.id" class="card">
            <div class="card-header">
                <div class="location" v-if="card.location !== ''">
                    {{ card.location }}
                </div>
                <div class="card-category">
                    {{ card.category }}
                </div>
            </div>
            <MediaSlider v-if="card.medias.length > 0" :medias="card.medias" />
            <div class="description" v-if="card.description !== ''">
                {{ card.description }}
            </div>
            <div class="time">
                {{ moment(card.created_at).format('jYYYY/jMM/jDD') }}
            </div>
            <a class="choose" v-if="newsStore.hasRule" @click="openCalendarModal(card.id)">
                بررسی
            </a>
        </div>
    </div>
    <div class="none-cart-error" v-else>
        خبری در محدوده شما وجود ندارد
    </div>
    <CalendarModal
    v-if="showModal"
    @close="showModal = false"
    @submit="onCalendarSubmit" />
</template>
<script setup>
    import { ref, onMounted , onBeforeUnmount } from 'vue'
    import moment from 'moment-jalaali'
    import { sendApi } from '@/utils/api'
    import MediaSlider from '@/components/tooles/media/MediaSlider.vue'
    import CalendarModal from '@/components/tooles/news/CalendarModal.vue'
    import { useNewsStore } from '@/stores/news'
    const showModal = ref(false)
    const selectedNewsId = ref(null)
    const newsStore = useNewsStore()
    function openCalendarModal(id) {
        selectedNewsId.value = id
        showModal.value = true
    }
    async function onCalendarSubmit({ date }) {
        const jsDate = date ? moment(date, 'jYYYY/jMM/jDD').toDate() : null
        const response = await sendApi({
            action: 'add_news_to_list',
            control: 'news',
            data: {
            news_id: selectedNewsId.value,
            run_time: jsDate ?? null,
            }
        })
        if (response.status === 'success') {
            showModal.value = false
            newsStore.fetchNews()
        } else {
            alert('خطا در ثبت تاریخ اجرا')
        }
    }
    let intervalId = null
    onMounted(() => {
        newsStore.fetchNews()
        intervalId = setInterval(() => {
            newsStore.fetchNews()
        }, 6000)
    })
    onBeforeUnmount(() => {if (intervalId) clearInterval(intervalId)})
</script>
<style scoped>
    .card-inner {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: wrap;
        align-content: flex-start;
        justify-content: center;
        align-items: stretch;
    }
    .card {
        width: 49%;
        min-height: 300px;
        margin: 0 0.5% 10px 0.5%;
        border-radius: 10px;
        box-shadow: 0 0 5px grey;
    }
    .media {
        height: 150px;
        width: auto;
        margin: auto;
    }
    .media img,
    .media video {
        width: 100%;
        height: 100%;
    }
    .card-header {
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: stretch;
        padding: 6px;
    }
    .description {
        height: 50px;
        padding: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 95%;
        text-align: center;
        white-space: nowrap;
    }
    .time {
        font-size: 10px;
        padding-left: 10px;
    }
    .choose {
        width: 95%;
        height: 30px;
        background: blue;
        margin: 5px auto;
        text-align: center;
        border-radius: 10px;
        color: white;
        display: block;
        padding-top: 10px;
    }
    @media screen and (max-width: 600px) {
        .card {
            width: 99%;
        }
    }
</style>
