<template>
    <div class="row g-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h5 class="mb-0">Highlights, Dates & FAQs</h5>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <Splitter class="p-2">
                        <!-- HIGHLIGHTS -->
                        <SplitterPanel>
                            <my-panel
                                :the-item="theItem"
                                title="Trip Highlights"
                                item-label="highlight"
                                :routes="routes.highlights"
                                :datas="highlights"
                                v-slot="slotProps"
                            >
                                <div class="form-group">
                                    <label for="" class="required">
                                        Title
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        id=""
                                        placeholder=""
                                        v-model="slotProps.item.title"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="" class="required">Text</label>
                                    <textarea
                                        v-model="slotProps.item.text"
                                        id=""
                                        rows="2"
                                        class="form-control form-control-sm"
                                    ></textarea>
                                </div>
                            </my-panel>
                        </SplitterPanel>

                        <!-- DATES -->
                        <SplitterPanel>
                            <my-panel
                                :the-item="theItem"
                                title="Trip Dates"
                                item-label="date"
                                :routes="routes.dates"
                                :datas="dates"
                                v-slot="slotProps"
                            >
                                <div class="form-group">
                                    <label for="" class="required">
                                        Year
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        id=""
                                        placeholder=""
                                        v-model="slotProps.item.year"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="" class="required">
                                        Departure
                                    </label>
                                    <input
                                        type="date"
                                        class="form-control form-control-sm"
                                        id=""
                                        placeholder=""
                                        v-model="slotProps.item.departure"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="" class="required">
                                        Return
                                    </label>
                                    <input
                                        type="date"
                                        class="form-control form-control-sm"
                                        id=""
                                        placeholder=""
                                        v-model="slotProps.item.return"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for=""> Pricing (optional)</label>
                                    <p class="indic">
                                        Fill this field if the pricing is # from
                                        the trip pricing field
                                    </p>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        id=""
                                        placeholder=""
                                        v-model="slotProps.item.pricing"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="">Notes</label>
                                    <textarea
                                        v-model="slotProps.item.notes"
                                        id=""
                                        rows="2"
                                        class="form-control form-control-sm"
                                    ></textarea>
                                </div>
                            </my-panel>
                        </SplitterPanel>

                        <!-- FAQs -->
                        <SplitterPanel>
                            <my-panel
                                :the-item="theItem"
                                title="Trip FAQs"
                                item-label="faq"
                                :routes="routes.faqs"
                                :datas="faqs"
                                v-slot="slotProps"
                            >
                                <div class="form-group">
                                    <label for="" class="required">
                                        Question
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        id=""
                                        placeholder=""
                                        v-model="slotProps.item.question"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="" class="required"
                                        >Response</label
                                    >
                                    <textarea
                                        v-model="slotProps.item.response"
                                        id=""
                                        rows="2"
                                        class="form-control form-control-sm"
                                    ></textarea>
                                </div>
                            </my-panel>
                        </SplitterPanel>
                    </Splitter>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        theItem: { type: Object },
        highlights: { type: Object },
        dates: { type: Object },
        faqs: { type: Object },
        routes: { type: Object },
    },
    data(props) {
        return {};
    },
    methods: {
        formatDate(date) {
            return new Date(date);
        },
    },
};
</script>
