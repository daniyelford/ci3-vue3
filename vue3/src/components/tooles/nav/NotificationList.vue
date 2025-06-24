<template>
    <div class="notification-list">
        <h3>نوتیفیکیشن‌ها</h3>
        <div v-if="notifications.length === 0">نوتیفیکیشنی وجود ندارد.</div>
        <ul>
            <li v-for="notif in props.notifications"
            :key="notif.id"
            :class="{ unread: notif.is_read === 'dont' }"
            @click="markAsRead(notif.id)">
                <strong>{{ notif.title }}</strong>
                <p>{{ notif.body }}</p>
                <small>{{ formatDate(notif.created_at) }}</small>
            </li>
        </ul>
    </div>
</template>
<script setup>
    import { defineProps ,defineEmits } from 'vue'
    import { sendApi } from '@/utils/api'
    import moment from 'moment-jalaali'
    const props = defineProps({
        notifications: Array,
    })
    const emit = defineEmits(['update'])
    function formatDate(date) { return moment(date).format('jYYYY/jMM/jDD HH:mm')}
    async function markAsRead(id) {
        const res = await sendApi({ action: 'read_notifications', control: 'user', data: id })
        if (res.status === 'success') {
           emit('update', id)
        }
    }
</script>
<style scoped>
    .notification-list {
        padding: 1rem;
    }
    .notification-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 350px;
        overflow-y: auto;
    }
    .notification-list li {
        padding: 10px;
        margin-bottom: 5px;
        background-color: white;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
        transition: background 0.3s;
    }
    .notification-list li.unread {
        background-color: #c4f511;
        font-weight: bold;
    }
    .notification-list li:hover {
        background-color: #eef;
    }
</style>
