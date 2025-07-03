<template>
  <div class="discount-cards-section">
    <h2 class="section-title">کارت‌های تخفیف</h2>

    <div v-if="loading" class="loading">در حال بارگذاری...</div>

    <div v-else>
      <div v-if="cards.length === 0" class="no-data">
        شما هیچ کارت تخفیفی دریافت نکرده‌اید.
      </div>

      <ul class="cards-list">
        <li v-for="card in cards" :key="card.id" class="card-item">
          <div class="card-header">
            <span class="card-title">{{ card.title }}</span>
            <span class="discount">{{ card.discount_percent }}٪ تخفیف</span>
          </div>
          <div class="card-details">
            <p>تاریخ انقضا: {{ formatDate(card.expire_at) }}</p>
            <p v-if="card.used_at">استفاده شده در: {{ formatDate(card.used_at) }}</p>
            <p v-else class="valid">وضعیت: قابل استفاده</p>
          </div>
        </li>
      </ul>
    <button v-if="hasMore" @click="loadMore">نمایش بیشتر</button>

    </div>
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
  //   if (!store.discountCardsLoaded) await store.fetchDiscountCards()
  //   store.startPolling()
  // })
  // onUnmounted(() => {
  //   store.stopPolling()
  // })
  const paginatedCards = computed(() => {
    return store.discountCards.slice(0, currentPage.value * perPage)
  })
  const hasMore = computed(() => {
    return store.discountCards.length > paginatedCards.value.length
  })
  const loadMore = () => {
    currentPage.value++
  }
  const startPolling = () => {
    if (pollingInterval) return
    store.fetchDiscountCards()
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

<style scoped>
.discount-cards-section {
  padding: 1rem;
}
.section-title {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 1rem;
}
.cards-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.card-item {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 1rem;
}
.card-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.5rem;
}
.card-title {
  font-weight: bold;
}
.discount {
  color: #dc2626;
}
.valid {
  color: #16a34a;
  font-weight: bold;
}
</style>
