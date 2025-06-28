<script setup>
  import { onMounted } from 'vue'
  import { useRouter } from 'vue-router'
  import { useManageNewsStore } from '@/stores/manageNews'
  import MediaSlider from '@/components/tooles/media/MediaSlider.vue'
  const store = useManageNewsStore()
  const router = useRouter()
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
  const editNews = (id) => {
    router.push(`/news/edit/${id}`)
  }
  const deleteNews = async (id) => {
    if (!confirm('آیا مطمئن هستید که می‌خواهید این خبر را حذف کنید؟')) return
    await store.deleteNews(id)
  }

  onMounted(() => {
    store.loadNews()
  })
</script>

<template>
  <div class="news-wrapper">
    <div v-if="store.loading" class="loading">در حال بارگذاری...</div>
    <div v-else>
      <div v-if="store.newsList.length === 0" class="no-news">شما هنوز خبری ثبت نکردید.</div>
      <ul class="news-list">
        <li v-for="news in store.newsList" :key="news.id" class="news-item">
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
            <button @click="editNews(news.id)">ویرایش</button>
            <button @click="deleteNews(news.id)">حذف</button>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
.news-wrapper {
  max-width: 800px;
  margin: 0 auto;
  direction: rtl;
  /* padding: 2rem; */
}
.title {
  font-size: 24px;
  margin-bottom: 1rem;
}
.loading,
.no-news {
  font-style: italic;
  color: #888;
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
.actions button {
  margin-left: 0.5rem;
  padding: 6px 12px;
  border: none;
  background: #3498db;
  color: white;
  border-radius: 4px;
  cursor: pointer;
}
.actions button:last-child {
  background: #e74c3c;
}
.actions button:hover {
  opacity: 0.9;
}
</style>
