import { render } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import Example from "../components/Example.vue";
import LoginContainer from "../components/container/LoginContainer.vue";
import RegisterContainer from "../components/container/RegisterContainer.vue";
import store from "../store/index.js";
const routes = [
    {
        path: "/",
        name: "Home",
        component: Example,
    },
    {
        path: "/login",
        name: "Login",
        component: LoginContainer,
        beforeEnter: [justVisitor],
    },

    {
        path: "/register",
        name: "Register",
        component: RegisterContainer,
        beforeEnter: [justVisitor],
    },
    /*
    {
        path: "/category",
        name: "Category",
        component: OfficeCategoryListContainer,
        meta: { requiresLogin: true },
    },*/
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
        next("/login");
    } else {
        next();
    }
});

function justVisitor(to, from, next) {
    if (store.state.user.token && store.state.user.token != "unknown") {
        return next("/");
    }
    return next();
}

export default router;
