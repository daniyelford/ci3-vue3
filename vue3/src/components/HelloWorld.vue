<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <button @click="testApi" class="bg-blue-500 text-white px-4 py-2 rounded">
      ارسال درخواست
    </button>
    <pre v-if="result">{{ result }}</pre>

    <!-- مطالب اضافی همانطور که بود -->
  </div>
</template>

<script>
import { sendApi } from '@/utils/api'; // مسیر صحیح فایل sendApi.js

export default {
  name: 'HelloWorld',
  props: {
    msg: String
  },
  data() {
    return {
      result: null
    }
  },
  methods: {
    async testApi() {
      try {
        const res = await sendApi(JSON.stringify({ name: 'Ali', message: 'salam' }));
        this.result = JSON.stringify(res, null, 2);
      } catch (err) {
        this.result = JSON.stringify(err, null, 2);
      }
    }
  }
}
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
