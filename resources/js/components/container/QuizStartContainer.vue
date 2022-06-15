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
                <div class="card">
                    <span>TESTER VOS CONNAISSANCES</span>
                    <router-link :to="{ name: 'QuizInitial' }">Start</router-link>
                </div>
            </div>
        </div>
    </div>
</template>
