<template>
  <div class="withdrawals-section">
    <h2 class="section-title">برداشت‌ها</h2>

    <div v-if="loading" class="loading">در حال بارگذاری...</div>

    <div v-else>
      <div v-if="withdrawals.length === 0" class="no-data">هیچ برداشتی ثبت نشده است.</div>

      <ul class="withdrawal-list">
        <li v-for="item in withdrawals" :key="item.id" class="withdrawal-item">
          <p><strong>مبلغ:</strong> {{ formatAmount(item.amount) }} تومان</p>
          <p><strong>کارت مقصد:</strong> {{ item.card_number }}</p>
          <p><strong>تاریخ:</strong> {{ formatDate(item.created_at) }}</p>
          <p><strong>وضعیت:</strong> {{ getStatus(item.status) }}</p>
        </li>
      </ul>

      <div class="request-withdrawal">
        <h3>درخواست برداشت جدید</h3>
        <input v-model="amount" type="number" placeholder="مبلغ برداشت (تومان)" />
        <select v-model="selectedCardId">
          <option disabled value="">انتخاب کارت</option>
          <option v-for="card in cards" :key="card.id" :value="card.id">
            {{ card.card_number }}
          </option>
        </select>
        <button @click="requestWithdrawal">ثبت درخواست</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { sendApi } from '@/utils/api'

const withdrawals = ref([])
const cards = ref([])
const loading = ref(false)

const amount = ref('')
const selectedCardId = ref('')

const loadWithdrawals = async () => {
  loading.value = true
  const res = await sendApi({ control: 'wallet', action: 'get_withdrawals' })
  if (res.status === 'success') {
    withdrawals.value = res.data || []
  } else {
    alert('خطا در بارگذاری برداشت‌ها')
  }
  loading.value = false
}

const loadCards = async () => {
  const res = await sendApi({ control: 'wallet', action: 'get_cards' })
  if (res.status === 'success') {
    cards.value = res.data || []
  }
}

const requestWithdrawal = async () => {
  if (!amount.value || !selectedCardId.value) {
    return alert('لطفاً مبلغ و کارت را انتخاب کنید')
  }

  const res = await sendApi({
    control: 'wallet',
    action: 'request_withdrawal',
    data: {
      amount: amount.value,
      card_id: selectedCardId.value
    }
  })

  if (res.status === 'success') {
    alert('درخواست برداشت با موفقیت ثبت شد')
    amount.value = ''
    selectedCardId.value = ''
    await loadWithdrawals()
  } else {
    alert('خطا در ثبت درخواست برداشت')
  }
}

const getStatus = (status) => {
  switch (status) {
    case 'pending': return 'در انتظار بررسی'
    case 'accepted': return 'تأیید شده'
    case 'rejected': return 'رد شده'
    default: return 'نامشخص'
  }
}

const formatAmount = (num) =>
  Number(num).toLocaleString('fa-IR')

const formatDate = (datetime) =>
  new Date(datetime).toLocaleString('fa-IR')

onMounted(() => {
  loadWithdrawals()
  loadCards()
})
</script>

<style scoped>
.withdrawals-section {
  padding: 1rem;
}
.section-title {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 1rem;
}
.withdrawal-list {
  margin-bottom: 2rem;
}
.withdrawal-item {
  border: 1px solid #ddd;
  padding: 0.75rem;
  margin-bottom: 0.75rem;
  border-radius: 6px;
}
.request-withdrawal {
  margin-top: 2rem;
}
.request-withdrawal input,
.request-withdrawal select {
  display: block;
  margin: 0.5rem 0;
  padding: 0.5rem;
  width: 100%;
}
button {
  padding: 0.5rem 1rem;
  background-color: #2563eb;
  color: white;
  border: none;
  border-radius: 4px;
}
</style>
