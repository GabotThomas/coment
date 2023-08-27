<script setup>
import { watch } from "vue";
import useFetch from "../../hooks/useFetch";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
import { POST } from "../../constants/methods";
import useLocalStorage from "../../hooks/useLocalStorage";

const store = useStore();
const router = useRouter();
const [result, load, loading] = useFetch();
const { getStoredItem } = useLocalStorage();


const handleLoad = () => {
    const quiz = getStoredItem('quiz');
    let body = {};
    if (quiz && quiz.status == 'finished') {
        body = { quiz: 'finished' }
    }

    load({
        url: "login/test",
        body,
        method: POST
    });
};

watch(result, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        localStorage.setItem("token", JSON.stringify(currentValue.access_token));
        store.commit("setToken", currentValue.access_token);
        store.commit("setUser", currentValue.user);
        router.push({ name: "Dashboard" });
    }
});
</script>

<template>
    <button class="
                    btn
                    btn-primary
                    mb-1_5
                    " type="button" v-on:click.prevent="handleLoad">
        Continuer en tant qu'invité
    </button>
</template>