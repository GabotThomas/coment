<script setup>
import { watch, ref, onBeforeMount, onUpdated, computed } from "vue";
import useFetch from "../../hooks/useFetch";
import { makeClassName } from "../../functions/index";
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'

const props = defineProps({
    question: Object,
    handleSelect: Function,
    handleNext: Function,
    next: Boolean
})


</script>

<template>
    <div class="container ui container question">
        <div class="row justify-content-center h-100">
            <div class="col-md-8 h-100">
                <div class="card question">
                    <div>
                        <h1 class="mb-0">{{ props.question.text }}</h1>
                        <Vue3Lottie :animationLink="props.question.image" :height="160" :width="200"/>
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
