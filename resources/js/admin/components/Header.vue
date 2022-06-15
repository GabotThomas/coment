<script setup>
import { useRouter } from "vue-router";
import { RouterLink, RouterView } from "vue-router";
import { onBeforeMount, ref, watch } from "vue";
import CartContainer from "./container/CartContainer.vue";
import DropdownContainer from "./container/DropdownContainer.vue";
import { useStore } from "vuex";

const router = useRouter();
const props = defineProps({
  isConnected: {
    type: [String],
    required: false,
    default: null,
  },
});

const store = useStore();

const handleLogOut = () => {
  localStorage.setItem("token", null);
  store.commit("setToken", null);
  router.push({ name: "Login" });
};
</script>

<template>
  <nav class="bg-white px-8 py-2.5 shadow-md w-full fixed z-10">
    <div class="">
      <div class="-mb-px flex items-center justify-center">
        <button
          class="no-underline text-teal-dark border-b-2 border-teal-dark uppercase tracking-wide font-bold text-xs py-3 mr-8">
          <router-link :to="{ name: 'Home' }">Home</router-link>
        </button>
        <template v-if="!props.isConnected">
          <button
            class="no-underline text-teal-dark border-b-2 border-teal-dark uppercase tracking-wide font-bold text-xs py-3 mr-8">
            <router-link :to="{ name: 'Login' }">Login</router-link>
          </button>
          <button
            class="no-underline text-teal-dark border-b-2 border-teal-dark uppercase tracking-wide font-bold text-xs py-3 mr-8">
            <router-link :to="{ name: 'Register' }">Register</router-link>
          </button>
        </template>
        <template v-else>
          <CartContainer />
        </template>
      </div>
      <DropdownContainer v-if="props.isConnected" />
    </div>
  </nav>
</template>
