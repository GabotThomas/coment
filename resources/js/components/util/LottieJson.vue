<script setup>
import { onUpdated, ref, watch } from 'vue';
import { Vue3Lottie } from 'vue3-lottie';

const props = defineProps({
    json: { type: String, default: '' }
});

</script>
<template>
    <Vue3Lottie v-if="props.json" :animation-link="props.json" :height="160" :width="200" />
</template>