<template>
  <div class="bank-cards-section">
    <h2 class="section-title">کارت‌های بانکی</h2>

    <div v-if="loading" class="loading">در حال بارگذاری...</div>

    <div v-else>
      <div v-if="cards.length === 0" class="no-cards">کارت بانکی ثبت نشده است.</div>

      <ul class="card-list">
        <li v-for="card in cards" :key="card.id" class="card-item">
          <div class="card-info">
            <p><strong>شماره کارت:</strong> {{ card.card_number }}</p>
            <p><strong>شماره شبا:</strong> {{ card.iban }}</p>
          </div>
          <button class="delete-btn" @click="removeCard(card.id)">حذف</button>
        </li>
      </ul>

      <div class="add-card">
        <h3>افزودن کارت جدید</h3>
        <input v-model="newCard.card_number" placeholder="شماره کارت" />
        <input v-model="newCard.iban" placeholder="شماره شبا" />
        <button @click="addCard">ثبت کارت</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { sendApi } from '@/utils/api'

const cards = ref([])
const loading = ref(false)
const newCard = ref({
  card_number: '',
  iban: ''
})

const loadCards = async () => {
  loading.value = true
  const res = await sendApi({ control: 'wallet', action: 'get_cards' })
  if (res.status === 'success') {
    cards.value = res.data || []
  } else {
    alert('خطا در بارگذاری کارت‌ها')
  }
  loading.value = false
}

const addCard = async () => {
  if (!newCard.value.card_number || !newCard.value.iban) {
    return alert('لطفاً تمام فیلدها را پر کنید.')
  }
  const res = await sendApi({
    control: 'wallet',
    action: 'add_card',
    data: newCard.value
  })
  if (res.status === 'success') {
    await loadCards()
    newCard.value = { card_number: '', iban: '' }
  } else {
    alert('خطا در افزودن کارت')
  }
}

const removeCard = async (id) => {
  const confirmed = confirm('آیا از حذف این کارت مطمئن هستید؟')
  if (!confirmed) return

  const res = await sendApi({
    control: 'wallet',
    action: 'delete_card',
    data: { id }
  })
  if (res.status === 'success') {
    cards.value = cards.value.filter(card => card.id !== id)
  } else {
    alert('خطا در حذف کارت')
  }
}

onMounted(loadCards)
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
