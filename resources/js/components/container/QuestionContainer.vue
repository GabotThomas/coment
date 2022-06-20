<script setup>
import { watch, ref, onBeforeMount, onUpdated, computed } from "vue";
import useFetch from "../../hooks/useFetch";
import { makeClassName } from "../../functions/index";

const props = defineProps({
    question: Object,
    handleSelect: Function,
    handleNext: Function,
    next: Boolean
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
    <div class="container ui container question">
        <div class="row justify-content-center h-100">
            <div class="col-md-8 h-100">
                <div class="card question">
                    <div>
                        <!--<h1> {{ props.question.text }} </h1>-->
                        <h1 class="mb-2">Le langage utilisé véhicule-t-il des stéréotypes sexistes ?</h1>
                        <p class="question-text mb-2">Sont concernés les textes écrits, signatures, dialogues, voix off, chansons, etc. <br><br>
                            <span>Exemples :</span> « Mademoiselle » ; « Madame le Directeur » ; un produit fait pour « la » femme.
                            <span>Indicateur sémantique</span>
                        </p>
                    </div>
                    <div class="questions-button">
                        <button v-on:click="(e) => handleSelect(1)" :class="makeClassName('btn-answer btn-answer__yes', props.question.result == 1 && 'active')">Vrai</button>
                        <button v-on:click="(e) => handleSelect(0)" :class="makeClassName('btn-answer btn-answer__no mb-2', props.question.result == 0 && 'active')">Faux</button>
                        <div>
                            <button v-on:click="handleNext" :class="makeClassName('btn btn-primary', !next && 'display-none')" :disabled="props.question.result == undefined">Continuer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
