import { ref, readonly } from "vue";

const useState = (initValue) => {
    const state = ref(initValue);
    const setState = (newValue) => {
        state.value = newValue;
    }

    const getState = () => {
        return state.value;
    }


    return [getState, setState];
}

export default useState;
