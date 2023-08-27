<script setup>
import { watch } from "vue";
import { POST } from "../../constants/methods";
import useFetch from "../../hooks/useFetch";
import useLocalStorage from "../../hooks/useLocalStorage";
import useReducer from "../../hooks/useReducer";
import useActions from "../../hooks/useActions";
import { setValueAction } from "../../reducers/formReducer";
import formReducer from "../../reducers/formReducer";
import { useRouter } from "vue-router";
import 'vue3-lottie/dist/style.css'
import InputPassword from "../form/module/InputPassword.vue";
import InviteButton from "../util/InviteButton.vue";

const [resultRegister, loadRegister, loadingRegister] = useFetch();
const { getStoredItem, setItemToStorage } = useLocalStorage();
const [user, dispatchState] = useReducer(formReducer, {
  email: "",
  name: "",
  lastname: '',
  password: '',
  confirm_password: ''
});
const [setValue] = useActions(dispatchState, [setValueAction]);
const router = useRouter();

const handleSubmit = () => {
  const quiz = getStoredItem('quiz');
  let body = user.value;
  if (quiz.status == 'finished') {
    body = { ...body, quiz: 'finished' }
  }
  loadRegister({
    url: "register",
    method: POST,
    body: body,
  });
};

const handleChange = ({ target }) => {
  setValue(target.name, target.value);
};

const password = (e, { name, value }) => {
  setValue(name, value);
};

watch(resultRegister, (currentValue, oldValue) => {
  if (currentValue && currentValue.success) {
    router.push({ name: "Login" });
  }
});
</script>

<template>
  <div class="ui container register">
    <div class="container">
      <!-- <Vue3Lottie :animationData="Electric" :height="200" :width="200" /> -->
      <div class="">
        <h1 class="text-center mb-1_5">Création du profil</h1>
        <form class="ui form">
          <span class="ui label">Pénom</span>
          <input type="text" class="mb-1 ui input" name="name" placeholder="Entrez votre prénom" @input="handleChange"
            :value="user.value.name || ''" />

          <span class="ui label">Nom</span>
          <input type="text" class="mb-1 ui input" name="lastname" placeholder="Entrez votre nom" @input="handleChange"
            :value="user.value.lastname || ''" />

          <span class="ui label">Adresse e-mail</span>
          <input type="text" class="ui input mb-1" name="email" placeholder="Entrez votre adresse e-mail"
            @input="handleChange" :value="user.value.email || ''" />

          <div class="password-register mb-1">
            <span class="ui label">Mot de passe</span>
            <InputPassword :handle-change="password" :value="user.value.password || ''"
              placeholder="Entrez votre mot de passe" name="password"></InputPassword>
          </div>
          <div class="password-register mb-1_5">
            <span class="ui label">Confirmation du mot de passe</span>
            <InputPassword :handle-change="password" :value="user.value.confirm_password || ''"
              placeholder="Confirmer votre mot de passe" name="confirm_password"></InputPassword>
          </div>

          <button type="submit" class="btn btn-primary mb-1_5" v-on:click.prevent="handleSubmit">
            CRÉER MON COMPTE
          </button>
          <InviteButton />
          <span class="switch-login mb-1_5">ou</span>
          <div class="register-text mb-1">
            <p>En te connectant à [Nom de l’appli], tu acceptes nos <b>Conditions d’utilisation</b> et notre
              <b>Politique de confidentialité.</b>
            </p>
          </div>
          <input type="hidden" name="_token" :value="csrf">

          <div class="fw-900 text-register">
            <p>Tu as déjà un compte ? <router-link class="yellow" :to="{ name: 'Login' }">&nbsp; SE CONNECTER
              </router-link>
            </p>
          </div>
        </form>
        <div class="bg">
          <!-- <img src="../../../img/confettis/confettis.svg" alt="" srcset="" class="confettis confettis-1"> -->
        </div>
      </div>
    </div>
  </div>
</template>
