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
        beforeEnter: [justVisitor],
    },

    {
        path: "/register",
        name: "Register",
        component: RegisterContainer,
        beforeEnter: [justVisitor],
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
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: DashboardContainer,
    },
    {
        path: "/profile/:id",
        name: "Profile",
        component: ProfileContainer,
    },
    {
        path: '/reglage',
        name: "Reglage",
        component: ReglageContainer,
    },
    {
        path: '/404',
        name: "Error",
        component: ErrorContainer,
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
