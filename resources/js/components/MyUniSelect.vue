<template>
    <div>
        <div class="form-group">
            <label for="">{{ label }}</label>
            <InputGroup>
                <Select
                    v-model="selected"
                    :options="datas.all"
                    optionLabel="name"
                    :placeholder="'Select a ' + label"
                    checkmark
                    filter
                    :highlightOnSelect="true"
                />
                <Button
                    icon="bi bi-floppy"
                    severity="contrast"
                    :disabled="
                        !(selected && selected.code != datas.selected.code)
                    "
                    :loading="requestState.loading"
                    @click="submit"
                />
            </InputGroup>
        </div>
        <toast-status
            :res="requestState.result"
            :visible="!myRequest.isOk()"
        ></toast-status>
    </div>
</template>

<script>
import { useRequestUtilities } from "@/utils/useRequestUtilities";

export default {
    props: {
        label: String,
        itemId: Number | String,
        route: String,
        datas: Object,
        reload: {
            type: Boolean,
            default: false,
        },
    },

    setup() {
        const myRequest = useRequestUtilities();
        const requestState = myRequest.state.value;

        return { myRequest, requestState };
    },

    data(props) {
        return {
            selected: props.datas.selected,
        };
    },

    methods: {
        async submit() {
            await this.myRequest.send("POST", this.route, {
                id: this.itemId,
                datas: this.selected,
            });
            if (this.reload && this.myRequest.isOk()) {
                window.location.reload();
            }
        },
    },
};
</script>
