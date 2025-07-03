import { defineStore } from 'pinia'
import { ref } from 'vue'
import { sendApi } from '@/utils/api'
export const useCartableStore = defineStore('cartable', () => {
    const allItems = ref([])
    const rule = ref(true)
    const loading = ref(true)
    let pollingInterval = null
    const simplifyNews = (items) =>
        items.map(item => ({
            id: item.id,
            status: item.status,
            updated_at: item.updated_at
    }))
    const fetchCartables = async () => {
        try {
            const res = await sendApi({ control: 'news', action: 'get_cartables' })
            if (res.status === 'success') {
                const newData = res.data || []
                const isSame = JSON.stringify(simplifyNews(allItems.value)) === JSON.stringify(simplifyNews(newData))
                if (!isSame) {
                    allItems.value = newData
                }
                rule.value=res.rule
            } else {
                alert('خطا در دریافت اطلاعات: ' + res.message)
            }
        } catch (e) {
            alert('خطا در ارتباط با سرور: ' + e.message)
        }
        loading.value = false
    }
    const startPolling = () => {
        if (pollingInterval) return
        fetchCartables()
        pollingInterval = setInterval(fetchCartables, 10000)
    }
    const stopPolling = () => {
        if (pollingInterval) {
            clearInterval(pollingInterval)
            pollingInterval = null
        }
    }
    const getCartableById = (id) => {
        return allItems.value.find(item => item.id === parseInt(id))
    }
    return {
        allItems,
        loading,
        rule,
        fetchCartables,
        startPolling,
        stopPolling,
        getCartableById,
    }
})
