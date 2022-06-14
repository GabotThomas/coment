// modules
import { ref, watch, toRef, reactive } from "vue";
import { useStore } from "vuex";
//import { useDispatch, useSelector } from 'react-redux';
// functions
import { buildFormData } from "../functions";
// constants
import { GET } from "../constants/methods";
import { FILE_TYPE, JSON_TYPE } from "../constants/requestType";
//import useRefreshToken from './useRefreshToken';

/**
 * @returns [
 *  result: object, // ajax response
 *  load: function, // launch ajax request
 * 	loading: boolean
 * ]
 */
const useFetch = () => {
    const store = useStore();
    const result = ref(null);
    const state = reactive({ loading: false });
    const user = store.state.user;
    //const [controller] = ref(new AbortController());

    watch(result, (currentValue, oldValue) => {
        if (currentValue) {
            state.loading = false;
        }
    });

    /**
     * @param {{
     *  url: string,
     *  method: string|undefined,
     *  body: object|undefined,
     *  token: string|undefined,
     *  contentType: string|undefined
     * }}
     */

    const load = async ({
        url = "",
        method = GET,
        body,
        contentType = JSON_TYPE,
        accept = "*/*",
        token = user.token
    }) => {
        const params = { method, headers: { Accept: accept } };

        state.loading = true;
        if (token) {
            params.headers.Authorization = `Bearer ${token}`;
        }

        if (body) {
            // console.log('body', body);
            if (contentType === JSON_TYPE) {
                body = JSON.stringify(body);
                params.headers["Content-Type"] = contentType;
            } else if (contentType === FILE_TYPE) {
                body = buildFormData(body);
            }
            params.body = body;
        }

        // Catch if token is invalid/expired.
        // Then try to get a new one with refreshToken : success ? reload : logout
        try {
            const response = await manageFetch(url, params);
            result.value = response;
        } catch (e) {
            console.log(e);
        }
    };

    return [result, load, toRef(state, "loading")];
};

export const manageFetch = async (url, params) => {
    // If fetch, repsonse status or .json() is an error throw error to manageError
    let response = null;
    try {
        response = await fetch(`/api/${url}`, params);
        // console.log('response', response);
        if (response.ok && response.status >= 200 && response.status < 300) {
            if (response.headers.get("Content-Type") === JSON_TYPE) {
                const responseJson = await response.json();
                // console.log('responseJson', responseJson);
                responseJson.success = true;
                responseJson.code = response.code;
                return responseJson;
            }
            if (response.headers.get("Content-Type").includes("text/html")) {
                const error = new Error("Erreur : ressource introuvable.");
                error.code = 404;
                throw error;
            }
            const responseBlob = await response.blob();
            responseBlob.success = true;
            responseBlob.code = response.code;
            return responseBlob;
        }
        throw await response.json();
    } catch (e) {
        // Set as result
        if (response && response.code && typeof e === "object" && !e.code) {
            e.code = response.code;
        }
        return manageError(e);
    }
};

export const manageError = (error) => {
    if (!error) error = {};
    error.success = false;
    console.log(error.message);
    if (
        error.message === "Unauthenticated" ||
        error.message === "Expired JWT Token" ||
        error.message === "Une exception d'authentification s'est produite."
    ) {
        // Throw error to refreshToken
        throw error;
    }

    if (error.message === "The user aborted a request.") {
        return;
    }

    console.error(error.code, error.message || error);

    if (error.message === "Failed to fetch") {
        error.message =
            "Erreur de communication avec le serveur. Veuillez vérifier votre connexion internet.";
    }
    if (
        error.title === "An error occurred" ||
        error.message === "Unexpected end of JSON input" ||
        error.message === "Unexpected token < in JSON at position 0"
    ) {
        error.message = "Erreur de communication avec le serveur.";
    }
    // Set as result
    return error;
};

export default useFetch;
