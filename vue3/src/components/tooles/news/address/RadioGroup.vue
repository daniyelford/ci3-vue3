<template>
    <label
        v-for="(option ) in props.options"
        :key="option.id"
        class="checkBox-inner">
        <input
        type="radio"
        :name="props.name"
        :value="option.id"
        @change="$emit('update:modelValue', option.id)"
        :checked="option.id === props.modelValue"
        />
        <span>{{ option.label }}</span>
    </label>
</template>
<script setup>
    import { defineProps } from 'vue'
    const props = defineProps({
        options: {
            type: Array,
            required: true
        },
        name:{
            type: String,
            required: true
        },
        modelValue: [String, Number]
    })
</script>
<style scoped>
  .checkBox-inner {
    height: 15px;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-items: stretch;
  }
  .checkBox-inner input {
    margin: 0;
    height: 10px;
  }
  .checkBox-inner span {
    font-size: 9px;
    padding-right: 2px;
  }
</style>