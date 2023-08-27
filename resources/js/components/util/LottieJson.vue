<script setup>
import { onUpdated, ref, watch } from 'vue';
import { Vue3Lottie } from 'vue3-lottie';

const props = defineProps({
    json: { type: String, default: '' }
});
const reRender = ref(false);
const control = ref();

watch(props, (current, old) => {
    console.log(props, reRender.value);
    reRender.value = true;
})

onUpdated(() => {
    if (reRender.value === true) {
        reRender.value = false;
    }
})

</script>
<template>
    <Vue3Lottie v-if="props.json && !reRender" ref="control" :animation-link="props.json" :height="160" :width="200" />
</template>