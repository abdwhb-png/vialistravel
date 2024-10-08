<template>
    <div>
        <button
            type="button"
            @click="visible = true"
            class="btn btn-outline-primary btn-sm mb-0"
        >
            Edit page
        </button>
        <Dialog
            v-model:visible="visible"
            maximizable
            modal
            header="Editing site page"
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
                    <select
                        class="form-control text-uppercase"
                        v-model="form.menu_section"
                    >
                        <option
                            class="text-uppercase"
                            v-for="(item, i) in menuSections"
                            :key="i"
                        >
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
                        label="SAVE CHANGES"
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
        item: { type: Object },
        menuSections: { type: Object },
        route: { type: String },
    },
    setup() {},
    data(props) {
        return {
            visible: false,
            loading: false,
            form: props.item,
            result: null,
        };
    },
    methods: {
        async submit() {
            this.result = null;
            this.loading = true;
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
