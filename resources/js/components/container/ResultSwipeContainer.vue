<script setup>

const props = defineProps({
    //result: Object,
    image: String,
    pourcentage: Number
})

</script>

<template>
    <img :src="props.image" />
    <span>{{ props.pourcentage }}</span>
</template>