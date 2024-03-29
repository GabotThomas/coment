<script setup>
import { watch, ref, onBeforeMount, computed, onUpdated } from "vue";
import useFetch from "../../hooks/useFetch";
import useLocalStorage from "../../hooks/useLocalStorage";
import QuestionContainer from "./QuestionContainer.vue";
import Loader from "../util/Loader.vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { POST } from "../../constants/methods";
import arrowLeft from "../../../img/icons/arrow-left-black.svg";


const router = useRouter();
const [resultQuiz, loadQuiz, loadingQuiz] = useFetch();
const [resultQuizSend, loadQuizSend, loadingQuizSend] = useFetch();
const { id } = router.currentRoute.value.params;

const quiz = ref({});
const index = ref(0);

const handleLoad = () => {
    loadQuiz({
        url: `level/${id}`,
    });
};

const handleSend = () => {
    loadQuizSend({
        url: "quiz/save",
        method: POST,
        body: { quiz: quiz.value }
    });
}

const handleFinish = () => {
    handleSend();
}

const handleNext = () => {
    index.value++;
}

const handlePrev = () => {
    index.value--;
}

const handleReturn = () => {
    router.push({ name: "Dashboard" });
}

const handleSelect = (result) => {
    const question = quiz.value.questions[index.value];
    quiz.value.questions[index.value] = { ...question, result }
}

watch(resultQuiz, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        quiz.value = {
            ...currentValue.lastQuiz.quiz,
            totalQuestion: currentValue.lastQuiz.quiz.questions.length
        };
    }
});

watch(resultQuizSend, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        router.push({ name: "Results", params: { id: currentValue.resultUser } });
    }
});

onBeforeMount(() => {
    handleLoad();
})

const question = computed(() => quiz.value.questions[index.value])
const next = computed(() => index.value < quiz.value.totalQuestion - 1)
const prev = computed(() => index.value >= quiz.value.totalQuestion - 1)

const progress = computed(() => (index.value + 1) / quiz.value.totalQuestion * 100)

const avancement = computed(() => {
    return `${index.value + 1}/${quiz.value.totalQuestion}`
})

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
                    <div class="arrow-left mb-2">
                        <img :src="arrowLeft" v-on:click="handleReturn" alt="" srcset="" />
                        <div class="progress-bar">
                            <div class="progress-bar__before" v-bind:style="{ width: progress + '%' }"></div>
                        </div>
                        <p class="progress-number">{{ avancement }}</p>
                    </div>
                    <QuestionContainer :question="question" :handle-select="handleSelect" :handle-next="handleNext"
                        :next="next" />
                    <div v-if="!next">
                        <button v-on:click="handleFinish" class="btn btn-primary" :disabled="!allChecked">Terminer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
