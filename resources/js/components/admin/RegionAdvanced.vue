<template>
    <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <h5 class="mb-0">Relation with other datas</h5>
        </div>
        <div class="card-body p-3">
            <Splitter class="">
                <SplitterPanel
                    class="d-flex items-center justify-content-center m-2"
                >
                    <my-pick-list
                        btn-label="BOUND INTERESTS"
                        :item-id="theItem.id"
                        :route="routes.save_interests"
                        :all="interests.all"
                        :selected="interests.selected"
                    >
                        <template #head>
                            <label for="">Interests</label>
                            <p>
                                To link a region to an interest, you must choose
                                an interest from the list on the left and add it
                                to the list on the right.
                            </p>
                        </template>
                    </my-pick-list>
                </SplitterPanel>
                <SplitterPanel
                    class="d-flex items-center justify-content-center m-2"
                >
                    <my-pick-list
                        btn-label="BOUND WILDLIVES"
                        :item-id="theItem.id"
                        :route="routes.save_wildlives"
                        :all="wildlives.all"
                        :selected="wildlives.selected"
                    >
                        <template #head>
                            <label for="">Wildlives</label>
                            <p>
                                To link a region to a wildlife, you must choose
                                an interest from the list on the left and add it
                                to the list on the right.
                            </p>
                        </template>
                    </my-pick-list>
                </SplitterPanel>
            </Splitter>
            <div class="row d-none">
                <div class="col-md-6">
                    <!-- picklist -->
                </div>
                <div class="col-md-6">
                    <!-- picklist -->
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
        interests: { type: Object },
        wildlives: { type: Object },
    },
    data(props) {
        return {
            result: null,
            loading: false,
            form: props.theItem,
        };
    },
    methods: {},
};
</script>
