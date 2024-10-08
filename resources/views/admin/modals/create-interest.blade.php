<!-- Modal -->
<div class="modal fade" id="createInterestModal" tabindex="-1" role="dialog" aria-labelledby="createInterestModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInterestModalLabel">Create new interest</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route($route_prefix . 'createData', 'interests') }}">
                    @csrf
                    <div class="form-group">
                        <label class="required" for="">Title</label>
                        <input type="text" required name="title" class="form-control" id="" placeholder=""
                            value="">
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
