<template>
  <div class="news-wrapper">
    <div v-if="store.loading" class="loading">در حال بارگذاری...</div>
    <div v-else>
      <div v-if="store.newsList.length === 0" class="no-news">شما هنوز خبری ثبت نکردید.</div>
      <ul class="news-list">
        <li
          v-for="news in store.newsList"
          :key="news.id"
          v-memo="[news.status]"
          class="news-item"
        >
          <div class="media-list" v-if="news.media?.length">
            <MediaSlider :medias="news.media" />
          </div>
          <div class="news-header">
            <p v-if="news.category?.length" class="category">
              <span v-for="cat in news.category" :key="cat.id" class="category-item">
                {{ cat.title }}
              </span>
            </p>
          </div>
          <h3 class="news-title">{{ news.description }}</h3>
          <p v-if="news.address" class="address">
            موقعیت: {{ news.address.city || 'نامشخص' }} - {{ news.address.address || '' }}
          </p>
          <small class="news-status">وضعیت: {{ getStatus(news.status) }}</small>
          <div class="actions">
            <RouterLink class="c-d " :to="{ path:`/show-news/${news.id}`}">
              مشاهده
            </RouterLink>
            <RouterLink class="c-b" v-if="news.status === 'seen' && news?.reportList[0]?.id" :to="{ path:`/show-cartable/${news.reportList[0].id}`}">
              پیگیری
            </RouterLink>
            <button class="c-s" v-if="news.status === 'seen' && !news.report" @click="restoreNews(news.id)">
              پخش مجدد
            </button>
            <button class="c-r" v-if="news.status === 'checking'" @click="deleteNews(news.id)">
              عدم پخش
            </button>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>
<script setup>
  import { onMounted, onUnmounted } from 'vue'
  import { useManageNewsStore } from '@/stores/manageNews'
  import MediaSlider from '@/components/tooles/media/MediaSlider.vue'
  const store = useManageNewsStore()
  const getStatus = (status) => {
    switch (status) {
      case 'checking':
        return 'منتشر شد'
      case 'seen':
        return 'درحال پیگیری'
      default:
        return 'نامشخص'
    }
  }
  const restoreNews = async (id) => {
    const ok = await store.restoreNews(id)
    if (ok) {
      alert('خبر با موفقیت پخش مجدد شد')
    }
  }
  const deleteNews = async (id) => {
    const ok = await store.deleteNews(id)
    if (ok) {
      store.loadNews()
    }
  }
  const handleVisibilityChange = () => {
    if (document.visibilityState === 'visible') {
      store.startPolling()
    } else {
      store.stopPolling()
    }
  }
  onMounted(() => {
    document.addEventListener('visibilitychange', handleVisibilityChange)
    if (document.visibilityState === 'visible') {
      store.startPolling()
    }
  })
  onUnmounted(() => {
    document.removeEventListener('visibilitychange', handleVisibilityChange)
    store.stopPolling()
  })
</script>
<style scoped>
  .news-wrapper {
    max-width: 800px;
    margin: 0 auto;
    direction: rtl;
  }
  .title {
    font-size: 24px;
    margin-bottom: 1rem;
  }
  .loading,
  .no-news {
    font-style: italic;
    text-align: center;
    padding: 20px;
    font-weight: bold;
    color: #888;
    border-radius: 10px;
    box-shadow: 0 0 10px grey;
    background: #e0d4e3;
  }
  .news-list {
    list-style: none;
    padding: 0;
  }
  .news-item {
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 1rem;
    margin-bottom: 1rem;
  }
  .news-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .news-title {
    margin: 0;
    font-size: 18px;
  }
  .news-status {
    font-size: 12px;
    color: #666;
  }
  .category {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items: center;
    gap: 5px;
    margin-top: 0.5rem;
  }
  .category-item {
    background: #eef;
    padding: 2px 6px;
    margin-left: 4px;
    border-radius: 4px;
  }
  .address {
    font-size: 14px;
    color: #444;
  }
  .media-list {
    margin: 0.5rem auto;
  }
  .media-item {
    margin-right: 10px;
    margin-top: 10px;
  }
  .media-img {
    max-width: 120px;
    max-height: 80px;
    border-radius: 4px;
    object-fit: cover;
  }
  .media-link {
    display: inline-block;
    padding: 4px 8px;
    background: #ddd;
    border-radius: 4px;
    font-size: 13px;
    text-decoration: none;
    color: #000;
  }
  .actions {
    margin-top: 1rem;
  }
  .actions button ,.c-b,.c-d{
    width: 100%;
    display: block;
    text-align: center;
    padding: 6px 12px;
    border: none;
    background: #4e3a85;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    margin-top: 10px;
    box-sizing: border-box;
  }
  .c-d {
    background: #14035e !important;
  }
  .c-r {
    background: #ac3427 !important;
  }
  .c-s{
    background: #29921b !important;
  }
  .actions button:hover {
    opacity: 0.9;
  }
</style>
