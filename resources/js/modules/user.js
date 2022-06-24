const user = {
    state: { token: JSON.parse(localStorage.getItem("token")), user: null },
    mutations: {
        setToken(state, value) {
            state.token = value;
        },
        setUser(state, value) {
            state.user = value;
        },
        setAll(state, value) {
            state = value;
            localStorage.setItem("token", JSON.stringify(value.token));
        },
        resetToken(state) {
            localStorage.setItem("token", JSON.stringify(null));
            state.token = null;
        },
        resetAll(state) {
            state = {};
            localStorage.setItem("token", JSON.stringify(null));
        },
    },
    getters: {
        getToken: (state) => {
            return state.token;
        },
        getUser: (state) => {
            return state.user;
        },
    },
};

export default user;
