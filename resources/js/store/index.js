import Vue from "vue";
import Vuex from "vuex";
import user from "../modules/user.js";
import cart from "../modules/cart.js";

export default new Vuex.Store({
    modules: {
        user,
        cart,
    },
});
