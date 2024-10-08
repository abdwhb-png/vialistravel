<template>
    <div class="row g-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h5 class="mb-0">Overview & Itineray</h5>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-4">
                        <fieldset>
                            <p class="card-title">Trip Overview</p>

                            <div class="form-group">
                                <label for="" class="required"
                                    >Provide the trip description</label
                                >
                                <Editor
                                    v-model="form.description"
                                    editorStyle="height: 320px"
                                />
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-8">
                        <fieldset>
                            <p class="card-title">Trip Itineray</p>
                            <div class="form-group">
                                <label for="">
                                    Describe the trip itineary</label
                                >
                                <Editor
                                    v-model="form.itinerary"
                                    editorStyle="height: 350px"
                                />
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group text-center">
                        <Button
                            type="button"
                            label="SAVE OVERVIEW"
                            :loading="loading"
                            unstyled
                            class="btn bg-gradient-dark w-md-50 w-100"
                            @click="submit"
                        />
                    </div>
                </div>
            </div>
        </div>

        <toast-status :res="result"></toast-status>
    </div>
</template>
<script>
export default {
    props: {
        theItem: { type: Object },
        overview: { type: Object },
        routes: { type: Object },
    },
    data(props) {
        return {
            result: null,
            loading: false,
            form: props.overview,
        };
    },
    methods: {
        async submit(type) {
            this.loading = true;
            this.result = null;
            this.form.id = this.theItem.id;
            const res = await axios.post(this.routes.save_overview, this.form);
            this.result = res.data;
            if (!res.data.ok) {
                console.log(res.data);
            }
            this.loading = false;
        },
    },
};
</script>
