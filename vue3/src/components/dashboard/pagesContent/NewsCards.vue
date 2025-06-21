<template>
    <div class="loading" v-if="!isLoaded">
        در حال بارگذاری...
    </div>
    <div class="card-inner" v-else-if="cards.length>0">
        <div v-for="card in cards" :key="card.id" class="card">
            <div class="card-header">
                <div class="location" v-if="card.location!==''">
                    {{ card.location }}
                </div>
                <div class="type" v-if="card.type ==='force'">
                    فوری
                </div>
                <div class="card-category">
                    {{ card.category }}
                </div>
            </div>
            <div class="medias" v-if="card.medias.length>0">
                <div class="media" v-for="media in card.medias" :key="media.id">
                    <img v-if="media.url && media.type==='image'" :src="media.url" alt="news image">
                    <video v-else-if="media.url && media.type==='video'" :src="media.url" controls></video>
                </div>
                {{ card.media }}
            </div>
            <div class="description" v-if="card.description!==''">
                {{ card.description }}
            </div>
            <div class="time">
                {{ moment(card.created_at).format('jYYYY/jMM/jDD') }}
            </div>
            <a class="choose" @click="addToList(card.id)">
                انتخاب
            </a>
        </div>
    </div>
    <div class="none-cart-error" v-else>
        خبری در محدوده شما وجود ندارد
    </div>
</template>
<script setup>
    import { ref,onMounted } from 'vue'
    import moment from 'moment-jalaali'
    import { sendApi } from '@/utils/api'
    import { useNotification } from '@kyvg/vue3-notification';
    const notif=useNotification() 
    const showNotification = () => {
        notif.notify({
            title: 'خبر جدید',
            text: 'اخبار روز محدوده ی خود را با ما دنبال کنید',
            type: 'info'
        });
    };
    showNotification();
    // const props = defineProps({
    //     filters: Object,
    // })
    const isLoaded = ref(false)
    const cards = ref([])
    onMounted(async () => {
        
        const news = await sendApi({action: 'get_news',control:'news'});
        if(news.status==="success") {
            if(news.data.length>0){
                cards.value = news.data.map(cat => ({
                    id: cat.id,
                    location: cat.location,
                    category: cat.category??'کلی',
                    description: cat.description,
                    created_at: cat.created_at,
                    type: cat.type,
                    medias: cat.media.map(media=>({
                        type:media.type,
                        url:media.url
                    })),
                }))
            }
            isLoaded.value=true
        } else {
            console.warn('دریافت دسته‌بندی‌ها ناموفق بود:', news)
        }
    })
    // const filteredCards = computed(() => {
    //     let result = (cards.value || []).filter(card => {
    //         const f = props.filters
    //         if (f) {
    //             // if (f.withInsight && !card.insight) return false
    //             if (Array.isArray(f.categories) && f.categories.length > 0 && !f.categories.includes(card.category)) {
    //                 return false
    //             }
    //             // if (Array.isArray(f.socialTypes) && f.socialTypes.length > 0 && !f.socialTypes.some(type => (card.type || '').includes(type))) {
    //             //     return false
    //             // }
    //         }
    //         // if (props.searchTerm) {
    //         //     const term = props.searchTerm.toLowerCase()
    //         //     const username = (card.username || '').toLowerCase()
    //         //     const title = (card.title || '').toLowerCase()
    //         //     if (!username.includes(term) && !title.includes(term)) return false
    //         // }
    //         return true
    //     })
    //     // if (props.sortKey) {
    //     //     result = [...result].sort((a, b) => (b[props.sortKey] ?? 0) - (a[props.sortKey] ?? 0))
    //     // }
    //     return result
    // })
    async function addToList(id){
        const response = await sendApi({action: 'add_news_to_list',control:'news',data:id});
        if(response.status ==='success'){
        //     const selectedCard = cards.value.find(card => card.id === id)
        //     if (selectedCard) {
        //         selectedCard.selected = true
        //     }
        }else{
            alert('ارتباط با اینترنت قطع است');            
        }
    }
</script>
<style scoped>
    .card-inner{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: wrap;
        align-content: flex-start;
        justify-content: center;
        align-items: stretch;
    }
    .card{
        width: 49%;
        min-height: 300px;
        margin: 0 0.5% 10px 0.5%;
        border-radius: 10px;
        box-shadow: 0 0 5px grey;
    }
    .media{
        height: 150px;
        width: auto;
        margin: auto;
    }
    .media img,.media video{
        width: 100%;
        height: 100%;
    }
    .card-header{
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: nowrap;
        justify-content: space-between;
        align-items: stretch;
        padding: 6px;
    }
    .description {
        height: 50px;
        padding: 5px;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 95%;
        text-align: center;
        white-space: nowrap;
    }
    .time{
        font-size: 10px;
        padding-left: 10px;
    }
    .choose{
        width: 95%;
        height: 30px;
        background: blue;
        margin: 5px auto;
        text-align: center;
        border-radius: 10px;
        color: white;
        display: block;
        padding-top: 10px;
    }
    /* .media video{ */
        /* max-width: 400px; max-height: 300px; margin: 0.5rem; */
    /* } */
    @media screen and (max-width:600px){
        .card{
            width: 99%;
        }
    }
</style>