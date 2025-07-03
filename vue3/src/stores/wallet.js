import { defineStore } from 'pinia'
import { ref } from 'vue'
import { sendApi } from '@/utils/api'
export const useWalletStore = defineStore('wallet', () => {
    const transactions = ref([])
    const transactionsLoaded = ref(false)
    const discountCards = ref([])
    const discountCardsLoaded = ref(false)
    const loading = ref(false)
    // let pollingInterval = null
    const fetchTransactions = async () => {
        const res = await sendApi({ control: 'wallet', action: 'get_transactions' })
        if (res.status === 'success') {
            const newIds = res.data.map(i => i.id).sort()
            const oldIds = transactions.value.map(i => i.id).sort()
            if (JSON.stringify(newIds) !== JSON.stringify(oldIds)) {
                transactions.value = res.data
            }
            transactionsLoaded.value = true
        }
    }
    const fetchDiscountCards = async () => {
        const res = await sendApi({ control: 'wallet', action: 'get_discount_cards' })
        if (res.status === 'success') {
            const newIds = res.data.map(i => i.id).sort()
            const oldIds = discountCards.value.map(i => i.id).sort()
            if (JSON.stringify(newIds) !== JSON.stringify(oldIds)) {
                discountCards.value = res.data
            }
            discountCardsLoaded.value = true
        }
    }
    // const startPolling = () => {
    //     if (pollingInterval) return
    //     pollingInterval = setInterval(() => {
    //         if (transactionsLoaded.value) fetchTransactions()
    //         if (discountCardsLoaded.value) fetchDiscountCards()
    //     }, 10000)
    // }
    // const stopPolling = () => {
    //     clearInterval(pollingInterval)
    //     pollingInterval = null
    // }
    return {
        transactions,
        transactionsLoaded,
        discountCards,
        discountCardsLoaded,
        loading,
        fetchTransactions,
        fetchDiscountCards,
        // startPolling,
        // stopPolling,
    }
})
