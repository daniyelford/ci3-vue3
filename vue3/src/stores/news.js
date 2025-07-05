import { defineStore } from 'pinia'
import { sendApi } from '@/utils/api'
export const useNewsStore = defineStore('news', {
  state: () => ({
    cards: [],
    lastUpdate: null,
    isLoaded: false,
    hasRule: false
  }),
  actions: {
    async fetchNews({ limit = 10, offset = 0, append = false } = {}) {
      const res = await sendApi({
        action: 'get_news',
        control: 'news',
        data: { limit:limit, offset:offset }
      })
      if (res.status === 'success') {
        const newCards = res.data.map(item => ({
          id: item.id,
          location: item.location,
          category: item.category ?? 'کلی',
          description: item.description,
          created_at: item.created_at,
          user: item.user,
          medias: Array.isArray(item.media)
            ? item.media.map(media => ({
                type: media.type,
                url: media.url
              }))
            : []
        }))
        this.hasRule = res.rule ?? false
        this.cards = append ? [...this.cards, ...newCards] : newCards
        this.lastUpdate = new Date().toISOString()
        this.isLoaded = true
      }
    }

  }
})
