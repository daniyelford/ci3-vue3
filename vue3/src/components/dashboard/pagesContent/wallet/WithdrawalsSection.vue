<template>
  <div class="withdrawals-section">
    <h2 class="section-title">برداشت‌ها</h2>

    <div v-if="loading" class="loading">در حال بارگذاری...</div>

    <div v-else>
      <div v-if="withdrawals.length === 0" class="no-data">هیچ برداشتی ثبت نشده است.</div>

      <ul class="withdrawal-list">
        <li v-for="item in withdrawals" :key="item.id" class="withdrawal-item">
          <p><strong>مبلغ:</strong> {{ formatAmount(item.value) }} تومان</p>
          <p><strong>کارت مقصد:</strong> {{ item.card_number }}</p>
          <p><strong>تاریخ:</strong> {{ formatDate(item.time) }}</p>
          <p><strong>وضعیت:</strong> {{ getStatus(item.vaziate_entghal) }}</p>
        </li>
      </ul>

      <div class="request-withdrawal">
        <h3>درخواست برداشت جدید</h3>
        <input v-model="amount" type="number" placeholder="مبلغ برداشت (تومان)" />
        <select v-model="selectedCardId">
          <option disabled value="">انتخاب کارت</option>
          <option v-for="card in cards" :key="card.id" :value="card.id">
            {{ card.shomare_cart }}
          </option>
        </select>
        <button @click="requestWithdrawal">ثبت درخواست</button>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref, onMounted, onUnmounted } from 'vue'
  import { useWalletStore } from '@/stores/wallet'

  const store = useWalletStore()
  const amount = ref('')
  const selectedCardId = ref('')

  const withdrawals = store.withdrawals
  const cards = store.cards
  const loading = store.loading

  const formatAmount = (num) => Number(num).toLocaleString('fa-IR')
  const formatDate = (datetime) => new Date(datetime).toLocaleString('fa-IR')
  const getStatus = (status) => {
    switch (status) {
      case 'pending': return 'در انتظار بررسی'
      case 'accepted': return 'تأیید شده'
      case 'rejected': return 'رد شده'
      default: return 'نامشخص'
    }
  }

  const requestWithdrawal = async () => {
    if (!amount.value || !selectedCardId.value) {
      return alert('لطفاً مبلغ و کارت را انتخاب کنید')
    }

    const res = await store.requestWithdrawal({
      amount: amount.value,
      card_id: selectedCardId.value
    })

    if (res.status === 'success') {
      alert('درخواست برداشت ثبت شد')
      amount.value = ''
      selectedCardId.value = ''
    } else {
      alert(res.message || 'خطا در ثبت برداشت')
    }
  }

  // polling
  let interval = null
  onMounted(() => {
    store.fetchCards()
    store.fetchWithdrawals()
    interval = setInterval(() => {
      store.fetchWithdrawals()
    }, 10000) // هر ۱۰ ثانیه
  })
  onUnmounted(() => {
    clearInterval(interval)
  })
</script>

<style scoped>
  .withdrawals-section {
    padding: 1rem;
  }
  .section-title {
    font-size: 1.2rem;
    font-weight: bold;
  }
  .loading,
  .no-data {
    margin-top: 1rem;
    font-style: italic;
  }
  .withdrawal-list {
    margin-top: 1rem;
  }
  .withdrawal-item {
    border: 1px solid #ccc;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    border-radius: 8px;
    background: #f9f9f9;
  }
  .request-withdrawal {
    margin-top: 2rem;
    border-top: 1px solid #eee;
    padding-top: 1rem;
  }
  .request-withdrawal input,
  .request-withdrawal select {
    width: 100%;
    margin: 0.5rem 0;
    padding: 0.5rem;
  }
  button {
    padding: 0.5rem 1rem;
    background: teal;
    color: white;
    border: none;
    cursor: pointer;
  }
</style>
