<script setup>
    import { watch, ref, onBeforeMount } from "vue";
    import useFetch from "../../hooks/useFetch";

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

onBeforeMount(() => {
    handleLoad();
})
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <ul>
                        <li v-for="question in questions" :key="question.id">{{ question.text }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
