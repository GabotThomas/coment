const cart = {
    state: { load: false },
    mutations: {
        setCart(state, value) {
            state.load = value;
        },
    },
    getters: {
        getCart: (state) => {
            return state.load;
        },
    },
};

export default cart;
