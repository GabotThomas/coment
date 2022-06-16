<script setup>
import { watch, ref, onBeforeMount, onUpdated } from "vue";
import useFetch from "../../hooks/useFetch";

const props = defineProps({
    question: Object,
    handleSelect: Function
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

onUpdated(() => {
    console.log(props.question)
})

</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{ props.question.text }}
                    <button v-on:click="(e) => handleSelect(1)">Vrai</button>
                    <button v-on:click="(e) => handleSelect(0)">Faux</button>
                    <div v-if="props.question.result != undefined">
                        <button>Envoyer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
