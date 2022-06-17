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
    <h1 class="mb-1_25">Se connecter</h1>
    <form class="ui form">
      <div class="mb-0_5">
        <span class="ui label">Adresse e-mail</span>
        <input class="ui input" id="username" name="email" type="text" placeholder="Entrez votre adresse e-mail" @input="handleChange"
          :value="user.value.email || ''" />
      </div>
      <div class="password-login mb-1_5">
        <span class="ui label">Mot de passe</span>
        <input class="ui input" id="password" type="password" name="password" placeholder="Entrez votre mot de passe"
          @input="handleChange" :value="user.value.password || ''" />
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
        <!-- <div class="">
            <input class="ui input" id="password" type="password" name="password" placeholder="******************"
            @input="handleChange" :value="user.value.password || ''" />
            <p class="">Please choose a password.</p>
        </div> -->
        <div class="login-text mb-1">
            <span>En te connectant à [Nom de l’appli], tu acceptes nos <b>Conditions d’utilisation</b> et notre <b>Politique de confidentialité.</b></span>
        </div>
      <input type="hidden" name="_token" :value="csrf">

      <div class="fw-900 text-register">
        <span>Tu n’as pas encore de  compte ? <router-link class="yellow" :to="{ name: 'Register' }">&nbsp; Fais le test</router-link></span>
      </div>
    </form>
    <div class="bg">
        <img src="../../../img/flowers/flower_1.svg" alt="" srcset="" class="flower flower-1">
        <img src="../../../img/flowers/flower_2.svg" alt="" srcset="" class="flower flower-2">
        <img src="../../../img/flowers/flower_2.svg" alt="" srcset="" class="flower flower-3">
        <img src="../../../img/flowers/flower_4.svg" alt="" srcset="" class="flower flower-4">
        <img src="../../../img/flowers/flower_5.svg" alt="" srcset="" class="flower flower-5">
    </div>
  </div>
</template>
