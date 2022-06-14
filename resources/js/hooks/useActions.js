
// prettier-ignore
const useActions = (dispatch, actions) =>
    actions.map(action => (...args) => dispatch(action(...args)))

export default useActions;
