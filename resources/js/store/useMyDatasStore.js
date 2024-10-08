import { defineStore, acceptHMRUpdate } from "pinia";

export const useMyDatasStore = defineStore("myDatasStore", {
    state: () => ({}),

    getters: {},

    actions: {
        formateDates: (list) => {
            var result = [...(list || [])].map((d) => {
                d.created_at = d.created_at
                    .replace(".000000Z", "")
                    .replace("T", " ");

                d.updated_at = d.updated_at
                    .replace(".000000Z", "")
                    .replace("T", " ");

                return d;
            });
            return result;
        },

        getSeverity(status) {
            switch (status) {
                case "trashed":
                    return "danger";

                case "rejected":
                    return "danger";

                case "deleted":
                    return "danger";

                case "unverified":
                    return "danger";

                case "completed":
                    return "success";

                case "approved":
                    return "success";

                case "pending":
                    return "warn";

                case "active":
                    return "info";

                default:
                    return null;
            }
        },
    },
});

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useMyDatasStore, import.meta.hot));
}
