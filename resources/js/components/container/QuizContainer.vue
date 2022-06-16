<script setup>
import { watch, ref, onBeforeMount, computed, onUpdated } from "vue";
import useFetch from "../../hooks/useFetch";
import useLocalStorage from "../../hooks/useLocalStorage";
import QuestionContainer from "./QuestionContainer.vue";
import Loader from "../util/Loader.vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { POST } from "../../constants/methods";
import arrowLeft from "../../../img/icons/arrow.png";

const { getStoredItem, setItemToStorage } = useLocalStorage();
const router = useRouter();
const [resultQuiz, loadQuiz, loadingQuiz] = useFetch();
const [resultQuizSend, loadQuizSend, loadingQuizSend] = useFetch();

const quiz = ref({});
const index = ref(0);

const handleLoad = () => {
    loadQuiz({
        url: "quiz/initial",
    });
};

const handleSend = () => {
    loadQuizSend({
        url: "quiz/initial",
        method: POST,
        body: { quiz: quiz.value }
    });
}

const handleFinish = () => {
    handleSend();
    setItemToStorage({ ...quiz.value, status: 'finished' }, 'quiz')
}

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

watch(resultQuizSend, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        setItemToStorage({
            id: currentValue.result,
            pourcentage: currentValue.pourcentage
        }, 'result')
        router.push({ name: "Results", params: { id: currentValue.result } });
    }
});

onBeforeMount(() => {
    handleLoad();
    const quiz = getStoredItem('quiz');
    // if (quiz.status == 'finished') {
    //     router.push({ name: "Login" });
    // }
})

const question = computed(() => quiz.value.questions[index.value])
const next = computed(() => index.value < quiz.value.totalQuestion - 1)
const prev = computed(() => index.value >= quiz.value.totalQuestion - 1)

const progress = computed(() => (index.value + 1) / quiz.value.totalQuestion * 100)

const allChecked = computed(() => {
    return quiz.value.questions.every(question => question.result != undefined);
})

</script>

<template>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <Loader v-if="loadingQuiz" />
                <div v-else class="card ui container quiz justify-start">
                    <div v-on:click="handlePrev" class="arrow-left mb-2">
                        <img :src="arrowLeft" alt="" srcset="" />
                        <div class="progress-bar">
                            <div class="progress-bar__before" v-bind:style="{ width: progress + '%' }"></div>
                        </div>
                    </div>
                    <QuestionContainer :question="question" :handle-select="handleSelect" :handle-next="handleNext"
                        :next="next" />
                    <div v-if="allChecked">
                        <button v-on:click="handleFinish" class="btn btn-primary">Terminer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
