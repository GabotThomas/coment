require("./bootstrap");

import { createApp } from "vue";
import * as VueRouter from "vue-router";
import router from "./router/index.js";
import vuex from "./store/index.js";
import App from "./components/App.vue";

const app = createApp(App);
app.use(router);
app.use(vuex);
app.mount("#app");
