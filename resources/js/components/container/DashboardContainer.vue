<script setup>
import { onBeforeMount, watch, ref } from "@vue/runtime-core";
import useFetch from "../../hooks/useFetch";

const [result, load, loading] = useFetch();
const levels = ref([]);


onBeforeMount(() => {
    load({
        url: 'levels'
    })
})

watch(result, (currentValue, old) => {
    if (currentValue && currentValue.success) {
        levels.value = currentValue.levels;
    }
})
</script>

<template>
    <div v-for="level in levels" :key="level.id">
        {{ level.levels.name }}
    </div>
</template>