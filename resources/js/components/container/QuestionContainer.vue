<script setup>
import { watch, ref, onBeforeMount, onUpdated, computed } from "vue";
import useFetch from "../../hooks/useFetch";
import { makeClassName } from "../../functions/index";
import { Vue3Lottie } from 'vue3-lottie'
import 'vue3-lottie/dist/style.css'
import LottieJson from "../util/LottieJson.vue";

const props = defineProps({
    question: Object,
    handleSelect: Function,
    handleNext: Function,
    next: Boolean
});
</script>

<template>
    <div class="container ui container question">
        <div class="row justify-content-center h-100">
            <div class="col-md-8 h-100">
                <div class="card question">
                    <div>
                        <h1 class="mb-0">{{ props.question.text }}</h1>
                        <LottieJson :json="props.question.image" />
                        <div v-html="props.question.answer"></div>
                    </div>
                    <div class="questions-button">
                        <div v-on:click="(e) => handleSelect(1)"
                            :class="makeClassName('btn-answer btn-answer__yes cursor', props.question.result == 1 && 'active')">
                            Oui</div>
                        <div v-on:click="(e) => handleSelect(0)"
                            :class="makeClassName('btn-answer btn-answer__no mb-2 cursor', props.question.result == 0 && 'active')">
                            Non</div>
                        <div>
                            <button v-on:click="handleNext"
                                :class="makeClassName('btn btn-primary', !next && 'display-none')"
                                :disabled="props.question.result == undefined">Continuer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
