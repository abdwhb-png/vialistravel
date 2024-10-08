<template>
    <div class="card">
        <DataTable
            v-model:filters="filters"
            :value="list"
            paginator
            :rows="10"
            :size="size"
            :rowsPerPageOptions="[5, 10, 20, 50]"
            dataKey="id"
            :loading="loading"
            scrollable
            scrollHeight="400px"
        >
            <template #header>
                <div class="d-flex justify-content-between">
                    <span
                        class="align-self-center text-primary fw-bold"
                        :class="size"
                    >
                        {{ list.length }} total {{ resultName }}
                    </span>
                    <div class="d-flex gap-2">
                        <IconField :size="size">
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText
                                v-model="filters['global'].value"
                                placeholder="Type to search"
                                :size="size"
                            />
                        </IconField>
                    </div>
                </div>
            </template>

            <template #empty>
                <no-results></no-results>
            </template>
            <template #loading> Loading data. Please wait. </template>

            <Column
                v-for="col of columns"
                :key="col.field"
                :field="col.field"
                :header="col.header"
                :sortable="['name'].includes(col.field)"
            >
                <template v-if="col.field == 'title'" #body="{ data, field }">
                    <a :href="data['show_url']" class="link-primary text-u">
                        {{ data[field] }}
                    </a>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import { FilterMatchMode } from "@primevue/core/api";

export default {
    props: {
        datas: { type: Object, default: null },
        resultName: { type: String, default: "results" },
    },
    data(props) {
        return {
            filters: {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            },
            list: [],
            columns: [],
            loading: true,
            size: "small",
        };
    },
    mounted() {
        this.getDatas();
    },
    methods: {
        getDatas() {
            this.list = [...(this.datas.list || [])].map((d) => {
                d.created_at = d.created_at
                    .replace(".000000Z", "")
                    .replace("T", " ");

                d.updated_at = d.updated_at
                    .replace(".000000Z", "")
                    .replace("T", " ");

                return d;
            });
            this.columns =
                this.datas.cols ??
                this.datas.cols.filter((col) => col.field != "id");
            this.loading = false;
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
};
</script>
