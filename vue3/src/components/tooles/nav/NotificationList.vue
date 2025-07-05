<template>
    <div class="notification-list">
        <h3 style="padding-right: 5px;margin-top: 5px;">نوتیفیکیشن‌ها</h3>
        <div v-if="props.notifications.length === 0">نوتیفیکیشنی وجود ندارد.</div>
        <ul>
            <li v-for="notif in props.notifications" :key="notif.id" :class="{ unread: notif.is_read === 'dont' }" @click="markAsRead(notif)">
                <a v-if="notif.url" :href="notif.url">
                    <strong>{{ notif.title }}</strong>
                    <p>{{ notif.body }}</p>
                    <small>{{ formatDate(notif.created_at) }}</small>
                </a>
                <span v-else>
                    <strong>{{ notif.title }}</strong>
                    <span>{{ notif.body }}</span>
                    <small style="direction: ltr;font-size: 10.3px;">{{ formatDate(notif.created_at) }}</small>
                </span>
            </li>
        </ul>
    </div>
</template>
<script setup>
    import { defineProps, defineEmits } from 'vue'
    import { sendApi } from '@/utils/api'
    import moment from 'moment-jalaali'
    const props = defineProps({ notifications: Array })
    const emit = defineEmits(['update'])
    function formatDate(date) {
        return moment(date).format('jYYYY/jMM/jDD HH:mm')
    }
    async function markAsRead(notif) {
        if (notif.is_read === 'dont') {
            const res = await sendApi({
                action: 'read_notifications',
                control: 'user',
                data: notif.id,
            })
            if (res.status === 'success') {
                emit('update', notif.id)
            }
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
        border-radius: 10px;
        margin-bottom: 5px;
        background-color: #edfcfa;
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
    a{
        text-decoration: none;
        color: #2f285a;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-wrap: nowrap;
        text-align: center;
        gap: 15px;
    }
</style>