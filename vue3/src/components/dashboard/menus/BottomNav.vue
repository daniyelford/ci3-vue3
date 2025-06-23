<template>
    <div class="nav">
        <FingerPrintRegister/>
        <RouterLink v-if="props.Wallet" to="wallet">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0,0,256,256"><g fill-opacity="0" fill="#dddddd" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,256v-256h256v256z" id="bgRectangle"></path></g><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(0.53222,0.53222)"><path d="M442.5,136v305c0,17.67 -14.33,32 -32,32h-364c-17.67,0 -32,-14.33 -32,-32v-305c0,-17.67 14.33,-32 32,-32h364c17.67,0 32,14.33 32,32z" fill="#a2770e"></path><path d="M405.634,126h-339.134c-17.673,0 -32,14.332 -32,32.005c0,174.066 -0.13,250.02 -0.034,283.767c0.037,12.878 -19.349,13.566 -19.933,0.701c-0.052,-1.152 -0.033,19.772 -0.033,-306.473c0,-17.673 14.327,-32 32,-32h359.134c14.007,0 14.879,22 0,22z" fill="#6e3c0b"></path><path d="M334.5,116c0,40.547 -22.504,76.588 -56.72,95.07h-102.56c-34.141,-18.441 -56.72,-54.44 -56.72,-95.07c0,-59.65 48.35,-108 108,-108c59.65,0 108,48.35 108,108z" fill="#ffdd07"></path><path d="M127.19,158.484c-30.841,-72.034 23.169,-150.728 99.663,-150.483c13.408,0.043 15.936,19.129 2.971,22.548c-52.178,13.758 -88.334,68.494 -80.696,121.943c1.894,13.253 -16.668,18.3 -21.938,5.992z" fill="#ab8f07"></path><path d="M442.47,442.61c-1.26,29.69 -45.97,28.26 -45.97,-1.46v-152.6c0,-42.79 -34.69,-77.48 -77.48,-77.48h-195.22c-29.94,0 -29.37,-48.841 -0.61,-48.841h295.31c13.25,0 24,10.749 24,23.999c0,4.55 0.02,255.312 -0.03,256.382z" fill="#6e3c0b"></path><path d="M462.887,282v63c0,9.94 -8.06,18 -18,18h-72.5c-27.34,0 -49.5,-22.16 -49.5,-49.5c0,-27.328 22.16,-49.5 49.5,-49.5h72.5c9.94,0 18,8.06 18,18z" fill="#633c14"></path><path d="M445.994,264.033c9.537,0.579 8.875,14.967 -0.68,14.967h-47.927c-32.184,0 -56,30.369 -47.958,61.798c1.915,7.486 -7.32,12.614 -12.683,7.052c-8.581,-8.899 -13.859,-21.006 -13.859,-34.35c0,-27.329 22.161,-49.5 49.5,-49.5c0,0 73.241,0.011 73.607,0.033z" fill="#637075"></path><path d="M85.5,154c0,4.418 3.582,8 8,8h317c13.233,0 24,10.766 24,24v47.226c0,4.418 3.582,8 8,8c4.418,0 8,-3.582 8,-8v-47.226c0,-22.056 -17.944,-40 -40,-40h-198v-22h30.519c4.183,0 8.102,1.642 11.034,4.622c3.101,3.15 8.166,3.188 11.313,0.091c3.149,-3.099 3.189,-8.165 0.091,-11.313c-5.965,-6.062 -13.934,-9.399 -22.438,-9.399h-30.519v-31.001h30.519c8.454,0 15.481,6.848 15.481,15.519c0,4.418 3.582,7.981 8,7.981c4.418,0 8,-3.601 8,-8.019c0,-15.137 -10.74,-27.81 -25,-30.807v-11.674c0,-4.418 -3.582,-8 -8,-8c-4.418,0 -8,3.582 -8,8v11h-21v-11c0,-4.418 -3.582,-8 -8,-8c-4.418,0 -8,3.582 -8,8v11h-10c-4.418,0 -8,3.582 -8,8c0,4.418 3.582,8 8,8h10v69h-65.407c-20.286,-64.544 28.228,-130 95.407,-130c57.123,0 103.381,48.222 99.808,106.27c-0.272,4.41 3.083,8.205 7.492,8.477c4.411,0.27 8.205,-3.083 8.478,-7.493c0.252,-4.11 0.271,-7.591 0.146,-11.253h68.076c13.233,0 24,10.767 24,24c0,4.418 3.582,8 8,8c4.418,0 8,-3.582 8,-8c0,-22.056 -17.944,-40 -40,-40h-69.731c-9.505,-54.466 -57.125,-96.001 -114.269,-96.001c-75.843,0 -131.809,72.17 -112.077,146h-20.923c-4.418,0 -8,3.582 -8,8z" fill="#000000"></path><path d="M448.5,256h-72.5c-31.706,0 -57.5,25.794 -57.5,57.5c0,31.706 25.794,57.5 57.5,57.5h19.081c4.418,0 8,-3.582 8,-8c0,-4.418 -3.582,-8 -8,-8h-19.081c-22.883,0 -41.5,-18.617 -41.5,-41.5c0,-22.883 18.617,-41.5 41.5,-41.5h72.5c5.514,0 10,4.486 10,10v63c0,5.514 -4.486,10 -10,10h-6c-4.418,0 -8,3.582 -8,8v78c0,13.234 -10.767,24 -24,24h-364c-13.234,0 -24,-10.766 -24,-24v-305c0,-13.234 10.766,-24 24,-24h36.581c4.418,0 8,-3.582 8,-8c0,-4.418 -3.582,-8 -8,-8h-36.581c-22.056,0 -40,17.944 -40,40v305c0,22.056 17.944,40 40,40h364c22.056,0 40,-17.944 40,-40v-70.085c13.405,-1.026 24,-12.253 24,-25.915v-63c0,-14.336 -11.663,-26 -26,-26z" fill="#000000"></path><path d="M376.5,305c-4.418,0 -8,3.582 -8,8c0,4.418 3.582,8 8,8h14c4.418,0 8,-3.582 8,-8c0,-4.418 -3.582,-8 -8,-8z" fill="#000000"></path></g></g></svg>
        </RouterLink>
        <RouterLink v-else to="dashboard">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M18,21H6c-1.657,0-3-1.343-3-3V8.765c0-1.09,0.591-2.093,1.543-2.622l6-3.333	c0.906-0.503,2.008-0.503,2.914,0l6,3.333C20.409,6.672,21,7.676,21,8.765V18C21,19.657,19.657,21,18,21z" opacity=".35"/><path d="M15,21H9v-6c0-1.105,0.895-2,2-2h2c1.105,0,2,0.895,2,2V21z"/></svg>
        </RouterLink>
        <RouterLink v-if="props.add" to="add-news">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0,0,256,256"><defs><linearGradient x1="9.858" y1="9.858" x2="38.142" y2="38.142" gradientUnits="userSpaceOnUse" id="color-1"><stop offset="0" stop-color="#17cc6d"></stop><stop offset="1" stop-color="#28714b"></stop></linearGradient></defs><g fill-opacity="0" fill="#dddddd" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,256v-256h256v256z" id="bgRectangle"></path></g><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.33333,5.33333)"><path d="M44,24c0,11.045 -8.955,20 -20,20c-11.045,0 -20,-8.955 -20,-20c0,-11.045 8.955,-20 20,-20c11.045,0 20,8.955 20,20z" fill="url(#color-1)"></path><path d="M34,21h-7v-7c0,-1.105 -0.895,-2 -2,-2h-2c-1.105,0 -2,0.895 -2,2v7h-7c-1.105,0 -2,0.895 -2,2v2c0,1.105 0.895,2 2,2h7v7c0,1.105 0.895,2 2,2h2c1.105,0 2,-0.895 2,-2v-7h7c1.105,0 2,-0.895 2,-2v-2c0,-1.105 -0.895,-2 -2,-2z" fill="#000000" opacity="0.05"></path><path d="M34,21.5h-7.5v-7.5c0,-0.828 -0.672,-1.5 -1.5,-1.5h-2c-0.828,0 -1.5,0.672 -1.5,1.5v7.5h-7.5c-0.828,0 -1.5,0.672 -1.5,1.5v2c0,0.828 0.672,1.5 1.5,1.5h7.5v7.5c0,0.828 0.672,1.5 1.5,1.5h2c0.828,0 1.5,-0.672 1.5,-1.5v-7.5h7.5c0.828,0 1.5,-0.672 1.5,-1.5v-2c0,-0.828 -0.672,-1.5 -1.5,-1.5z" fill="#000000" opacity="0.07"></path><path d="M23,13h2c0.552,0 1,0.448 1,1v20c0,0.552 -0.448,1 -1,1h-2c-0.552,0 -1,-0.448 -1,-1v-20c0,-0.552 0.448,-1 1,-1z" fill="#ffffff"></path><path d="M35,23v2c0,0.552 -0.448,1 -1,1h-20c-0.552,0 -1,-0.448 -1,-1v-2c0,-0.552 0.448,-1 1,-1h20c0.552,0 1,0.448 1,1z" fill="#ffffff"></path></g></g></svg>
        </RouterLink>
        <RouterLink v-else to="dashboard">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M18,21H6c-1.657,0-3-1.343-3-3V8.765c0-1.09,0.591-2.093,1.543-2.622l6-3.333	c0.906-0.503,2.008-0.503,2.914,0l6,3.333C20.409,6.672,21,7.676,21,8.765V18C21,19.657,19.657,21,18,21z" opacity=".35"/><path d="M15,21H9v-6c0-1.105,0.895-2,2-2h2c1.105,0,2,0.895,2,2V21z"/></svg>
        </RouterLink>
        <RouterLink v-if="props.list" to="report-list">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0,0,256,256"><g fill-opacity="0" fill="#dddddd" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,256v-256h256v256z" id="bgRectangle"></path></g><g fill="#166419" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M4,5h16v15h-16z" opacity="0.3"></path><path d="M19,3h-4.184c-0.413,-1.163 -1.512,-2 -2.816,-2c-1.304,0 -2.403,0.837 -2.816,2h-4.184c-1.105,0 -2,0.895 -2,2v14c0,1.105 0.895,2 2,2h14c1.105,0 2,-0.895 2,-2v-14c0,-1.105 -0.895,-2 -2,-2zM12,3c0.552,0 1,0.448 1,1c0,0.552 -0.448,1 -1,1c-0.552,0 -1,-0.448 -1,-1c0,-0.552 0.448,-1 1,-1zM11,16.414l-3.772,-3.772l1.414,-1.414l2.358,2.358l4.792,-4.792l1.414,1.414zM19,19h-14v-14h14z"></path></g></g></svg>
        </RouterLink>
        <RouterLink v-else to="dashboard">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M18,21H6c-1.657,0-3-1.343-3-3V8.765c0-1.09,0.591-2.093,1.543-2.622l6-3.333	c0.906-0.503,2.008-0.503,2.914,0l6,3.333C20.409,6.672,21,7.676,21,8.765V18C21,19.657,19.657,21,18,21z" opacity=".35"/><path d="M15,21H9v-6c0-1.105,0.895-2,2-2h2c1.105,0,2,0.895,2,2V21z"/></svg>
        </RouterLink>
        <LogOutUser/>
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    import FingerPrintRegister from '@/components/tooles/nav/FingerPrintRegister.vue';
    import LogOutUser from '@/components/tooles/nav/LogOutUser.vue';
    const props=defineProps({
        add:Boolean,
        list:Boolean,
        Wallet:Boolean,
    })
</script>
<style scoped>
    .nav {
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row-reverse;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }
    a{
        width: 40px;
        height: 40px;
        text-decoration: none;
        color: black;
        display: inline-block;
    }
    svg{
        width: 100%;
        height: 100%;
    }

</style>