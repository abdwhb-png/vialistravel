import { defineStore, acceptHMRUpdate } from "pinia";
import axios from "axios";

export const useAxiosStore = defineStore("axiosStore", {
    state: () => ({
        loading: false,
        result: null,
        error: null,
        status: null, // Pour stocker le statut HTTP
        random_id: Math.ceil(Math.random() * 1000000),
    }),

    getters: {
        isOk: (state) => {
            return state.status === 200 && state.result.ok;
        },
    },

    actions: {
        // Fonction générique pour gérer les requêtes
        async sendRequest(method, url, data = null, config = {}) {
            this.loading = true;
            this.result = null;
            this.error = null;
            this.status = null;

            try {
                const response = await axios({
                    method: method,
                    url: url,
                    data: data,
                    ...config, // Configuration additionnelle comme headers, params, etc.
                });
                this.result = response.data;
                this.status = response.status; // Enregistre le statut HTTP
                console.log(this.status, this.result);
            } catch (error) {
                this.error = error.response
                    ? error.response.data
                    : error.message;
                this.status = error.response ? error.response.status : null;
                console.log(this.status, this.error);
            } finally {
                this.loading = false;
            }
        },

        // Requête GET avec gestion des paramètres supplémentaires
        async sendGet(url, params = {}, config = {}) {
            await this.sendRequest("get", url, null, { params, ...config });
        },

        // Requête POST avec gestion des données de formulaire
        async sendPost(url, form = {}, config = {}) {
            await this.sendRequest("post", url, form, config);
        },

        // Annuler une requête avec AbortController
        async sendGetWithCancel(url, params = {}, config = {}) {
            const controller = new AbortController();
            config.signal = controller.signal;

            try {
                await this.sendRequest("get", url, null, { params, ...config });
            } catch (error) {
                if (error.name === "AbortError") {
                    console.log("Requête annulée");
                }
            }

            return controller;
        },
    },
});

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useAxiosStore, import.meta.hot));
}
