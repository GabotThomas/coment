<script setup>

const props = defineProps({
    image: String,
    pourcentage: Number,
    text: String
})

</script>

<template>
    <div class="result-container">
        <img :src="props.image" class="result-img mb-2" />
        <h1 class="result-text">Tu as obtenu le score de </h1>
        <div class="flex">
            <span class="result-number">{{ props.pourcentage }}%</span>
            <span class="mb-2">{{ props.text }}</span>
        </div>
    </div>
</template>
