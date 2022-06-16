<script setup>

import Input from "../form/module/Input.vue";
import useFetch from "../../../hooks/useFetch";
import { ref } from "@vue/reactivity";
import useReducer from "../../../hooks/useReducer";
import { onBeforeMount, watch } from "@vue/runtime-core";
import { useRouter } from "vue-router";
import router from "../../router";
import formReducer, { setFormAction, setValueAction } from "../../../reducers/formReducer";
import useActions from "../../../hooks/useActions";
import { POST } from "../../../constants/methods";


const props = defineProps({
    quiz: {
        type: Object,
        default: {},
    },
});

const [resultSave, loadSave, loadingSave] = useFetch();
const [resultQuiz, loadQuiz, loadingQuiz] = useFetch();
const [quiz, dispatchState] = useReducer(formReducer, props.quiz);
const { id } = router.currentRoute.value.params;
const [setForm, setValue] = useActions(dispatchState, [
    setFormAction,
    setValueAction,
]);

const handleChange = (e, { name, value }) => {
    setValue(name, value);
    console.log(quiz.value)
};

const handleSave = () => {
    if (!quiz.value.id) {
        loadSave({
            url: "admin/quiz",
            method: POST,
            body: quiz.value,
        });
    } else {
        loadSave({
            url: "admin/quiz",
            method: PUT,
            body: quiz.value,
        });
    }
};

watch(resultQuiz, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        quiz.value = currentValue.quiz;
    }
});

watch(props, (currentValue, oldValue) => {
    setForm(currentValue.quiz);
});

onBeforeMount(() => {
    loadQuiz({
        url: `quiz/${id}`,
    });
});
</script>

<template>
    <div>
        <div>
            <h1>Ajouter un Quiz</h1>
            <Input
                :value="quiz.value.name"
                :name="'name'"
                :type="'text'"
                :handle-change="handleChange"
                :placeholder="'name'"
            />
            <div>
                <button
                    v-on:click="handleSave"
                    class="btn btn-primary"
                >
                    Sauvegarder
                </button>
            </div>
        </div>
        <div>
            <h1>Mes quiz</h1>
            <div>
                <p>{{ quiz.value.name }}</p>
            </div>
        </div>
    </div>
</template>
