<template>
    <div>
        <a href="javascript:;" @click="visible = true">
            <i class="fa fa-plus text-secondary mb-3" aria-hidden="true"></i>
            <h5 class="text-secondary">New page</h5>
        </a>
        <Dialog
            v-model:visible="visible"
            maximizable
            modal
            header="Create a new page"
            :style="{ width: '60rem' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
        >
            <form>
                <div class="form-group">
                    <label for class="font-semibold w-24">Page Name</label>
                    <input
                        type="text"
                        v-model="form.name"
                        class="form-control"
                        id=""
                        placeholder=""
                        value="VIALIS TRAVEL AND TOUR"
                    />
                </div>
                <div class="form-group">
                    <label for>Menu Section</label>
                    <select class="form-control" v-model="form.menu_section">
                        <option v-for="(item, i) in menuSections" :key="i">
                            {{ item }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for>Content</label>
                    <Editor
                        v-model="form.content"
                        editorStyle="height: 350px"
                    />
                </div>
                <div class="form-group text-center">
                    <Button
                        type="button"
                        label="CREATE PAGE"
                        :loading="loading"
                        unstyled
                        class="btn bg-gradient-dark w-md-50 w-100"
                        @click="submit"
                    />
                </div>
            </form>
        </Dialog>
        <toast-status :res="result"></toast-status>
    </div>
</template>

<script>
export default {
    props: {
        menuSections: { type: Object },
        route: { type: String },
    },
    setup() {},
    data() {
        return {
            visible: false,
            loading: false,
            form: {},
            result: null,
        };
    },
    methods: {
        async submit() {
            this.loading = true;
            this.result = null;
            const res = await axios.post(this.route, this.form);
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
