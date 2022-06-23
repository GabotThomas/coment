<script setup>
import { watch, ref, onBeforeMount } from "vue";
import { RouterLink, useRouter } from "vue-router";
import { useStore } from "vuex";
import useFetch from "../../hooks/useFetch";

import confet from "../../../img/confettis/confettis.png";
import Wave from "../../../img/home/wave.png";
import Emojis from "../svg/emojis.vue";

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
        <!--
        <div class="back-confet">
            <div class="background-color"></div>
            <div class="background-confet" :style="{ backgroundImage: `url(${confet})` }"></div>
            <img class="wave" :src="Wave" />
            <Emojis class="children" />
        </div>
        -->
        <div class="card ui container home">
            <h1 class="home-title">Quiz-Ent</h1>
            <p class="home-texte_title"><b>10 questions d’auto-évaluation pour une communication non sexiste</b>
            </p>
            <p class="home-texte">Ce quiz a vocation d’aider les professionnel.le.s de la communication, mais
                également tout.e citoyen.ne, à décrypter un message ou une image de communication pour en
                analyser le caractère sexiste. Sans plus attendre, adoptons les bons réflexes !</p>
            <div class="button-start">
                <router-link :to="{ name: 'QuizInitial' }" class="btn btn-primary mb-0_5">C'est parti !
                </router-link>
                <router-link :to="{ name: 'Login' }" class="btn btn-secondary">J'ai déjà un compte</router-link>
            </div>
        </div>
    </div>
</template>
