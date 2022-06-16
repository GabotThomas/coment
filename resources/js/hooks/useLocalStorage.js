const useLocalStorage = () => {
    const getStoredItem = (key) => {
        try {
            return JSON.parse(localStorage.getItem(key));
        } catch (error) {
            console.error(error);
            return null;
        }
    };

    const setItemToStorage = (value, key) => {
        try {
            localStorage.setItem(key, JSON.stringify(value));
        } catch (error) {
            console.error(error);
        }
    };

    return { getStoredItem, setItemToStorage };
};

export default useLocalStorage;
