<script setup>
import { watch, ref, onBeforeMount, computed } from "vue";
import { RouterLink, useRouter } from "vue-router";
import useFetch from "../../hooks/useFetch";
import useLocalStorage from "../../hooks/useLocalStorage";
import ResultSwipeContainer from "./ResultSwipeContainer.vue"
import Loader from "../util/Loader.vue";
import { Swiper, SwiperSlide, useSwiper } from 'swiper/vue';
import SwiperCore, { Pagination } from "swiper";
import 'swiper/css';

SwiperCore.use([Pagination]);

const { getStoredItem } = useLocalStorage();
const router = useRouter();
const { id } = router.currentRoute.value.params;

const [result, load, loading] = useFetch();

const results = ref({});
const pourcentage = ref();
const swiperButton = ref({});
const swiperChange = ref({});

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

const handleInit = (ev)=>{
   swiperButton.value = ev;
   console.log(swiperButton);
   console.log("pages", pages);
}

const handleSlideChange = () => {

}

</script>

<template>
    <div class="container ui container result">
        <Loader v-if="loading" />
        <div v-else class="card">
            <swiper :slides-per-view="1" :space-between="50" :pagination="{
                clickable: true
            }" @init="handleInit" @slide-change="handleSlideChange">
                <swiper-slide v-for="(page) in pages" :key="page.id">
                    <ResultSwipeContainer :image="image" :pourcentage="pourcentage" :text="page.text" class="text-align"/>
                </swiper-slide>
            <button v-on:click="swiperButton.slideNext" class="btn btn-primary">En savoir plus</button>
            <button class="btn btn-primary"><router-link class="btn-link-text" :to="{ name: 'Register' }">Continer</router-link></button>
            </swiper>
        </div>
    </div>
</template>
