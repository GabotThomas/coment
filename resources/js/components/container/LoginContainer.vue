<script setup>
import { watch, ref, onBeforeMount } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import useFetch from "../../hooks/useFetch";
import useReducer from "../../hooks/useReducer";
import formReducer, { setValueAction } from "../../reducers/formReducer";
import useActions from "../../hooks/useActions";
import { POST } from "../../constants/methods";

const store = useStore();
const router = useRouter();
const [resultLogin, loadLogin, loadingLogin] = useFetch();
const [user, dispatchState] = useReducer(formReducer, {
  email: "admin@mail.fr",
  password: "adminadmin",
});
const [setValue] = useActions(dispatchState, [setValueAction]);
const csrf = document.head.querySelector('meta[name="csrf-token"]').content;

const handleSubmit = () => {
  loadLogin({
    url: "login",
    method: POST,
    body: user.value,
  });
};

const handleChange = ({ target }) => {
  setValue(target.name, target.value);
};

watch(resultLogin, (currentValue, oldValue) => {
  if (currentValue && currentValue.success) {
    localStorage.setItem("token", JSON.stringify(currentValue.access_token));
    store.commit("setToken", currentValue.access_token);
    store.commit("setUser", currentValue.user)
    router.push({ name: "Home" });
    console.log(currentValue)
  }
});
</script>
<template>
  <div class="
      ui container login
    ">
    <form class="ui form">
      <div class="">
        <input class="ui input" id="username" name="email" type="text" placeholder="Username" @input="handleChange"
          :value="user.value.email || ''" />
      </div>
      <div class="">
        <input class="ui input" id="password" type="password" name="password" placeholder="******************"
          @input="handleChange" :value="user.value.password || ''" />
        <p class="">Please choose a password.</p>
      </div>
      <div class="">
        <button class="
            " type="button" v-on:click.prevent="handleSubmit">
          Sign In
        </button>
        <a class="" href="#">
          Forgot Password?
        </a>
      </div>
      <input type="hidden" name="_token" :value="csrf">
      <router-link class="" :to="{ name: 'Register' }">Register</router-link>.
    </form>
  </div>
</template>
