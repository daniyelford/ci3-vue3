<template>
    <div class="notification-wrapper">
        <div class="icon-wrapper" @click="toggleList">
            🔔
            <span class="badge" v-if="unreadCount > 0">{{ unreadCount }}</span>
        </div>
        <div class="dropdown" v-if="showList">
            <NotificationList @read="updateCount" />
        </div>
        <audio ref="notifSound" :src="song" preload="auto"></audio>
    </div>
</template>
<script setup>
    import { ref, onMounted } from 'vue'
    import NotificationList from '@/components/tooles/nav/NotificationList.vue'
    import { sendApi } from '@/utils/api'
    import { BASE_URL } from '@/config';
    const logo = BASE_URL+'/assets/images/logo.png'
    const song = BASE_URL+'/assets/song/notif.mp3'
    const showList = ref(false)
    const unreadCount = ref(0)
    const lastNotificationId = ref(0)
    const notifSound = ref(null)
    function toggleList() {
        showList.value = !showList.value
    }
    function playSound() {
        notifSound.value?.play().catch(() => {})
    }
    function showNativeNotification(title, body) {
        if (Notification.permission === 'granted') {
            const notification = new Notification(title, {
                body,
                icon: logo
            })
            notification.onclick = () => {
                window.focus()
                notification.close()
            }
        }
    }
    async function fetchUnreadCount() {
        const res = await sendApi({ action: 'get_notifications_counts', control: 'user' })
        if (res.status === 'success') {
            unreadCount.value = res.data
        }
    }
    async function pollNotifications() {
        const res = await sendApi({ action: 'get_notifications', control: 'user' })
        if (res.status === 'success' && Array.isArray(res.data)) {
            for (const notif of res.data) {
                if (notif.id > lastNotificationId.value) {
                    lastNotificationId.value = notif.id
                    playSound()
                    showNativeNotification(notif.title, notif.body)
                    fetchUnreadCount()
                }
            }
        }
    }
    function updateCount() {
        fetchUnreadCount()
    }
    onMounted(() => {
        if (Notification.permission === 'default') {
            Notification.requestPermission()
        }
        fetchUnreadCount()
        pollNotifications()
        setInterval(fetchUnreadCount, 30000)
        setInterval(pollNotifications, 10000)
    })
</script>
<style scoped>
    .notification-wrapper {
        position: relative;
        display: inline-block;
    }
    .icon-wrapper {
        position: relative;
        font-size: 24px;
        cursor: pointer;
    }
    .badge {
        position: absolute;
        top: -6px;
        right: -6px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
    }
    .dropdown {
        position: absolute;
        top: 35px;
        right: 0;
        width: 300px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
        z-index: 10;
    }
</style>