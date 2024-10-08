<template>
    <form>
        <div class="form-group">
            <slot name="head">
                <label for="">Pick List</label>
                <p>You can pick element from left to right or the inverse.</p>
            </slot>
            <PickList v-model="usableDatas" dataKey="id" breakpoint="1400px">
                <template #option="{ option }">
                    {{ option.title }}
                </template>
            </PickList>
        </div>
        <div class="form-group text-center">
            <Button
                type="button"
                :label="btnLabel"
                :loading="loading"
                unstyled
                class="btn bg-gradient-dark w-md-50 w-100"
                @click="submit"
            />
        </div>
        <toast-status :res="result"></toast-status>
    </form>
</template>
<script>
export default {
    props: {
        btnLabel: {
            type: String,
            default: "SAVE CHANGES",
        },
        itemId: Number | String,
        route: String,
        all: Object,
        selected: Object,
        reload: {
            type: Boolean,
            default: false,
        },
    },
    data(props) {
        return {
            loading: false,
            result: null,
            usableDatas: null,
        };
    },
    created() {
        this.getDatas();
    },
    methods: {
        getDatas() {
            this.usableDatas = [this.all, this.selected];
        },
        async submit() {
            this.loading = true;
            this.result = null;

            const res = await axios.post(this.route, {
                id: this.itemId,
                unselected: this.usableDatas[0],
                selected: this.usableDatas[1],
            });
            this.result = res.data;
            if (!res.data.ok) {
                console.log(res.data);
                this.getDatas();
            } else if (this.reload && res.data.ok) {
                window.location.reload();
            }
            this.loading = false;
        },
    },
};
</script>
