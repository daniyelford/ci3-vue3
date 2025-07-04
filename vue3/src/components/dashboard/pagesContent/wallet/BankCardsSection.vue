<template>
  <div class="bank-cards-section">
    <h2 class="section-title">کارت‌های بانکی</h2>
    <div v-if="store.loading" class="loading">در حال بارگذاری...</div>
    <div v-else>
      <div v-if="store.cards.length === 0" class="no-cards">کارت بانکی ثبت نشده است.</div>
      <ul class="card-list">
        <li v-for="card in store.cards" :key="card.id" class="card-item">
          <div class="card-info">
            <p v-if="card.shomare_cart"><strong>شماره کارت:</strong> {{ card.shomare_cart }}</p>
            <p v-if="card.shomare_shaba"><strong>شماره شبا:</strong> {{ card.shomare_shaba }}</p>
            <p v-if="card.shomare_hesab"><strong>شماره حساب:</strong> {{ card.shomare_hesab }}</p>
          </div>
          <button class="delete-btn" @click="removeCard(card.id)">حذف</button>
        </li>
      </ul>
      <div class="add-card">
        <h3>افزودن کارت جدید</h3>
        <input v-model="newCard.shomare_cart" placeholder="شماره کارت" />
        <input v-model="newCard.shomare_shaba" placeholder="شماره شبا" />
        <input v-model="newCard.shomare_hesab" placeholder="شماره حساب" />
        <button @click="addCard">ثبت کارت</button>
      </div>
    </div>
  </div>
</template>
<script setup>
  import { ref, onMounted, onBeforeUnmount } from 'vue'
  import { useWalletStore } from '@/stores/wallet'
  let pollingInterval=null
  const store = useWalletStore()
  const newCard = ref({
    shomare_cart: '',
    shomare_hesab: '',
    shomare_shaba: ''
  })
  const startPolling = () => {
    if (pollingInterval) return
    pollingInterval = setInterval(() => {
      store.fetchCards()
    }, 10000)
  }
  const stopPolling = () => {
    if (pollingInterval) {
      clearInterval(pollingInterval)
      pollingInterval = null
    }
  }
  const addCard = async () => {
    if (!(newCard.value.shomare_hesab || newCard.value.shomare_cart || newCard.value.shomare_shaba)) {
      return alert('لطفاً فیلدها را پر کنید.')
    }
    const res = await store.addCard(newCard.value)
    if (res.status === 'success') {
      newCard.value = { shomare_cart: '', shomare_hesab: '', shomare_shaba: '' }
    } else {
      alert(res.message || 'خطا در افزودن کارت')
    }
  }
  const removeCard = async (id) => {
    const confirmed = confirm('آیا از حذف این کارت مطمئن هستید؟')
    if (!confirmed) return
    const res = await store.deleteCard(id)
    if (res.status !== 'success') {
      alert(res.message || 'خطا در حذف کارت')
    }
  }
  onMounted(() => {
    store.fetchCards()
    startPolling()
  })
  onBeforeUnmount(() => {
    stopPolling()
  })
</script>
<style scoped>
  .bank-cards-section {
    padding: 1rem;
  }
  .section-title {
    font-size: 1.2rem;
    font-weight: bold;
  }
  .card-list {
    margin-top: 1rem;
  }
  .card-item {
    border: 1px solid #ddd;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .add-card {
    margin-top: 1rem;
  }
  .add-card input {
    display: block;
    margin: 0.5rem 0;
    padding: 0.5rem;
    width: 100%;
  }
  .delete-btn {
    background-color: crimson;
    color: white;
    border: none;
    padding: 0.4rem 0.8rem;
    cursor: pointer;
  }
</style>
