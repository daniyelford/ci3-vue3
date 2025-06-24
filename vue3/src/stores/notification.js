import { defineStore } from 'pinia'
import { sendApi } from '@/utils/api'

export const useNotificationStore = defineStore('notification', {
  state: () => ({
    notifications: [],
    unreadCount: 0,
    lastId: 0,
  }),
  actions: {
    async fetchNotifications() {
      const res = await sendApi({ action: 'get_notifications', control: 'user' })
      if (res.status === 'success' && Array.isArray(res.data)) {
        const newNotifs = res.data
        const maxNewId = Math.max(...newNotifs.map(n => n.id), 0)
        if (maxNewId > this.lastId) {
          this.notifications = newNotifs
          this.unreadCount = newNotifs.filter(n => n.is_read === 'dont').length
          this.lastId = maxNewId
        }
      }
    },
    markAsRead(id) {
      const notif = this.notifications.find(n => n.id === id)
      if (notif && !notif.is_read) {
        notif.is_read = 1
        this.unreadCount = this.notifications.filter(n => n.is_read === 'dont').length
      }
    },

    pushNotification(notif) {
      this.notifications.unshift(notif)
      if (notif.is_read === 'dont') this.unreadCount++
      this.lastId = Math.max(this.lastId, notif.id)
    }
  },

  persist: true
})
