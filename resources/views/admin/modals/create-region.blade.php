<!-- Modal -->
<div class="modal fade" id="createRegionModal" tabindex="-1" role="dialog" aria-labelledby="createRegionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRegionModalLabel">Create new region</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route($route_prefix . 'createData', 'regions') }}">
                    @csrf
                    <div class="form-group">
                        <label class="required" for="">Title</label>
                        <input type="text" required name="title" class="form-control" id="" placeholder=""
                            value="">
                    </div>
                    <div class="form-group">
                        <label class="required" for="">Introduction</label>
                        <textarea name="introduction" class="form-control" required id="" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Description (optional)</label>
                        <textarea name="description" class="form-control" id="" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn bg-gradient-dark w-100">SAVE DATA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
