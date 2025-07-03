<template>
  <div class="tokens-section">
    <h2 class="section-title">توکن‌های دریافتی</h2>

    <div v-if="loading" class="loading">در حال بارگذاری...</div>

    <div v-else>
      <div v-if="tokens.length === 0" class="no-data">
        شما هنوز توکنی دریافت نکرده‌اید.
      </div>

      <ul class="tokens-list">
        <li v-for="token in tokens" :key="token.id" class="token-item">
          <p><strong>مقدار:</strong> {{ token.amount }}</p>
          <p><strong>منبع:</strong> {{ token.source || 'نامشخص' }}</p>
          <p><strong>تاریخ:</strong> {{ formatDate(token.created_at) }}</p>
        </li>
      </ul>

      <div class="total-amount" v-if="tokens.length">
        مجموع توکن‌ها: <strong>{{ totalTokens }}</strong>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { sendApi } from '@/utils/api'

const loading = ref(false)
const tokens = ref([])

const loadTokens = async () => {
  loading.value = true
  const res = await sendApi({ control: 'wallet', action: 'get_tokens' })
  if (res.status === 'success') {
    tokens.value = res.data || []
  } else {
    alert('خطا در بارگذاری توکن‌ها')
  }
  loading.value = false
}

const formatDate = (datetime) =>
  new Date(datetime).toLocaleString('fa-IR')

const totalTokens = computed(() =>
  tokens.value.reduce((sum, token) => sum + Number(token.amount || 0), 0)
)

onMounted(() => {
  loadTokens()
})
</script>

<style scoped>
.tokens-section {
  padding: 1rem;
}
.section-title {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 1rem;
}
.tokens-list {
  margin-bottom: 1.5rem;
}
.token-item {
  border: 1px solid #ddd;
  padding: 0.75rem;
  margin-bottom: 0.75rem;
  border-radius: 6px;
}
.total-amount {
  font-weight: bold;
  font-size: 1.1rem;
  color: #16a34a;
}
</style>
