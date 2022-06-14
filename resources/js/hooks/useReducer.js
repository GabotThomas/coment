import { reactive, readonly, ref, toRefs } from 'vue';

const useReducer = (reducer, initialArg, init) => {
    const state = reactive({ value: init ? init(initialArg) : initialArg });
    const dispatch = (action) => {
        state.value = reducer(state.value, action);
    };

    return [state, dispatch];
};

export default useReducer;
