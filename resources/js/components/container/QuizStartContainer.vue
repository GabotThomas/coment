<script setup>
import { watch, ref, onBeforeMount } from "vue";
import { RouterLink } from "vue-router";
import useFetch from "../../hooks/useFetch";

const props = defineProps({
    question: Object
})

const [resultQuestions, loadQuestions, loadingQuestions] = useFetch();

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

</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ui container home">
                    <h1>Nom de l'app</h1>
                    <img src="../../../img/daniel-monteiro-COgbRUTvL-s-unsplash.jpg" alt="" srcset="">
                    <div class="button-start">
                        <router-link :to="{ name: 'QuizInitial' }" class="btn btn-primary mb-0_5">C'est parti !</router-link>
                        <router-link :to="{ name: 'Login' }" class="btn btn-secondary">J'ai déjà un compte</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
