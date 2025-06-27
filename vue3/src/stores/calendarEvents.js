import { defineStore } from 'pinia'
import { ref } from 'vue'
import moment from 'jalali-moment'
import { sendApi } from '@/utils/api'
export const useCalendarEventsStore = defineStore('calendarEvents', () => {
    const events = ref([])
    const vacations = ref([])
    const getRandomColor = () => {
        const colors = ['#29B6F6', '#FF7043', '#66BB6A', '#AB47BC', '#FFA726', '#26C6DA', '#EC407A']
        return colors[Math.floor(Math.random() * colors.length)]
    }
    const loadEvents = async () => {
        try {
            const res = await sendApi({ control: 'news', action: 'get_news_for_month' })
            if (res.status === 'success') {
                events.value = (res.data || []).map(item => ({
                    id: item.news?.id || 0,
                    title: item.news?.description?.slice(0, 20) || 'بدون عنوان',
                    startDateTime: moment(item.start),
                    endDateTime: item.end && item.end.trim?.() !== '' ? moment(item.end) : moment(),
                    color: getRandomColor(),
                    raw: item,
                }))
            }
        } catch (e) {
            console.error('Error loading events:', e)
        }
    }
    return {
        events,
        vacations,
        loadEvents
    }
})