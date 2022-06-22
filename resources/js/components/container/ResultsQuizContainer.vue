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
import ResultStatContainer from "./ResultStatContainer.vue";
import ResultDataContainer from "./ResultDataContainer.vue";
import ResultRegisterContainer from "./ResultRegisterContainer.vue";

SwiperCore.use([Pagination]);

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
        results.value = currentValue.resultUser.result;
        pourcentage.value = currentValue.resultUser.score;
    }
});

onBeforeMount(() => {
    handleLoad();
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
                <div class="pl-2 pr-2">
                    <Button v-if="!lastSlide" v-on:click="handleNext" class="btn-primary mb-0_5">En
                        savoir
                        plus</Button>
                    <router-link class="btn-link-text" :to="{ name: 'Dashboard' }">
                        <Button class="btn-secondary">
                            Retour
                        </Button>
                    </router-link>
                </div>
            </swiper>
        </div>
    </div>
</template>
