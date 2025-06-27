import { defineStore } from 'pinia'
export const useUserStore = defineStore('user', {
  state: () => ({
    name: '',
    wallet: 0,
    image: '',
    isLoaded: false,
  }),
  actions: {
    async fetchUserInfo() {
      try {
        const { sendApi } = await import('@/utils/api')
        const res = await sendApi({ action: 'get_user_info', control: 'user' })
        if (res.status === 'success') {
          this.name = res.name
          this.wallet = res.wallet
          this.image = res.image
          this.finger = res.finger
          this.isLoaded = true
        } else {
          console.warn('User info error:', res)
        }
      } catch (err) {
        console.error('Error fetching user:', err)
      }
    },
  },
  getters: {
    isLoggedIn: (state) => !!state.name || !!state.image,
  },
})
