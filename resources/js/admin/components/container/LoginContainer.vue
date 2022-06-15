<script setup>
import { watch, ref, onBeforeMount } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import useFetch from "../../../hooks/useFetch";
import useReducer from "../../../hooks/useReducer";
import formReducer, { setValueAction } from "../../../reducers/formReducer";
import useActions from "../../../hooks/useActions";
import { POST } from "../../../constants/methods";

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
    url: "admin/login",
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
    <h1 class="mb-1_25">Admin</h1>
    <form class="ui form">
      <div class="mb-0_5">
        <input class="ui input" id="username" name="email" type="text" placeholder="Username" @input="handleChange"
          :value="user.value.email || ''" />
      </div>
      <div class="password-login mb-1_5">
        <input class="ui input" id="password" type="password" name="password" placeholder="******************"
          @input="handleChange" :value="user.value.password || ''" />
        <a href="" class="forgot-password">Oublié ?</a>
      </div>
      <div class="">
        <button class="
            btn
            btn-primary
            mb-1_5
            " type="button" v-on:click.prevent="handleSubmit">
          Se connecter
        </button>
      </div>
      <span class="switch-login mb-1_5">ou</span>
      <!-- <div class="">
            <input class="ui input" id="password" type="password" name="password" placeholder="******************"
            @input="handleChange" :value="user.value.password || ''" />
            <p class="">Please choose a password.</p>
        </div> -->
      <div class="login-text mb-1">
        <span>En te connectant à [Nom de l’appli], tu acceptes nos <b>Conditions d’utilisation</b> et notre <b>Politique
            de confidentialité.</b></span>
      </div>
      <input type="hidden" name="_token" :value="csrf">
    </form>
  </div>
</template>
