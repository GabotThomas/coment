<script setup>
import { watch, ref, onBeforeMount, computed, onUpdated } from "vue";
import useFetch from "../../hooks/useFetch";
import QuestionContainer from "./QuestionContainer.vue";
import Loader from "../util/Loader.vue";

const [resultQuiz, loadQuiz, loadingQuiz] = useFetch();

const quiz = ref({});
const index = ref(0);

const handleLoad = () => {
    loadQuiz({
        url: "quiz/initial",
    });
};

const handleNext = () => {
    index.value++;
}

const handlePrev = () => {
    index.value--;
}

const handleSelect = (result) => {
    const question = quiz.value.questions[index.value];
    quiz.value.questions[index.value] = { ...question, result }
}

watch(resultQuiz, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        quiz.value = currentValue.quiz;
    }
});

onBeforeMount(() => {
    handleLoad();
})

const question = computed(() => quiz.value.questions[index.value])
const next = computed(() => index.value < quiz.value.totalQuestion - 1)
const prev = computed(() => index.value >= quiz.value.totalQuestion - 1)

const allChecked = computed(() => {
    console.log(quiz.value.questions)
    return quiz.value.questions.every(question => question.result != undefined);
})

</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <Loader v-if="loadingQuiz" />
                <div v-else class="card">
                    <button v-if="prev" v-on:click="handlePrev">{{ '<-' }}</button>
                            <button v-if="next" v-on:click="handleNext">-></button>
                            <QuestionContainer :question="question" :handle-select="handleSelect" />
                            <div v-if="allChecked">
                                <button>finish</button>
                            </div>
                </div>
            </div>
        </div>
    </div>
</template>
