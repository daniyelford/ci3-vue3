<template>
    <div class="form-container">
        <h2 class="form-title">ویرایش اطلاعات</h2>
        <form @submit.prevent="submitForm">
            <div class="form-group image-inner">
                <UploadSingleImageUser url="register/" toAction="user-mobile" :image="form.image_preview" 
                @uploaded="({ id, url }) => {
                    form.image_preview = url
                    form.image_id = id
                }"/>
            </div>
            <div class="form-group">
                <label class="form-label">نام</label>
                <input v-model="form.name" type="text" class="form-input" />
            </div>
            <div class="form-group">
                <label class="form-label">نام خانوادگی</label>
                <input v-model="form.family" type="text" class="form-input" />
            </div>
            <div class="form-group">
                <label class="form-label">شماره تماس</label>
                <input v-model="form.mobile" disabled type="text" class="form-input" />
            </div>
            <div class="form-group tx-c">
                <label class="form-label">تغییر اثر انگشت</label>
                <FingerPrintRegister :hasFinger="false"/>
            </div>
            <button class="form-button" type="submit">ویرایش</button>
        </form>
    </div>
</template>
<script setup>
    import { ref, onMounted } from 'vue'
    import { useUserStore } from '@/stores/user'
    import { sendApi } from '@/utils/api'
    import UploadSingleImageUser from '@/components/tooles/upload/UploadSingleImageUser.vue'
    import FingerPrintRegister from '@/components/tooles/nav/FingerPrintRegister.vue'
    import router from '@/router'
    const userStore = useUserStore()
    const form = ref({
        name: '',
        family: '',
        mobile: '',
        image_id: null,
        image_preview: '' 
    })
    onMounted(() => {
        if (!userStore.isLoaded) {
            userStore.fetchUserInfo().then(() => {
                fillForm()
            })
        } else {
            fillForm()
        }
    })
    const fillForm = () => {
        form.value.name = userStore.name || ''
        form.value.family = userStore.family || ''
        form.value.mobile = userStore.mobile || ''
        form.value.image_preview = userStore.image || ''
    }
    const submitForm = async () => {
        if (!form.value.name || !form.value.family) {
            alert('لطفاً تمام فیلدها را وارد کنید.')
            return
        }
        try {
            const data = await sendApi({
                control: 'user',
                action: 'edit_user',
                data: {
                    name: form.value.name,
                    family: form.value.family,
                    image_id: form.value.image_id,
                },
            })
            if(data.status==='success'){
                await userStore.fetchUserInfo()
                router.push({ path:'/dashboard' })
            }
        } catch (e) {
            alert('خطا: ')
        }
    }
</script>
<style scoped>
    .image-inner{
        width: 50%;
        margin: auto;
    }
    .tx-c{
        text-align: center;
    }
    .form-container {
        padding: 20px;
        max-width: 500px;
        margin: 0 auto;
        background-color: #fefefe;
        border: 1px solid #ddd;
        border-radius: 10px;
    }
    .form-title {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 16px;
    }
    .form-label {
        display: block;
        direction: rtl;
        font-weight: bold;
        margin-bottom: 6px;
        color: #333;
    }
    .form-input {
        width: 100%;
        padding: 10px 12px;
        font-size: 14px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #f9f9f9;
        transition: 0.3s border-color ease;
    }
    .form-input:focus {
        outline: none;
        border-color: #007bff;
        background-color: #fff;
    }
    .form-file {
        width: 100%;
        padding: 6px 0;
        font-size: 14px;
    }
    .image-preview {
        margin-top: 10px;
    }
    .image-preview img {
        width: 100%;
        max-height: 200px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
    .form-button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 16px;
        font-size: 15px;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        transition: 0.2s background-color ease;
    }
    .form-button:hover {
        background-color: #0056b3;
    }
</style>
