import { render } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import Example from "../components/Example.vue";
import LoginContainer from "../components/container/LoginContainer.vue";
import RegisterContainer from "../components/container/RegisterContainer.vue";
import QuestionContainer from "../components/container/QuestionContainer";
import QuizInitialContainer from "../components/container/QuizInitialContainer";
import QuizContainer from "../components/container/QuizContainer";
import QuizStartContainer from "../components/container/QuizStartContainer";
import ResultsQuizContainer from "../components/container/ResultsQuizContainer";
import ResultsQuizInitialContainer from "../components/container/ResultsQuizInitialContainer";
import DashboardContainer from "../components/container/DashboardContainer";
import ProfileContainer from "../components/container/ProfileContainer";
import ReglageContainer from "../components/container/ReglageContainer";
import ErrorContainer from "../components/container/ErrorContainer";
import store from "../store/index.js";

const routes = [
    {
        path: "/",
        name: "Home",
        component: QuizStartContainer,
    },
    {
        path: "/login",
        name: "Login",
        component: LoginContainer,
    },

    {
        path: "/register",
        name: "Register",
        component: RegisterContainer,
    },
    {
        path: "/quiz/initial",
        name: "QuizInitial",
        component: QuizInitialContainer,
    },
    {
        path: "/quiz/:id",
        name: "Quiz",
        component: QuizContainer,
        meta: { requiresLogin: true },
    },
    {
        path: "/results/initial/:id",
        name: "ResultsInitial",
        component: ResultsQuizInitialContainer,
    },
    {
        path: "/results/:id",
        name: "Results",
        component: ResultsQuizContainer,
        meta: { requiresLogin: true },
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: DashboardContainer,
        meta: { requiresLogin: true },
    },
    {
        path: "/profile/:id",
        name: "Profile",
        component: ProfileContainer,
        meta: { requiresLogin: true },
    },
    {
        path: "/reglage",
        name: "Reglage",
        component: ReglageContainer,
        meta: { requiresLogin: true },
    },
    { path: "/:pathMatch(.*)*", name: "Error", component: ErrorContainer },
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
