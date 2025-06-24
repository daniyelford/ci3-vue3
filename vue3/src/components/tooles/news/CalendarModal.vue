<template>
    <div class="modal-mask" @click.self="close">
        <div class="modal-container">
            <h3>انتخاب زمان اجرا</h3>
            <div class="calendar-container">
                <date-picker
                v-model="selectedDate"
                format="jYYYY/jMM/jDD"
                display-format="jYYYY/jMM/jDD"
                auto-submit
                />
            </div>
            <div class="actions">
                <button @click="submit">ثبت</button>
                <button @click="close">انصراف</button>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref,defineEmits } from 'vue'
    import DatePicker from 'vue3-persian-datetime-picker'
    const emit = defineEmits(['close', 'submit'])
    const selectedDate = ref(null)
    function close() {
        emit('close')
    }
    function submit() {
        if (!selectedDate.value) {
            alert('لطفاً تاریخ را انتخاب کنید')
            return
        }
        emit('submit', {
            date: selectedDate.value
        })
        close()
    }
</script>
<style scoped>
    .modal-mask {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999;
    }
    .modal-container {
        background: white;
        padding: 20px;
        border-radius: 12px;
        min-width: 300px;
        max-width: 400px;
        text-align: center;
    }
    .radio-group {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 10px 0;
    }
    .calendar-container {
        margin-top: 15px;
    }
    .actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
</style>
