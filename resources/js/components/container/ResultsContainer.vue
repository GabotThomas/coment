<script setup>
import { watch, ref, onBeforeMount, computed } from "vue";
import { RouterLink, useRouter } from "vue-router";
import useFetch from "../../hooks/useFetch";
import useLocalStorage from "../../hooks/useLocalStorage";
import ResultSwipeContainer from "./ResultSwipeContainer.vue"
import Loader from "../util/Loader.vue";
import { Swiper, SwiperSlide } from 'swiper/vue';
import SwiperCore, { Pagination } from "swiper";
import 'swiper/css';

SwiperCore.use([Pagination]);

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
})

const image = computed(() => {
    return results.value.image || ''
})

const pages = computed(() => {
    return results.value.result_pages || []
})

</script>

<template>
    <div class="container">
        <Loader v-if="loading" />
        <div v-else class="card">
            <swiper :slides-per-view="1" :space-between="50" :pagination="{
                clickable: true,
            }">
                <swiper-slide v-for="(page, index) in pages" :key="page.id">
                    <ResultSwipeContainer :image="image" :pourcentage="pourcentage" :last="index == pages.length - 1" />
                </swiper-slide>
            </swiper>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</template>
