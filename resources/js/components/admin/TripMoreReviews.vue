<template>
    <div class="row g-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h5 class="mb-0">More details & Reviews</h5>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-5">
                        <fieldset>
                            <p class="card-title">
                                More infos/details about trip
                            </p>
                            <div class="form-group">
                                <label for="">
                                    Here you can give more information about the
                                    trip such as why to do it with your
                                    company</label
                                >
                                <Editor
                                    v-model="form.more_infos"
                                    editorStyle="height: 400px"
                                />
                            </div>
                            <div class="form-group text-center">
                                <Button
                                    type="button"
                                    label="SAVE MORE INFOS"
                                    :loading="loading"
                                    unstyled
                                    class="btn bg-gradient-dark w-md-50 w-100"
                                    @click="submit"
                                />
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-7">
                        <p class="card-title">Reviews</p>
                        <reviews-list
                            :datas="reviews"
                            :delete-route="routes.delete_review"
                        ></reviews-list>
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
        reviews: { type: Object },
        moreInfos: { type: String },
        routes: { type: Object },
    },
    data(props) {
        return {
            result: null,
            loading: false,
            form: {
                id: props.theItem.id,
                more_infos: props.moreInfos,
            },
        };
    },
    methods: {
        async submit() {
            this.loading = true;
            this.result = null;
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
