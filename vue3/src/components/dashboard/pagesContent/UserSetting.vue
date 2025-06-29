<template>
    <div class="form-container">
        <h2 class="form-title">ویرایش اطلاعات</h2>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label class="form-label">تصویر پروفایل</label>
                <input type="file" accept="image/*" @change="handleImageChange" class="form-file" />
                <div v-if="form.image_preview" class="image-preview">
                    <img :src="form.image_preview" alt="پیش‌نمایش تصویر" />
                </div>
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
                <input v-model="form.mobile" type="text" class="form-input" />
            </div>
            
            <button class="form-button" type="submit">ویرایش</button>
        </form>
        <FingerPrintRegister />
    </div>
</template>
<script setup>
    import { ref, onMounted } from 'vue'
    import { useUserStore } from '@/stores/user'
    import { sendApi } from '@/utils/api'
    import FingerPrintRegister from '@/components/tooles/nav/FingerPrintRegister.vue'
    const userStore = useUserStore()
    const form = ref({
        name: '',
        family: '',
        mobile: '',
        image: null,
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
    const handleImageChange = (e) => {
        const file = e.target.files[0]
        if (file) {
            form.value.image = file
            form.value.image_preview = URL.createObjectURL(file)
        }
    }
    const submitForm = async () => {
        try {
            const formData = new FormData()
            formData.append('name', form.value.name)
            formData.append('family', form.value.family)
            formData.append('mobile', form.value.mobile)
            if (form.value.image) {
                formData.append('image', form.value.image)
            }

            const data = await sendApi({
                control: 'user',
                action: 'edit_user',
                data: formData,
                headers: { 'Content-Type': 'multipart/form-data' }
            })

            alert(data.data.message)
                await userStore.fetchUserInfo()
        } catch (e) {
            alert('خطا: ' + (e.response?.data?.message || e.message))
        }
    }
</script>
<style scoped>
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
