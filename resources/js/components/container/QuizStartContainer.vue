<script setup>
import { watch, ref, onBeforeMount } from "vue";
import { RouterLink, useRouter } from "vue-router";
import { useStore } from "vuex";
import useFetch from "../../hooks/useFetch";

const props = defineProps({
    question: Object
})

const [resultQuestions, loadQuestions, loadingQuestions] = useFetch();
const store = useStore();
const router = useRouter();

const questions = ref([]);

const handleLoad = () => {
    loadQuestions({
        url: "quiz/1",
    });
};

watch(resultQuestions, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        questions.value = currentValue.questions;
    }
});

onBeforeMount(() => {
    const user = store.getters.getUser;
    if (user) {
        router.push({ name: "Dashboard" });
    }
})


</script>

<template>
    <div class="container home-bg">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ui container home">
                    <img class="home-bg" src="../../../img/home/bg-home-smiley.png" alt="" srcset="">
                    <h1 class="home-title">Quiz-Ent</h1>
                    <p class="home-texte_title"><b>Lorem Ipsum dolor sit amet, consectetur adipiscing elit.</b></p>
                    <p class="home-texte">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus convallis
                        dolor vel arcu dapibus luctus. Etiam blandit sapien egestas turpis placerat, quis faucibus nibh
                        lacinia. Donec consequat nec lacus eu facilisis.</p>
                    <div class="button-start">
                        <router-link :to="{ name: 'QuizInitial' }" class="btn btn-primary mb-0_5">C'est parti !
                        </router-link>
                        <router-link :to="{ name: 'Login' }" class="btn btn-secondary">J'ai déjà un compte</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
