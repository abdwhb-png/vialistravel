<div>
    <div class="container mb-4" id="basic-informations">
        <region-basics :the-item="{{ json_encode($item) }}" :trips="{{ json_encode($trips) }}"
            :countries="{{ json_encode($countries) }}" :routes="{{ json_encode($routes) }}"></region-basics>
    </div>
    <div class="container mb-4" id="interests-and-wildlives">
        <region-advanced :the-item="{{ json_encode($item) }}" :interests="{{ json_encode($interests) }}"
            :wildlives="{{ json_encode($wildlives) }}" :routes="{{ json_encode($routes) }}"></region-advanced>
    </div>

    <div class="container" id="medias">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h5 class="mb-1">Medias</h5>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-6">
                        <media-card card-title="Region main pic" btn-text="New Pic"
                            img-src="{{ $medias['pic']['src'] }}" img-alt="{{ $medias['pic']['alt'] }}"
                            route="{{ $routes['upload_media'] }}"
                            :form-data="{{ json_encode($medias['pic']['form_data']) }}"></media-card>
                    </div>
                    <div class="col-md-6">
                        <media-card card-title="Region hero image" btn-text="New Hero"
                            img-src="{{ $medias['hero']['src'] }}" img-alt="{{ $medias['hero']['alt'] }}"
                            route="{{ $routes['upload_media'] }}"
                            :form-data="{{ json_encode($medias['hero']['form_data']) }}"></media-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
