@extends('layouts.admin')

@section('content')
    <x-admin.dash-stats :$stats></x-admin.dash-stats>
    <div class="row my-4 row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h5>Countries</h5>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <simple-data-table result-name="countries"
                            v-bind:datas="{{ json_encode($simple_datas['countries']) }}"></simple-data-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h5>Interests</h5>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <simple-data-table result-name="interests"
                            v-bind:datas="{{ json_encode($simple_datas['interests']) }}"></simple-data-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h5>Wildlives</h5>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <simple-data-table result-name="wildlives"
                            v-bind:datas="{{ json_encode($simple_datas['wildlives']) }}"></simple-data-table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col" id="logo">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h5>Update site Logo</h5>
                </div>
                <div class="card-body p-3">
                    <media-card card-title="Site logo" btn-text="New Logo" img-src="{{ $site_settings->site_logo }}"
                        img-alt="site-logo" route="{{ route($route_prefix . 'uplDataMedia', 'settings') }}"
                        :form-data="{{ json_encode([
                            'theItem_id' => $site_settings->id,
                            'name' => 'Settings_' . $site_settings->id . ' logo image',
                            'data_media' => 'site_logo',
                        ]) }}"></media-card>
                </div>
            </div>
        </div>
    </div>
@endsection
