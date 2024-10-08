<!-- Modal -->
<div class="modal fade" id="createTripModal" tabindex="-1" role="dialog" aria-labelledby="createTripModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTripModalLabel">Create new trip</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route($route_prefix . 'createData', 'trips') }}">
                    @csrf
                    <div class="form-group">
                        <label class="required" for="">Title</label>
                        <input type="text" required name="title" class="form-control" id="" placeholder=""
                            value="">
                    </div>
                    <div class="form-group">
                        <label class="required" for="">Introduction</label>
                        <textarea name="intro" required class="form-control" id="" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn bg-gradient-dark w-100">SAVE DATA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
