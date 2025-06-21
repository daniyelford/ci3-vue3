<template>
    <div class="loading" v-if="!isLoaded">
        در حال بارگذاری...
    </div>
    <div class="card-inner" v-else-if="cards.length>0">
        <div v-for="card in cards" :key="card.id" class="card">
            <div class="info">
                <div class="card-header">
                    <div class="location" v-if="card.location!==''">
                        {{ card.location }}
                    </div>
                    <div class="card-category">
                        {{ card.category }}
                    </div>
                </div>
                <div class="medias" v-if="card.media!==''">
                    {{ card.media }}
                </div>
                <div class="name">
                    <p>{{ card.description }}</p>
                </div>
            </div>
            <div class="time">
                <span>
                    زمان ثبت
                </span>
                <span>
                    {{ moment(card.created_at).format('jYYYY/jMM/jDD') }}
                </span>
            </div>
            <div class="type" v-if="card.type ==='force'">
                فوری
            </div>
            <div class="choose">
                <a @click="select(card.id)">
                    انتخاب
                </a>
            </div>
        </div>
    </div>
    <div class="none-cart-error" v-else>
        خبری در محدوده شما وجود ندارد
    </div>
</template>
<script setup>
    import { onMounted ,ref } from 'vue'
    import moment from 'moment-jalaali'
    import { sendApi } from '@/utils/api'
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
                    media: cat.media,
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
    // async function select(id){
    //     // const response = await sendApi({action: "page_handler/telegram_cards", handler:'select_card', data: id});
    //     // if(response.status ==='success'){
    //     //     const selectedCard = cards.value.find(card => card.id === id)
    //     //     if (selectedCard) {
    //     //         selectedCard.selected = true
    //     //     }
    //     // }else{
    //     //     alert('ارتباط با اینترنت قطع است');            
    //     // }
    // }
</script>
<style scoped>
    .card-inner{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: row-reverse;
        flex-wrap: wrap;
        align-content: flex-start;
        justify-content: flex-start;
        align-items: stretch;
    }
    .card{
        width: 23%;
        height: 210px;
        margin: 0 1% 0 0;
        border-radius: 10px;
        box-shadow: 0 0 5px grey;
    }
    .info{
        margin-top: 7px;
    }
    .img {
        float: left;
        width: 40px;
        height: 40px;
        margin: 0 5px 0 15px;
    }
    .img img{
        width: 100%;
        height: 100%;
        border-radius: 50px;
    }
    .name{
        text-align: start;
        width: calc(100% - 60px);
        display: inline-block;
        padding: 5px;
    }
    .name p:first-child{
        font-size: 10px;
    }
    .name p:last-child{
        font-size: 12px;
    }
    .follwer{
        width: 100%;
        display: flex;
        margin-top: -3px;
        margin-bottom: 7px;
        height: 30px;
        flex-direction: row-reverse;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: stretch;
        text-align: center;
    }
    .count{
        padding-right: 10px;
    }
    .inflowence{
        padding-left: 10px;
    }
    .count,.inflowence{
        width: 50%;
        display: inline-block;
    }
    .count p,.inflowence p{
        margin-top: -12px;
        font-size: 12px;
    }
    .count svg,.inflowence svg{
        height: 20px;
        width: 20px;
        fill: grey;
    }
    .category,.admin-info,.price{
        height: 25px;
        text-align: center;
        width: 85%;
        margin: 2px auto;
        border-radius: 6px;
        background: lightgray;
    }
    .category svg,.admin-info svg,.price svg{
        width: 15px;
        float: left;
        height: 15px;
        margin: 5px;
        fill: gray;
    }
    .order-name{
        margin-top: 4px;
        font-size: 12px;
    }
    .time {
        width: 80%;
        margin: 0 auto;
    }
    .time span {
        font-size: 10px;
    }
    .time span:first-child{
        float: right;
        direction: rtl;
    }
    .time span:last-child{
        float: left;
    }
    .choose {
        width: 85%;
        margin: 0 auto;
    }
    .choosen{
        width: 100%;
        display: inline-block;
        background: grey;
        color: white;
        border-radius: 10px;
        height: 22px;
        text-align: center;
        font-size: 12px;
        padding-top: 3px;
    }
    .choose a{
        width: 100%;
        background: #00f;
        color: #fff;
        border-radius: 10px;
        display: inline-block;
        height: 22px;
        text-align: center;
        font-size: 12px;
        cursor: pointer;
    }
    .loading{
        width: 90%;
        text-align: center;
        background: rgb(166, 181, 228);
        margin: 0 auto;
        border-radius: 10px;
        color: white;
        font-size: 20px;
        height: 150px;
        padding-top: 55px;
    }
    .none-cart-error {
        width: 90%;
        text-align: center;
        background: red;
        margin: 0 auto;
        border-radius: 10px;
        color: white;
        font-size: 20px;
        height: 150px;
        padding-top: 55px;
    }
</style>