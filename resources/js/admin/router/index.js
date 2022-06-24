import { render } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import LoginContainer from "../components/container/LoginContainer.vue";
import HomeContainer from "../components/container/HomeContainer.vue";
import store from "../../store/index.js";
const routes = [
    {
        path: "/admin",
        name: "Home",
        component: HomeContainer,
        meta: { requiresLogin: true },
    },
    {
        path: "/admin/login",
        name: "Login",
        component: LoginContainer,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (
        to.matched.some(
            (record) => record.meta.requiresLogin && !store.state.user.token
        )
    ) {
        next("/admin/login");
    } else {
        next();
    }
});

export default router;
