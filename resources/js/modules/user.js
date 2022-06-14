const user = {
    state: { token: "unknown" },
    mutations: {
        setToken(state, value) {
            state.token = value;
        },
        setUser(state, value) {
            state.property = value;
        },
    },
    getters: {
        getToken: (state) => {
            return state.token;
        },
        getUser: (state) => {
            return state.property;
        },
    },
};

export default user;
