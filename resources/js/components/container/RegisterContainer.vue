<script setup>
import { watch } from "vue";
import { POST } from "../../constants/methods";
import useFetch from "../../hooks/useFetch";
import useReducer from "../../hooks/useReducer";
import useActions from "../../hooks/useActions";
import { setValueAction } from "../../reducers/formReducer";
import formReducer from "../../reducers/formReducer";
import { useRouter } from "vue-router";

const [resultRegister, loadRegister, loadingRegister] = useFetch();
const [user, dispatchState] = useReducer(formReducer, {});
const [setValue] = useActions(dispatchState, [setValueAction]);
const router = useRouter();

const handleSubmit = () => {
  loadRegister({
    url: "register",
    method: POST,
    body: user.value,
  });
};

const handleChange = ({ target }) => {
  setValue(target.name, target.value);
};

watch(resultRegister, (currentValue, oldValue) => {
  if (currentValue && currentValue.success) {
    router.push({ name: "Login" });
  }
});
</script>

<template>
  <div class="bg-grey-lighter min-h-screen flex flex-col">
    <div class="
        container
        max-w-sm
        mx-auto
        flex-1 flex flex-col
        items-center
        justify-center
        px-2
      ">
      <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
        <h1 class="mb-8 text-3xl text-center">Sign up</h1>
        <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="name"
          placeholder="Full Name" @input="handleChange" :value="user.value.name || ''" />

        <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="email"
          placeholder="Email" @input="handleChange" :value="user.value.email || ''" />

        <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="password"
          placeholder="Password" @input="handleChange" :value="user.value.password || ''" />
        <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="confirm_password"
          placeholder="Confirm Password" />

        <button type="submit" class="
            w-full
            text-center
            py-3
            rounded
            bg-green-600
            text-white
            hover:bg-green-700
            focus:outline-none
            my-1
          " v-on:click.prevent="handleSubmit">
          Create Account
        </button>

        <div class="text-center text-sm text-grey-dark mt-4">
          By signing up, you agree to the
          <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
            Terms of Service
          </a>
          and
          <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
            Privacy Policy
          </a>
        </div>
      </div>

      <div class="text-grey-dark mt-6">
        Already have an account?
        <router-link class="no-underline border-b border-blue text-blue" :to="{ name: 'Login' }">Login</router-link>.
      </div>
    </div>
  </div>
</template>
