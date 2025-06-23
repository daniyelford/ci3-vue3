<template>
    <div class="notification-list">
        <h3>نوتیفیکیشن‌ها</h3>
        <div v-if="notifications.length === 0">نوتیفیکیشنی وجود ندارد.</div>
        <ul>
            <li v-for="notif in notifications"
            :key="notif.id"
            :class="{ unread: !notif.is_read }"
            @click="markAsRead(notif.id)">
                <strong>{{ notif.title }}</strong>
                <p>{{ notif.body }}</p>
                <small>{{ formatDate(notif.created_at) }}</small>
            </li>
        </ul>
    </div>
</template>
<script setup>
    import { ref, onMounted ,defineEmits } from 'vue'
    import { sendApi } from '@/utils/api'
    import moment from 'moment-jalaali'
    const notifications = ref([])
    const emit = defineEmits(['read'])
    async function fetchNotifications() {
        const res = await sendApi({ action: 'get_notifications', control: 'user' })
        if (res.status === 'success') {
            notifications.value = res.data
        }
    }
    function formatDate(date) { return moment(date).format('jYYYY/jMM/jDD HH:mm')}
    async function markAsRead(id) {
        const res = await sendApi({ action: 'read_notifications', control: 'user', data: id })
        if (res.status === 'success') {
            const n = notifications.value.find(n => n.id === id)
            if (n) {
                n.is_read = 1
                n.read_at = new Date().toISOString()
            }
            emit('read')
        }
    }
    onMounted(() => {
        fetchNotifications()
    })
</script>

<style scoped>
    .notification-list {
        padding: 1rem;
        background: #fff;
        border-radius: 10px;
        max-height: 400px;
        overflow-y: auto;
    }
    .notification-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .notification-list li {
        padding: 10px;
        margin-bottom: 5px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
        transition: background 0.3s;
    }
    .notification-list li.unread {
        background-color: #f0f8ff;
        font-weight: bold;
    }
    .notification-list li:hover {
        background-color: #eef;
    }
</style>
