import { defineStore } from 'pinia'
import { ref } from 'vue'
import { sendApi } from '@/utils/api'

export const useManageNewsStore = defineStore('manageNews', () => {
  const newsList = ref([])
  const loading = ref(false)

  const loadNews = async () => {
    loading.value = true
    try {
      const res = await sendApi({ control: 'news', action: 'user_news' })
      if (res.status === 'success') {
        newsList.value = res.data || []
      } else {
        alert('خطا در بارگذاری اخبار: ' + res.message)
      }
    } catch (error) {
      alert('خطا در ارتباط با سرور: ' + error.message)
    }
    loading.value = false
  }

  const deleteNews = async (id) => {
    try {
      const res = await sendApi({ control: 'news', action: 'delete_news', data: { news_id: id } })
      if (res.status === 'success') {
        newsList.value = newsList.value.filter(news => news.id !== id)
        return true
      } else {
        alert('خطا در حذف خبر: ' + res.message)
        return false
      }
    } catch (error) {
      alert('خطا در ارتباط با سرور: ' + error.message)
      return false
    }
  }

  return {
    newsList,
    loading,
    loadNews,
    deleteNews,
  }
})