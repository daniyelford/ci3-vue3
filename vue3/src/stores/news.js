import { defineStore } from 'pinia'
import { sendApi } from '@/utils/api'

export const useNewsStore = defineStore('news', {
  state: () => ({
    cards: [],
    lastUpdate: null,
    isLoaded: false,
    hasRule:false
  }),
  actions: {
    async fetchNews() {
      const res = await sendApi({ action: 'get_news', control: 'news' })
      if (res.status === 'success') {
        const newCards = res.data.map(item => ({
          id: item.id,
          location: item.location,
          category: item.category ?? 'کلی',
          description: item.description,
          created_at: item.created_at,
          medias: item.media.map(media => ({
            type: media.type,
            url: media.url 
          })),
        }))
        this.hasRule=res.rule
        const changed = JSON.stringify(newCards) !== JSON.stringify(this.cards)
        if (changed) {
          this.cards = newCards
          this.lastUpdate = new Date().toISOString()
        }
        this.isLoaded=true
      }
    }
  }
})
