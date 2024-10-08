<template>
    <div>
        <div class="form-group">
            <label for="">{{ label }}</label>
            <InputGroup>
                <MultiSelect
                    v-model="usableSelected"
                    variant="filled"
                    :options="all"
                    optionLabel="name"
                    filter
                    :placeholder="'Select ' + label"
                    :maxSelectedLabels="3"
                    class="w-full md:w-80"
                />
                <Button
                    icon="bi bi-floppy"
                    severity="contrast"
                    :disabled="disabled()"
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
import { ref } from "vue";
import isEqual from "lodash/isEqual";

export default {
    props: {
        label: String,
        itemId: Number | String,
        route: String,
        all: Object,
        selected: Object,
        reload: {
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
            usableSelected: props.selected.length ? props.selected : null,
        };
    },

    methods: {
        disabled() {
            return isEqual(this.usableSelected, this.selected);
        },

        async submit() {
            //     if (isEqual(this.usableSelected, this.selected)) {
            //         console.log("The values are the same. No action to perform.");
            //         return;
            //     }

            await this.myRequest.send("POST", this.route, {
                id: this.itemId,
                datas: this.usableSelected,
            });
            if (this.reload && this.myRequest.isOk()) {
                window.location.reload();
            }
        },
    },
};
</script>
