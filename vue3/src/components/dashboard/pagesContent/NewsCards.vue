<template>
  <div>
    <div class="loading" v-if="!newsStore.isLoaded">
      در حال بارگذاری...
    </div>
    <div class="card-inner" v-else-if="visibleNews.length > 0">
      <div v-for="card in visibleNews" :key="card.id" class="card">
        <div class="user-info">
          <img v-if="card.user.image" :src="card.user.image" alt="user" />
          <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 ... 12 20z" />
          </svg>
          <p>{{ card.user.name + ' ' + card.user.family }}</p>
        </div>

        <div class="media-inner">
          <MediaSlider v-if="card.medias.length > 0" :medias="card.medias" />
        </div>

        <div class="card-category" v-if="!newsStore.hasRule">
          {{ card.category }}
        </div>

        <div class="description" v-if="card.description">
          {{ card.description }}
        </div>

        <div class="location" v-if="card.location">
          📍 {{ card.location }}
        </div>

        <div class="time">
          {{ moment(card.created_at).format('jYYYY/jMM/jDD') }}
        </div>
        <a class="choose" v-if="newsStore.hasRule" @click="openCalendarModal(card.id)">
            بررسی
        </a>
      </div>
      <button
        v-if="visibleCount < newsStore.cards.length"
        @click="loadMore"
        :disabled="loadingMore"
      >
        {{ loadingMore ? 'در حال بارگذاری...' : 'نمایش بیشتر' }}
      </button>
    </div>
    <div v-else class="none-cart-error">
      خبری در محدوده شما وجود ندارد
    </div>
    <div v-if="toastMsg" class="toast">{{ toastMsg }}</div>
        <CalendarModal
    v-if="showModal"
    @close="showModal = false"
    @submit="onCalendarSubmit" />
  </div>
</template>
<script setup>
    import { ref, onMounted, onBeforeUnmount, computed } from 'vue'
    import moment from 'moment-jalaali'
    import { useNewsStore } from '@/stores/news'
    import { sendApi } from '@/utils/api'
    import MediaSlider from '@/components/tooles/media/MediaSlider.vue'
    import CalendarModal from '@/components/tooles/news/CalendarModal.vue'
    const newsStore = useNewsStore()
    const visibleCount = ref(10)
    const loadingMore = ref(false)
    const toastMsg = ref('')
    const selectedNewsId = ref(null)
    const showModal = ref(false)
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
    const visibleNews = computed(() =>
        newsStore.cards.slice(0, visibleCount.value)
    )
    function loadMore() {
        loadingMore.value = true
        setTimeout(() => {
            visibleCount.value += 10
            loadingMore.value = false
        }, 300)
    }
    function showToast(msg) {
        toastMsg.value = msg
        setTimeout(() => (toastMsg.value = ''), 3000)
    }
    let intervalId = null
    async function pollNews() {
        const prevTopId = newsStore.cards.length ? newsStore.cards[0].id : 0
        await newsStore.fetchNews()
        const newTopId = newsStore.cards.length ? newsStore.cards[0].id : 0
        if (newTopId > prevTopId) {
            showToast('خبر جدید رسید!')
        }
    }
    function handleVisibilityChange() {
        if (document.visibilityState === 'visible') {
            pollNews()
            startPolling()
        } else {
            stopPolling()
        }
    }
    function startPolling() {
        stopPolling()
        intervalId = setInterval(() => {
            pollNews()
        }, 6000)
    }
    function stopPolling() {
        if (intervalId) clearInterval(intervalId)
        intervalId = null
    }
    onMounted(() => {
        newsStore.fetchNews()
        startPolling()
        document.addEventListener('visibilitychange', handleVisibilityChange)
    })
    onBeforeUnmount(() => {
        stopPolling()
        document.removeEventListener('visibilitychange', handleVisibilityChange)
    })
</script>
<style scoped>
    .toast {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background: #2ecc71;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }
    .loading,.none-cart-error{
        text-align: center;
        padding: 20px;
        color: white;
        font-size: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px grey;
        font-weight: bold;
    }
    .loading{
        background: rgb(16, 16, 143);
    }
    .none-cart-error {
        background: rgb(128, 12, 12);
    }
    .media-inner {
        background: white;
        padding: 5px;
    }
    .location {
        margin: 5px;
        gap: 5px;
        display: flex;
        font-size: 11px;
        align-items: center;
    }
    .location svg{
        height: 20px;
        width: 20px;
    }
    .user-info svg,.user-info img{
        width: 50px;
        height: 50px;
        border-radius: 50px;
        display: inline-block;
    }
    .user-info p{
        display: inline-block;
    }
    .user-info{
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
    }
    .card-category {
        text-align: center;
        padding: 10px;
        background: floralwhite;
    }
    .card-inner {
        width: 100%;
        direction: rtl;
        height: 100%;
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: wrap;
        align-content: flex-start;
        justify-content: center;
        align-items: stretch;
    }
    .card {
        background: #f5f5f5;
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
        min-height: 50px;
        padding: 10px;
        width: 95%;
        text-align: center;
    }
    .time {
        font-size: 10px;
        padding-left: 10px;
        text-align: end;
        margin: 5px;
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
