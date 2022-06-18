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
import Button from "../util/Button.vue";

SwiperCore.use([Pagination]);

const { getStoredItem } = useLocalStorage();
const router = useRouter();
const { id } = router.currentRoute.value.params;

const [result, load, loading] = useFetch();

const results = ref({});
const pourcentage = ref();
const swiperButton = ref({});
const activeIndex = ref(0);

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

const handleInit = (ev) => {
    swiperButton.value = ev;
}

const handleSlideChange = (e) => {
    activeIndex.value = e.activeIndex;
}

const handleNext = (e) => {
    swiperButton.value.slideNext();
}

const lastSlide = computed(() =>
    activeIndex.value == results.value.totalPages - 1
)

</script>

<template>
    <div class="container ui container result">
        <Loader v-if="loading" />
        <div v-else class="card">
            <swiper :slides-per-view="1" :space-between="50" :pagination="{
                clickable: true
            }" @init="handleInit" @slide-change="handleSlideChange">
                <swiper-slide v-for="(page) in pages" :key="page.id">
                    <ResultSwipeContainer :image="image" :pourcentage="pourcentage" :text="page.text"
                        class="text-align" />
                </swiper-slide>
                <Button v-if="!lastSlide" v-on:click="handleNext" class="btn-primary">En
                    savoir
                    plus</Button>
                <router-link v-else class="btn-link-text" :to="{ name: 'Register' }">
                    <Button class="btn-primary">
                        Continuer
                    </Button>
                </router-link>
            </swiper>
        </div>
    </div>
</template>
