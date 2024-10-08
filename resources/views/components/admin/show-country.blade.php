<div>
    <div class="row mb-2">
        <div class="col-md-6 mx-auto">
            <div class="card h-100">
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <my-uni-select label="Country's region" item-id="{{ $item->id }}"
                            route="{{ route($route_prefix . 'country-region') }}" :datas="{{ json_encode($regions) }}"
                            :reload="true"></my-uni-select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6>Interests bounded to the country's region</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <simple-data-table result-name="interests"
                            :datas="{{ json_encode($interests) }}"></simple-data-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6>Wildlives bounded to the country's region</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <simple-data-table result-name="wildlives"
                            v-bind:datas="{{ json_encode($wildlives) }}"></simple-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
