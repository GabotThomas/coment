<script setup>
import { computed, onBeforeMount, reactive, ref, watch } from "vue";
import Header from "./Header.vue";
import { useStore, mapState } from "vuex";
import Loader from "./util/Loader.vue";
import useFetch from "../hooks/useFetch";
import { useRouter } from "vue-router";

const store = useStore();
const token = ref();
const router = useRouter();
const [resultLogin, loadLogin, loadingLogin] = useFetch();

const handleLoad = () => {
    loadLogin({
        url: "user",
        token: token.value,
        accept: "application/json",
    });
};

onBeforeMount(() => {
    token.value = JSON.parse(localStorage.getItem("token"));
    if (token.value) {
        handleLoad();
    }
});

watch(store.state.user, (currentValue, oldValue) => {
    token.value = currentValue.token;
});

watch(resultLogin, (currentValue, oldValue) => {
    if (currentValue && currentValue.success) {
        store.commit("setToken", token.value);
        store.commit("setUser", currentValue.user)
    } else {
        store.commit("setToken", null);
        router.push({ name: "Login" });
    }
});

</script>

<template>
    <Loader v-if="loadingLogin" />
    <div v-else>
        <Header :is-connected="token" />
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>
