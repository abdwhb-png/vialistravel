<template>
    <div>
        <div class="d-flex justify-content-between">
            <p class="card-title">{{ title }}</p>
            <div>
                <button
                    type="button"
                    @click="newItem"
                    class="btn btn-sm btn-primary me-2 px-2"
                >
                    <bi class="bi-plus"></bi> {{ "New " + itemLabel }}
                </button>
                <button
                    type="button"
                    @click="resetHighlight"
                    class="btn btn-sm px-2"
                    v-show="usableDatas.length"
                >
                    <bi class="bi-x"></bi> Clear
                </button>
            </div>
        </div>
        <Panel
            v-for="(item, index) in usableDatas"
            :key="index"
            :header="itemLabel + ' ' + parseInt(index + 1)"
            toggleable
            :collapsed="true"
            class="mb-4"
        >
            <template #icons v-if="item.id">
                <Button
                    type="button"
                    :loading="requestState.loading"
                    label="Delete"
                    unstyled
                    class="btn btn-sm btn-outline-danger p-1 mb-2 me-2"
                    @click="deleteItem(item.id)"
                />
            </template>
            <slot :item="item"></slot>
        </Panel>
        <div class="form-group text-center" v-if="usableDatas.length">
            <Button
                type="button"
                :label="'SAVE ' + itemLabel"
                :loading="requestState.loading"
                unstyled
                class="btn btn-sm bg-gradient-dark w-md-50 w-100 text-uppercase"
                @click="submit('save_highlights')"
            />
        </div>

        <toast-status :res="requestState.result"></toast-status>
    </div>
</template>

<script>
import { useRequestUtilities } from "@/utils/useRequestUtilities";

export default {
    props: {
        theItem: { type: Object },
        datas: { type: Object },
        routes: { type: Object },
        title: { type: String },
        itemLabel: { type: String },
    },

    setup() {
        const myRequest = useRequestUtilities();
        const requestState = myRequest.state.value;

        return { myRequest, requestState };
    },

    data(props) {
        return {
            form: {
                id: props.theItem.id,
            },
            usableDatas: props.datas ?? [],
        };
    },

    methods: {
        newItem() {
            var index = this.usableDatas.length;
            this.usableDatas[index] = {};
        },
        resetHighlight() {
            this.usableDatas = this.usableDatas.filter((d) => {
                return d.id;
            });
        },
        async submit(type) {
            var form = this.form;
            form[this.itemLabel + "s"] = this.usableDatas;
            form.datas = this.usableDatas;
            await this.myRequest.send("POST", this.routes.save, form);
        },
        async deleteItem(id) {
            if (
                confirm("Are sure to delete this " + this.itemLabel + " ?") !=
                true
            )
                return;
            await this.myRequest.send("POST", this.routes.delete + id);
            if (this.myRequest.isOk())
                this.usableDatas = this.usableDatas.filter((d) => {
                    return d.id !== id;
                });
        },
    },
};
</script>
