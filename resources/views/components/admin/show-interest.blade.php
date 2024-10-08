<div>
    <div class="row g-4">
        <div class="col-md-6 mx-auto">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6>Regions</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <my-pick-list btn-label="BOUND REGIONS" item-id="{{ $item->id }}"
                            route="{{ route($route_prefix . 'interest-regions') }}"
                            :all="{{ json_encode($regions['all']) }}"
                            :selected="{{ json_encode($regions['selected']) }}" :reload="true">
                            <template #head>
                                <p>
                                    To link an interest to a region, you must choose a region
                                    from the list on the left and add it to the list on the
                                    right.
                                </p>
                            </template>
                        </my-pick-list>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mx-auto">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6>Bounded regions list</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <simple-data-table result-name="regions"
                            v-bind:datas="{{ json_encode($regions['table_list']) }}"></simple-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
