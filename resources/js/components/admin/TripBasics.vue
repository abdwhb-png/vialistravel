<template>
    <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <h5 class="mb-0">Basic Informations</h5>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-6">
                    <my-uni-select
                        label="Trip's region"
                        :item-id="theItem.id"
                        :route="routes.save_region"
                        :datas="regions"
                        :reload="true"
                    ></my-uni-select>
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
                                v-model="form.permalink"
                            />
                        </div>
                        <div class="form-group">
                            <label for="" class="required">Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id=""
                                placeholder=""
                                v-model="form.title"
                            />
                        </div>

                        <div class="form-group">
                            <label for="" class="required">
                                Trip duration
                            </label>
                            <p class="indic">ex : 6 or 7 Days / Oct-Nov</p>
                            <input
                                type="text"
                                class="form-control"
                                id=""
                                placeholder=""
                                v-model="form.duration"
                            />
                        </div>
                        <div class="form-group">
                            <label for="" class="required"> Pricing </label>
                            <p class="indic">ex : from $7949</p>
                            <input
                                type="text"
                                class="form-control"
                                id=""
                                placeholder=""
                                v-model="form.pricing"
                            />
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset>
                        <div class="form-group">
                            <label for="" class="required">
                                Travelers limit</label
                            >
                            <p class="indic d-none">
                                ex : Limited to 16 travelers
                            </p>
                            <input
                                type="number"
                                min="1"
                                class="form-control"
                                id=""
                                placeholder=""
                                v-model="form.travelers_limit"
                            />
                        </div>
                        <div class="form-group">
                            <label for=""> Can be made private ?</label>
                            <p class="indic">
                                The customer can request to travel privately,
                                exclusively with his immediate family
                            </p>
                            <select
                                v-model="form.can_be_private"
                                id=""
                                class="form-control"
                            >
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for=""> Countries </label>
                            <p class="indic">
                                You can fill this field if the trip will take
                                place in several countries <br />
                                ex: Kenya, Rwanda ...
                            </p>
                            <input
                                type="text"
                                class="form-control"
                                id=""
                                placeholder=""
                                v-model="form.countries"
                            />
                        </div>

                        <div class="form-group">
                            <label for="" class="required"
                                >Trip Introduction</label
                            >
                            <textarea
                                v-model="form.intro"
                                id=""
                                rows="5"
                                class="form-control"
                            ></textarea>
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
        theItem: { type: Object },
        routes: { type: Object },
        regions: { type: Object },
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
