<script setup>
    import { ref, onMounted } from 'vue'
    import NotificationList from '@/components/tooles/nav/NotificationList.vue'
    import { BASE_URL } from '@/config'
    import { useNotificationStore } from '@/stores/notification'
    const logo = BASE_URL + '/assets/images/logo.png'
    const song = BASE_URL + '/assets/song/notif.mp3'
    const showList = ref(false)
    const notifSound = ref(null)
    const store = useNotificationStore()
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
                icon: logo,
            })
            notification.onclick = () => {
                window.focus()
                notification.close()
            }
        }
    }
    async function pollNotifications() {
    const prevLastId = store.lastId
    await store.fetchNotifications()
    const newOnes = store.notifications.filter(n => n.id > prevLastId)
        newOnes.forEach(n => {
            playSound()
            showNativeNotification(n.title, n.body)
        })
    }
    function handleMarkAsRead(id) {
        store.markAsRead(id)
    }
    onMounted(() => {
        if (Notification.permission === 'default') {
            Notification.requestPermission()
        }
        pollNotifications()
        setInterval(pollNotifications, 10000)
    })
</script>
<template>
    <div>
        <div class="icon-wrapper" @click="toggleList">
            🔔
            <span class="badge" v-if="store.unreadCount > 0">
                {{ store.unreadCount }}
            </span>
        </div>
        <div class="dropdown" v-if="showList">
            <NotificationList
            :notifications="store.notifications"
            @update="handleMarkAsRead"
            />
        </div>
        <audio ref="notifSound" :src="song" preload="auto"></audio>
    </div>
</template>
<style scoped>
    .icon-wrapper {
        font-size: 24px;
        cursor: pointer;
        position: relative;
    }
    .badge {
        position: absolute;
        top: -6px;
        right: -10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
    }
    .dropdown {
        position: fixed;
        top: 60px;
        left: 0;
        width: 300px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }
</style>