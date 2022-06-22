<script setup>
import { watch, ref, onBeforeMount } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import useFetch from "../../hooks/useFetch";
import useReducer from "../../hooks/useReducer";
import formReducer, { setValueAction } from "../../reducers/formReducer";
import useActions from "../../hooks/useActions";
import { POST } from "../../constants/methods";
import PasswordField from "../container/PasswordField.vue";
import InputPassword from "../form/module/InputPassword.vue";

const store = useStore();
const router = useRouter();
const [resultLogin, loadLogin, loadingLogin] = useFetch();
const [user, dispatchState] = useReducer(formReducer, {
  email: "test@yahoo.fr",
  password: "Thomas77220;",
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

const password = (e, { name, value }) => {
  setValue(name, value);
};

watch(resultLogin, (currentValue, oldValue) => {
  if (currentValue && currentValue.success) {
    localStorage.setItem("token", JSON.stringify(currentValue.access_token));
    store.commit("setToken", currentValue.access_token);
    store.commit("setUser", currentValue.user)
    router.push({ name: "Dashboard" });
  }
});
</script>
<template>
  <div class="
      ui container login
    ">
    <h1 class="login-title">Se connecter</h1>
    <form class="ui form">
      <div class="form-mail">
        <p class="ui label">Adresse e-mail</p>
        <input class="ui input" id="username" name="email" type="text" placeholder="Entrez votre adresse e-mail"
          @input="handleChange" :value="user.value.email || ''" />
      </div>
      <div class="password-login">
        <p class="ui label">Mot de passe</p>
        <InputPassword :handle-change="password" :value="user.value.password || ''" placeholder="Entrez votre mot de passe" name="password"></InputPassword>
        <a href="" class="forgot-password">Mot de passe oublié ?</a>
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
      <div class="login-text mb-1">
        <p>En te connectant à [Nom de l’appli], tu acceptes nos <b>Conditions d’utilisation</b> et notre <b>Politique
            de confidentialité.</b></p>
      </div>
      <input type="hidden" name="_token" :value="csrf">

      <div class="fw-900 text-register">
        <p>Tu n’as pas encore de compte ? <router-link class="yellow" :to="{ name: 'Register' }">&nbsp; Fais le test
          </router-link></p>
      </div>
    </form>
    <div class="bg">
        <img src="../../../img/home/bg-home_2.png" alt="" srcset="" class="bg-top">
        <img src="../../../img/home/bg-smiley.png" alt="" srcset="" class="bg-bottom">
    </div>
  </div>
</template>
