<template>
  <div class="transaction-list">
    <h3>لیست تراکنش‌ها</h3>
    <div v-if="store.transactions.length === 0">تراکنشی وجود ندارد.</div>
    <ul>
      <li v-for="tx in paginatedTransactions" :key="tx.id" class="transaction-item">
        <!-- <p><strong>مبلغ:</strong> {{ formatAmount(tx.amount) }} تومان</p>
        <p><strong>پرداخت‌کننده:</strong> {{ tx.pay_user_name }} {{ tx.pay_user_family }}</p>
        <p><strong>گیرنده:</strong> {{ tx.give_user_name }} {{ tx.give_user_family }}</p>
        <p><strong>محصول:</strong> {{ tx.product_name || '---' }}</p>
        <p><strong>گزارش:</strong> {{ tx.report_title || '---' }}</p>
        <p><strong>شماره کارت:</strong> {{ tx.give_cart || '---' }}</p>
        <p><strong>وضعیت:</strong> {{ getStatus(tx.status) }}</p>
        <p><strong>تاریخ:</strong> {{ formatDate(tx.created_at) }}</p> -->
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

const paginatedTransactions = computed(() =>
  store.transactions.slice(0, currentPage.value * perPage)
)

const hasMore = computed(() =>
  store.transactions.length > paginatedTransactions.value.length
)

const loadMore = () => {
  currentPage.value++
}

// const formatAmount = (num) =>
//   Number(num).toLocaleString('fa-IR')

// const formatDate = (datetime) =>
//   new Date(datetime).toLocaleString('fa-IR')

// const getStatus = (status) => {
//   switch (status) {
//     case 'do': return 'انجام شده'
//     case 'dont': return 'در انتظار'
//     default: return 'نامشخص'
//   }
// }

// const getType = (tx) => {
//   // تشخیص این که کاربر پرداخت کرده یا دریافت
//   return tx.pay_money_user_account_id === store.userAccountId
//     ? 'برداشت/خروج پول'
//     : 'دریافت/ورود پول'
// }

const startPolling = () => {
  if (pollingInterval) return
  store.fetchTransactions()
  pollingInterval = setInterval(() => {
    store.fetchTransactions()
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
.transaction-list {
  padding: 1rem;
}
.transaction-item {
  border: 1px solid #ddd;
  padding: 0.75rem;
  margin-bottom: 0.5rem;
}
</style>
