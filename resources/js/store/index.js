import Vue from "vue";
import Vuex from "vuex";
import user from "../modules/user.js";
import cart from "../modules/cart.js";
import quizInitial from "../modules/quizInitial.js";

export default new Vuex.Store({
    modules: {
        user,
        cart,
        quizInitial,
    },
});
