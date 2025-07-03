<template>
  <div>
    <h3>لیست تراکنش‌ها</h3>
    <div v-if="store.transactions.length === 0">تراکنشی وجود ندارد.</div>
    <ul>
      <li v-for="tx in paginatedTransactions" :key="tx.id">
        {{ tx.amount }} تومان - {{ tx.type }}
      </li>
    </ul>
    <button v-if="hasMore" @click="loadMore">نمایش بیشتر</button>
  </div>
</template>
<script setup>
  import { onMounted, onUnmounted, ref, computed } from 'vue'
  import { useWalletStore } from '@/stores/wallet'
  const store = useWalletStore()
  const currentPage = ref(1)
  const perPage = 5
  let pollingInterval = null

  // onMounted(async () => {
  //   if (!store.transactionsLoaded) await store.fetchTransactions()
  //   store.startPolling()
  // })
  // onUnmounted(() => {
  //   store.stopPolling()
  // })
  const paginatedTransactions = computed(() => {
    return store.transactions.slice(0, currentPage.value * perPage)
  })
  const hasMore = computed(() => {
    return store.transactions.length > paginatedTransactions.value.length
  })
  const loadMore = () => {
    currentPage.value++
  }
  
  const startPolling = () => {
    if (pollingInterval) return
    store.fetchTransactions()
    pollingInterval = setInterval(() => {
      store.fetchData()
    }, 10000)
  }

  const stopPolling = () => {
    clearInterval(pollingInterval)
    pollingInterval = null
  }

  const handleVisibilityChange = () => {
    if (document.visibilityState === 'visible') {
      startPolling()
    } else {
      stopPolling()
    }
  }

  onMounted(() => {
    document.addEventListener('visibilitychange', handleVisibilityChange)
    if (document.visibilityState === 'visible') {
      startPolling()
    }
  })

  onUnmounted(() => {
    document.removeEventListener('visibilitychange', handleVisibilityChange)
    stopPolling()
  })
  
</script>