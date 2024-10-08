<template>
    <div>
        <h5>{{ title }}</h5>
        <ProgressBar
            mode="indeterminate"
            v-if="loading"
            style="height: 6px"
        ></ProgressBar>
        <FileUpload
            name="demo[]"
            :multiple="multiple"
            :accept="accept"
            :maxFileSize="maxFileSize"
            :fileLimit="7"
            customUpload
            @uploader="uploader"
        >
            <template #empty>
                <span>Drag and drop files here to upload.</span>
            </template>
        </FileUpload>

        <div
            v-if="result"
            class="alert alert-dismissible fade show mt-2"
            :class="result.ok ? 'alert-success' : 'alert-danger'"
            role="alert"
        >
            <div>
                <span class="alert-text text-white">{{ result.msg }}</span>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <ul class="mb-0">
                <li
                    class="text-white"
                    v-for="(item, i) in result.list"
                    :key="i"
                >
                    {{ item }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
export default {
    props: {
        accept: {
            type: String,
            default: "image/png, image/jpeg, image/jpg, image/heic",
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        route: {
            type: String,
        },
        formData: {
            type: Object,
        },
        title: {
            type: String,
            default: "Upload the file",
        },
    },
    setup() {
        const maxFileSize = 10000000;
        return { maxFileSize };
    },
    data() {
        return {
            loading: false,
            result: null,
        };
    },
    methods: {
        async uploader(e) {
            this.result = null;
            this.loading = true;
            var files = e.files;
            var config = {
                headers: { "content-type": "multipart/form-data" },
            };
            const res = await axios.post(
                this.route,
                {
                    data: this.formData,
                    files: files,
                },
                config
            );
            this.result = res.data;
            if (res.data.ok) {
                window.location.reload();
            } else {
                console.log(res.data);
            }
            this.loading = false;
        },
    },
};
</script>
