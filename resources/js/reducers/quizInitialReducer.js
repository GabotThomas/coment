export const SET_STATE = "SET_STATE";
export const SET_VALUE = "SET_VALUE";
export const SET_NUMBER = "SET_NUMBER";
export const GET_STATE = "GET_STATE";

export const setFormAction = (value) => ({ type: SET_STATE, value });
export const setValueAction = (name, value) => ({
    type: SET_VALUE,
    name,
    value,
});
export const setNumberAction = (name, value) => ({
    type: SET_NUMBER,
    name,
    value,
});
export const getQuizAction = () => ({ type: GET_STATE });

// state is automaticaly given by dispatch, only action is settable in dispatch params
const formReducer = (state = {}, action) => {
    switch (action.type) {
        case SET_VALUE:
            return { ...state, [action.name]: action.value } || state;
        case SET_NUMBER:
            return { ...state, [action.name]: Number(action.value) } || state;
        case SET_STATE:
            return action.value || state;
        case GET_STATE:
            return action.value || state;
        default:
            return state;
    }
};
export default formReducer;
