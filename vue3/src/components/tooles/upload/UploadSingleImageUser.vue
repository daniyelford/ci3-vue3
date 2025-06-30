<template>
    <div class="upload-box" @click="fileInput.click()">
        <input type="file" ref="fileInput" @change="onFileChange" />
        <div v-if="reading" class="progress-bar">
            <div class="progress" :style="{ width: readProgress + '%' }"></div>
            <p>{{ readProgress.toFixed(0) }}%</p>
        </div>
        <div v-if="imageUrl" class="preview">
            <img :src="imageUrl" alt="uploaded" />
        </div>
    </div>
</template>
<script setup>
    import { ref,defineProps,defineEmits,watch,onMounted } from 'vue';
    import { sendApi } from '@/utils/api';
    const emit = defineEmits(['uploaded']);
    const selectedFileBase64 = ref('');
    const imageUrl = ref('');
    const fileInput = ref(null);
    const imageId = ref('');
    const readProgress = ref(0);
    const reading = ref(false);
    const props = defineProps({
        toAction: String,
        url: String,
        image: String
    })
    onMounted(() => {
        if (props.image) {
            imageUrl.value = props.image
        }
    })
    watch(() => props.image, (newVal) => {
        if (newVal) {
            imageUrl.value = newVal
        }
    })
    function toBase64WithProgress(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reading.value = true;
            readProgress.value = 0;
            reader.onprogress = (event) => {
                if (event.lengthComputable) {
                readProgress.value = (event.loaded / event.total) * 100;
                }
            };
            reader.onload = () => {
                reading.value = false;
                resolve(reader.result);
            };
            reader.onerror = error => {
                reading.value = false;
                reject(error);
            };
            reader.readAsDataURL(file);
        });
    }
    const onFileChange = async (e) => {
        const file = e.target.files[0];
        if (!file) return;
        try {
            selectedFileBase64.value = await toBase64WithProgress(file);
            await upload();
        } catch (error) {
            console.error('خطا در خواندن فایل:', error);
            alert('خطا در خواندن فایل انتخاب شده.');
        }
    };
    const upload = async () => {
        if (!selectedFileBase64.value) {
            alert('لطفاً یک فایل انتخاب کنید.');
            return;
        }
        try {
            const response = await sendApi({
                action: 'upload_single_image',
                data:{
                    url: props.url,
                    data: selectedFileBase64.value,
                    toAction:props.toAction,
                }, 
                control:'upload'
            });
            if (response.status === 'success' && response.url) {
                imageUrl.value = response.url;
                imageId.value = response.id;
                emit('uploaded', response.url);
            } else {
                alert(response.message || 'آپلود موفق نبود');
            }
        } catch (err) {
            console.error('خطا در ارسال به سرور:', err);
            alert('مشکلی در آپلود پیش آمد');
        }
    };
</script>
<style scoped>
    .upload-box {
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        overflow: hidden;
    }
    input[type="file"] {
        visibility: hidden;
    }
    .preview {
        width: 100%;
        height: 100%;
    }
    img{
        width: 100%;
        height: 100%;
        border-radius: 150px;
    }
    .progress-bar {
        width: 96%;
        background: #eee;
        border: 1px solid #ccc;
        height: 22px;
        border-radius: 6px;
        overflow: hidden;
        margin: 0 2%;
    }
    .progress {
        background: #4caf50;
        height: 100%;
        width: 0%;
        transition: width 0.2s ease;
    }
    .progress-bar p {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        margin: 0;
        font-size: 12px;
        color: #000;
        top: 2px;
    }
</style>
