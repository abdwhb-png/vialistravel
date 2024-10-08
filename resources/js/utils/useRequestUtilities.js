import { ref } from "vue";
import axios from "axios";

export function useRequestUtilities() {
    const state = ref({
        loading: false,
        result: null,
        error: null,
        status: null,
    });

    const isOk = () => {
        return state.value.status === 200 && state.value.result.ok;
    };

    const send = async (method, url, data = null, config = {}) => {
        state.value.loading = true;
        try {
            const response = await axios({
                method: method,
                url: url,
                data: data,
                ...config, // Configuration additionnelle comme headers, params, etc.
            });
            if (typeof response.data === "object" && response.data !== null)
                state.value.result = response.data;
            else
                state.value.result = {
                    ok: false,
                    msg: "Something went wrong ! Get string instead of object as result",
                };
            state.value.status = response.status;
        } catch (error) {
            state.value.error = error.response
                ? error.response.data
                : error.message;
            state.value.status = error.response ? error.response.status : null;
            console.log(state.value.status, state.value.error);
        } finally {
            state.value.loading = false;
        }
    };

    return {
        state,
        send,
        isOk,
    };
}
