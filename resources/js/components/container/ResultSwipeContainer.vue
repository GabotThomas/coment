<script setup>

const props = defineProps({
    //result: Object,
    image: String,
    pourcentage: Number,
    last: Boolean
})

</script>

<template>
    <div>
        <img :src="props.image" />
        <span>{{ props.pourcentage }}</span>
    </div>
</template>