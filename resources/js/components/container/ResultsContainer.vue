<script setup>
import { watch, ref, onBeforeMount, computed } from "vue";
import { RouterLink, useRouter } from "vue-router";
import useFetch from "../../hooks/useFetch";
import useLocalStorage from "../../hooks/useLocalStorage";
import ResultSwipeContainer from "./ResultSwipeContainer.vue"
import Loader from "../util/Loader.vue";

const { getStoredItem } = useLocalStorage();
const router = useRouter();
const { id } = router.currentRoute.value.params;

const [result, load, loading] = useFetch();

const results = ref({});
const pourcentage = ref();

const handleLoad = () => {
    load({
        url: "result/" + id,
    });
};

watch(result, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        results.value = currentValue.result;
    }
});

onBeforeMount(() => {
    handleLoad();
    const resultStore = getStoredItem('result');
    pourcentage.value = resultStore.pourcentage;
    console.log(pourcentage)
})

const image = computed(() => {
    return results.value.image || ''
})

</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <Loader v-if="loading" />
                <div v-else class="card">
                    <ResultSwipeContainer :image="image" :pourcentage="pourcentage" />
                </div>
            </div>
        </div>
    </div>
</template>
