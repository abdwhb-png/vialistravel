<template>
    <Paginator
        v-model:first="page"
        :rows="rows"
        :totalRecords="chunks.length"
    ></Paginator>
    <div class="row">
        <div class="row">
            <div
                class="card border-1 mb-1"
                v-for="(item, index) in chunks[page]"
                :key="index"
            >
                <div class="card-body pt-2">
                    <a
                        href="javascript:;"
                        class="card-title h5 d-md-flex justify-content-between text-darker"
                    >
                        {{ item.stars + " stars review" }}
                        <Button
                            type="button"
                            :loading="requestState.loading"
                            label="Delete"
                            unstyled
                            class="btn btn-sm btn-outline-danger"
                            @click="deleteItem(item.id)"
                        />
                    </a>
                    <p class="card-description mb-4">
                        {{ item.comment }}
                    </p>
                    <div class="author align-items-center">
                        <bi class="bi-person-circle"></bi>
                        <div class="name ps-3">
                            <span>{{ item.author }}</span>
                            <div class="stats">
                                <small>{{ item.publi_date }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <toast-status :res="requestState.result"></toast-status>
    </div>
</template>
<script>
import { useRequestUtilities } from "@/utils/useRequestUtilities";
import { ref } from "vue";

export default {
    props: {
        datas: Object,
        deleteRoute: String,
        rows: {
            type: Number,
            default: 1,
        },
    },

    setup(props) {
        const chunks = ref([]);
        const chunkedItems = () => {
            let chunkSize = 3;

            for (let i = 0; i < props.datas.length; i += chunkSize) {
                chunks.value.push(props.datas.slice(i, i + chunkSize)); // Diviser le tableau en sous-tableaux de 3 éléments
            }
        };
        chunkedItems();

        const myRequest = useRequestUtilities();
        const requestState = myRequest.state.value;

        return { chunks, myRequest, requestState };
    },

    data() {
        return {
            page: 0,
        };
    },

    methods: {
        async deleteItem(id) {
            await this.myRequest.send("POST", this.deleteRoute + "/" + id);
            if (this.myRequest.isOk()) {
                this.chunks[this.page] = this.chunks[this.page].filter((d) => {
                    return d.id !== id;
                });
            }
        },
    },
};
</script>
