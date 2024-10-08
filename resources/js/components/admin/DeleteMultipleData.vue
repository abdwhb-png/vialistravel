<template>
    <div>
        <button
            class="btn btn-danger btn-sm mb-0"
            type="button"
            @click="visible = true"
        >
            Mass Delete <bi class="bi-trash"></bi>
        </button>
        <Dialog
            v-model:visible="visible"
            maximizable
            modal
            header="Delete data records"
            :style="{ width: '60rem' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
        >
            <form>
                <div
                    v-for="(values, key) in datas"
                    :key="key"
                    class="form-group"
                >
                    <label for="" class="text-uppercase">{{ key }}</label>
                    <InputGroup>
                        <MultiSelect
                            v-model="usableSelected[key]"
                            variant="filled"
                            :options="values"
                            optionLabel="name"
                            filter
                            :placeholder="'Select ' + key + ' to delete'"
                            :maxSelectedLabels="4"
                            class="w-full md:w-80"
                        />
                        <Button
                            icon="bi bi-trash"
                            severity="danger"
                            :disabled="
                                !(
                                    usableSelected[key] &&
                                    usableSelected[key].length
                                )
                            "
                            :loading="loading"
                            @click="confirmation(key, values[0].delete_route)"
                        />
                    </InputGroup>
                    <ConfirmDialog :group="key"></ConfirmDialog>
                </div>
            </form>
        </Dialog>
        <toast-status :res="result"></toast-status>
    </div>
</template>

<script>
import { useConfirm } from "primevue/useconfirm";
export default {
    props: {
        datas: Object,
        selected: Object,
    },
    setup() {
        const confirm = useConfirm();
        return { confirm };
    },
    data(props) {
        return {
            result: null,
            visible: false,
            usableSelected: props.selected,
            loading: false,
        };
    },
    methods: {
        async deleteData(key, route) {
            this.loading = true;
            this.result = null;
            var ids = [];
            this.usableSelected[key].map(function (value, key) {
                ids.push(value.code);
            });
            const res = await axios.post(route, {
                ids: ids,
            });
            this.result = res.data;
            if (res.data.ok) {
                window.location.reload("/dashboard");
            } else {
                console.log(res.data);
            }
            this.loading = false;
        },
        confirmation(key, route) {
            this.confirm.require({
                group: key,
                message: "Do you want to delete this " + key + " records ?",
                header: "Please confirm your action",
                icon: "pi pi-info-circle",
                rejectProps: {
                    label: "Cancel",
                    severity: "secondary",
                    outlined: true,
                },
                acceptProps: {
                    label: "Delete",
                    severity: "danger",
                },
                accept: () => {
                    this.deleteData(key, route);
                },
                reject: () => {},
            });
        },
    },
};
</script>
