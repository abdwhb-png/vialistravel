<template>
    <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <h5 class="mb-0">Basic Informations</h5>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-6">
                    <my-multi-select
                        label="Region's countries"
                        :item-id="theItem.id"
                        :route="routes.save_countries"
                        :all="countries.all"
                        :selected="countries.selected"
                        :reload="true"
                    ></my-multi-select>
                    <my-multi-select
                        label="Trips in this region"
                        :item-id="theItem.id"
                        :route="routes.save_trips"
                        :all="trips.all"
                        :selected="trips.selected"
                        :reload="true"
                    ></my-multi-select>
                    <hr class="horizontal dark my-sm-2" />
                    <fieldset>
                        <div class="form-group">
                            <label for="">Slug</label>
                            <input
                                type="text"
                                disabled
                                class="form-control form-control-sm"
                                id=""
                                placeholder=""
                                v-model="theItem.permalink"
                            />
                        </div>
                        <div class="form-group">
                            <label for="" class="required"
                                >Region title/name</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id=""
                                placeholder=""
                                v-model="form.title"
                            />
                        </div>

                        <div class="form-group">
                            <label for="" class="required">Introduction</label>
                            <textarea
                                v-model="form.intro"
                                id=""
                                rows="3"
                                class="form-control"
                            ></textarea>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="">Description</label>
                            <Editor
                                v-model="form.description"
                                editorStyle="height: 370px"
                            />
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="form-group text-center">
                    <Button
                        type="button"
                        label="SAVE BASIC INFORMATIONS"
                        :loading="loading"
                        unstyled
                        class="btn bg-gradient-dark w-md-50 w-100"
                        @click="submit"
                    />
                </div>
            </div>
        </div>
        <toast-status :res="result"></toast-status>
    </div>
</template>
<script>
export default {
    props: {
        theItem: Object,
        routes: Object,
        trips: Object,
        countries: Object,
    },
    data(props) {
        return {
            result: null,
            loading: false,
            form: props.theItem,
        };
    },
    methods: {
        async submit() {
            this.loading = true;
            this.result = null;
            const res = await axios.post(this.routes.save_basics, this.form);
            this.result = res.data;
            if (!res.data.ok) {
                console.log(res.data);
            }
            this.loading = false;
        },
    },
};
</script>
